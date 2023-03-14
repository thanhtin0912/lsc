<style > 
.export-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.export-page > a {
	color: #72c02c;
}
#importControl {
    color: #fff;
    z-index: 99;
    font-size: 20px;
    background: #222;
    position: relative;
    right: 14px !important;
    bottom: 45px !important;
    border-radius: 3px !important;
}
.font-16 {
    font-size: 20px;
}
</style>

<script type="text/javascript">
    $(document).ready(function() {
		$("input[type=number]").on('change',function(){
			var $button = $(this);
			if (parseFloat($button.parent().find('input').val()) < 0){
				$button.parent().find('input').val(0)
			}
            var qty = $button.parent().find('input').val();
            var oldInventory = $button.parent().find('input').data('inventory');
			if (parseFloat(qty) >  parseFloat(oldInventory)){
				notify('Không thể xuất nhiều hơn tồn kho.', 'danger');
				return $button.parent().find('input').val(oldInventory); 
			}
            $button.closest('tr').find('.label-red').text(parseFloat(oldInventory) - parseFloat(qty));
		});

		$('#flexInputAll').click(function() {
			if ($(this).is(':checked')) {
				const collection = document.querySelectorAll(".btn-export")
				for (let i = 0; i < collection.length; i++) {
					collection[i].className += " d-none";
				}
				document.getElementsByClassName("handle-control")[0].classList.remove("d-none")
			} else {
				const collection = document.querySelectorAll(".btn-export")
				for (let i = 0; i < collection.length; i++) {
					collection[i].classList.remove("d-none")
				}
				document.getElementsByClassName("handle-control")[0].className += " d-none";
			}
		});

        $('#seachStore').change(function(){
			var mainStore = $('#seachStore').val();
			$("#mainStore").val(mainStore);
            searchProduct();
        });

    });

    function Enter(e, id){
        if(e.keyCode == 13){ 
			if (!$('#flexInputAll').is(':checked')) {
				var $button = $(this);
				if (parseFloat($button.parent().find('input').val()) < 0){
					$button.parent().find('input').val(0)
				}
				var qty = $button.parent().find('input').val();
				var oldInventory = $button.parent().find('input').data('inventory');
				if (parseFloat(qty) >  parseFloat(oldInventory)){
					notify('Không thể xuất nhiều hơn tồn kho.', 'danger');
					return $button.parent().find('input').val(oldInventory); 
				}
				$button.closest('tr').find('.label-red').text(parseFloat(oldInventory) - parseFloat(qty));
				saveInventory(id);
			}
        }
    }
	$(document).on('click', '.quantity-button', function() {
            var $button = $(this);
			if (parseFloat($button.parent().find('input').val()) < 0){
				$button.parent().find('input').val(0)
			}
            var qty = $button.parent().find('input').val();
            var oldInventory = $button.parent().find('input').data('inventory');
			if (parseFloat(qty) >  parseFloat(oldInventory)){
                notify('Không thể xuất nhiều hơn tồn kho.', 'danger');
				return $button.parent().find('input').val(oldInventory); 
			}
            $button.closest('tr').find('.label-red').text(parseFloat(oldInventory) - parseFloat(qty));
	});
	
	function saveInventory(proId, oldInven){
        var url = '<?= PATH_URL ?>';
		var qty = $('#qty' + proId).val();
		if (qty && qty <=0) {
			notify('Số lượng sản phẩm chưa được nhập hoặc số lượng = 0.', 'danger');
			return false;
		}
		if (proId =='') {
			notify('Lỗi cập nhật dữ liệu.', 'danger');
			return false;
		}
		if (parseFloat(oldInven) < parseFloat(qty)) {
			notify('Không thể xuất nhiều hơn tồn kho.', 'danger');
			return false;
		}
		$('#qty' + proId).attr('disabled', true);
		$('#btn-save-' + proId).attr('disabled', true);		
        $.ajax({    
            type: 'POST',
            url:  url +'exportInventory',
            data: {
                qty    : qty,
				productId : proId,
				mainStore : $('#mainStore').val(),
				csrf_token: $('#csrf_token').val()
            },           
            success: function(data) { 
                responseText = data.split(".");          
                if(responseText[0]=='success'){
					notify('Sản phẩm đã được xuất kho.', 'success');
					setTimeout(function(){ 
						searchProduct(); 
					}, 1500);
                } else {
					notify('Sản phẩm đã được xuất kho.', 'danger');
				}
            },
            error: function () {
            },
            async:false ,       
        });
		
    }

    function searchProduct(){
		if ($('#seachStore').val()=='') {
			notify('Vui lòng chọn cửa hàng cần xuất kho.', 'danger');
			return false;
		}
        $('#tableProduct').load('<?= PATH_URL ?>ajaxSearchExportMainStore', {
			name: $('#seachProduct').val(),
            store: $('#seachStore').val(),
            csrf_token: $("#csrf_token").val(),
        },function() {
            
        }); 
    }

	function saveListQtyPruoduct(){
		var options = {
			beforeSubmit:  showRequest,  // pre-submit callback 
			success:       showResponse  // post-submit callback 
		};
		$('#frmManagement').ajaxSubmit(options);
	}
	function showRequest(formData, jqForm, options) {
		var form = jqForm[0];
	}

	function showResponse(responseText, statusText, xhr, $form) {
		responseText = responseText.split(".");          
		if(responseText[0]=='success'){
			$('#modalConfirm').modal('hide');
			notify('<strong>'+responseText[1] + '</strong> Sản phẩm đã được xuất kho', 'success');
			setTimeout(function(){ 
				searchProduct();
			}, 1500);
		} else {
			notify('Không Sản phẩm được xuất kho.', 'danger');
		}
	}
	
	function loadData(proId){
        var url = '<?= PATH_URL ?>';	
        $.ajax({    
            type: 'POST',
            url:  url +'loadNoteProductofStore',
            data: {
				productId : proId,
				csrf_token: $('#csrf_token').val()
            },           
            success: function(data) { 
				var responseText = JSON.parse(data)
				if(responseText.return){
					var pro = responseText.data
					console.log(pro);
					$('#txtProductName').html(pro[0].name);
					$('#txtProductID').val(pro[0].productId);
					$('#txtNote').val(pro[0].note);
					$('#modalNote').modal('show');
				}
            }     
        });	
    }
	function saveNote(){
        var url = '<?= PATH_URL ?>';
		var note = $('#txtNote').val();
		if (note =='') {
			notify('Vui lòng nhập thông tin.', 'danger');
			return false;
		}	
        $.ajax({    
            type: 'POST',
            url:  url +'saveNoteInventory',
            data: {
                note    : note,
				productId : $('#txtProductID').val(),
				csrf_token: $('#csrf_token').val()
            },           
            success: function(data) { 
                var responseText = JSON.parse(data)         
                if(responseText.return){
					$('#modalNote').modal('hide');
					$('#csrf_token').val(responseText.csrf_hash)
					$('#note-'+$('#txtProductID').val()).html(responseText.data)
					notify('Thông tin đã được cập nhật.', 'success');
                } else {
					notify('Thông tin không thể cập nhật.', 'danger');
				}
            }     
        });	
    }


</script>
<div class="col-md-12">
	<div class="profile-body p-0 p-md-4">
		<div class="col-md-8 col-md-offset-2 margin-bottom-20" >
			<h2 style="text-align: center;">Tìm kiếm</h2>
            <div class="d-flex flex-column flex-lg-row">
                <div class="input-group mr-0 mr-lg-2 pb-2">
                    <select class="form-control" id="seachStore">
                        <option value="">Chọn cửa hàng</option>
                        <?php foreach ($stores as $key => $s) {?>
                        <option value="<?=$s->id ?>"><?=$s->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-group pb-2">
                    <input type="text" class="form-control" placeholder="Tên sản phẩm ..." id="seachProduct">
                    <span class="input-group-btn">
                        <button class="btn-u" type="button" onclick="searchProduct()"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
		</div>

		<!--Basic Table-->
		<div class="panel panel-grey margin-bottom-40 ">
			<div class="panel-heading d-flex justify-content-between">
				<h3 class="panel-title font-bold"><i class="fa fa-tasks"></i> Danh sách sản phẩm</h3>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="flexInputAll">
					<label class="form-check-label panel-title pl-4" for="flexCheckDefault">
						Nhập nhiều sản phẩm
					</label>
				</div>
			</div>
			<form id="frmManagement" action="<?= PATH_URL ?>exportListQtyPruoduct" method="post" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
			<input type="hidden" value="<?=$this->security->get_csrf_hash()?>" name="csrf_token" />
			<input type="hidden" value="" name="mainStore" id="mainStore"/>
			<table class="table table-striped import">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên sản phẩm</th>
						<th class="hidden-sm">Ghi chú</th>
						<th>Tồn kho</th>
                        <th>Hàng cần <span id="txtStore"></span></th>
						<th width="180px">Xuất kho</th>
						<th class="text-center hidden-sm">Tồn dự tính</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="tableProduct" >
				</tbody>
			</table>
			</form>
		</div>
		<!--End Basic Table-->
	</div>
</div>

<div id="importControl" style="position: fixed; right: 5px; opacity: 1; cursor: pointer;">
	<button class="btn-u btn-u-xs btn-u-dark p-3 handle-control d-none"  type="button" onclick="confirm()">Xem lại</button>
</div>

<div class="modal lg fade" id="modalConfirm" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-bold">Xem lại thông tin xuất kho</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table import">
					<thead>
						<tr>
							<th width="20px">#</th>
							<th>Tên sản phẩm</th>
							<th>Tồn kho</th>
							<th>Xuất kho</th>
							<th>ghi chú</th>
						</tr>
					</thead>
					<tbody id="tableDataConfirm" >

					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-u rounded-4x btn-u-default" data-dismiss="modal">Thoát</button>
				<button type="button" class="btn-u rounded-4x btn-u-green" id="btn-save-note" onclick="saveListQtyPruoduct()">Xuất Kho</button>
			</div>
		</div>
	</div>
</div>