<style > 
.kt-xuat-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.kt-xuat-page a{
	color: #72c02c !important;
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
</style>



<script type="text/javascript">
    $(document).ready(function() {
		$("input[type=number]").on('change',function(){
			var $button = $(this);
			if (parseFloat($button.parent().find('input').val()) < 0){
				$button.parent().find('input').val(0)
			}
		});
		$('#flexInputAll').click(function() {
			if ($(this).is(':checked')) {
				const collection = document.querySelectorAll(".btn-import")
				for (let i = 0; i < collection.length; i++) {
					collection[i].className += " d-none";
				}
				document.getElementsByClassName("handle-control")[0].classList.remove("d-none")
			} else {
				const collection = document.querySelectorAll(".btn-import")
				for (let i = 0; i < collection.length; i++) {
					collection[i].classList.remove("d-none")
				}
				document.getElementsByClassName("handle-control")[0].className += " d-none";
			}
		});
    });
    function Enter(e, id){
        if(e.keyCode == 13){ 
			if (!$('#flexInputAll').is(':checked')) {
				var $button = $(this);
				if (parseFloat($button.parent().find('input').val()) < 0){
					$button.parent().find('input').val(0)
				}
				saveQuoteInventory(id);
			}
        }
    }
	$(document).on('click', '.quantity-button', function() {
            var $button = $(this);
			if (parseFloat($button.parent().find('input').val()) < 0){
				$button.parent().find('input').val(0)
			}
	});


	function saveQuoteInventory(proId){
        var url = '<?= PATH_URL ?>';
		var qty = $('#qty' + proId).val();
		if (qty && qty <=0) {
			notify('Số lượng sản phẩm chưa được nhập hoặc số lượng = 0.', 'danger');
			return false;
		}
		if (proId =='') {
			notify('Lỗi khi chưa được nhập.', 'danger');
			return false;
		}
		$('#qty' + proId).attr('disabled', true);
		$('#btn-save-' + proId).attr('disabled', true);		
        $.ajax({    
            type: 'POST',
            url:  url +'importQtyCheckStore',
            data: {
                qty    : qty,
				productId : proId,
				store : $('#seachStore').val(),
				date : $('#searchDate').val(),
				csrf_token: $('#csrf_token').val()
            },           
            success: function(data) { 
                responseText = data.split(".");          
                if(responseText[0]=='success'){
					$('#csrf_token').val(responseText[1])
					notify('Sản phẩm đã được nhập kiểm tra vào hệ thống.', 'success');
					$('#btn-save-' + proId).hide();
                } else {
					notify('Lỗi khi nhập kiểm tra sản phẩm.', 'danger');
				}
            }     
        });	
    }

    function searchHistoryProduct(){
		var store = $('#seachStore').val()
		var date = $('#searchDate').val()
		if (store != '' && date != '') {
			$('#tableProduct').load('<?= PATH_URL ?>ajaxSearchExportProductFromStore', {
				store: store,
				date: date,
				csrf_token: $("#csrf_token").val(),
			},function() {}); 
		} else {
			notify('Vui lòng nhập thông tin tìm kiếm.', 'danger');
			return false
		}
        
    }

	function saveListQuoteInventory(){
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
			notify('<strong>'+responseText[1] + '</strong> Sản phẩm đã được nhập kiểm tra vào hệ thống', 'success');
		} else {
			notify('Không Sản phẩm được nhập kho.', 'danger');
		}
	}


</script>
<div class="col-md-12">
	<div class="profile-body p-0 p-md-4">
		<form id="frmManagement" action="<?= PATH_URL ?>importListQtyCheckStore" method="post" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
		<div class="col-md-8 col-md-offset-2 margin-bottom-20" >
			<h2 style="text-align: center;">Tìm kiếm sản phẩm</h2>
            <div class="d-flex flex-column flex-lg-row">
                <div class="input-group mr-0 mr-lg-2 pb-2">
					<input type="text" class="form-control date-picker"  placeholder="Chọn ngày"   id="searchDate" name="date">
                </div>
                <div class="input-group pb-2">
					<select class="form-control" id="seachStore" name="store">
                        <option value="">Chọn cửa hàng</option>
                        <?php foreach ($stores as $key => $s) {?>
                        <option value="<?=$s->id ?>"><?=$s->name ?></option>
                        <?php } ?>
                    </select>
                    <span class="input-group-btn">
                        <button class="btn-u" type="button" onclick="searchHistoryProduct()"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
		</div>

		<!--Basic Table-->
		<div class="panel panel-green margin-bottom-40">
			<div class="panel-heading d-flex justify-content-between">
				<h3 class="panel-title font-bold"><i class="fa fa-tasks"></i> Danh sách </h3>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="flexInputAll">
					<label class="form-check-label panel-title pl-4" for="flexCheckDefault">
						Nhập nhiều sản phẩm
					</label>
				</div>
			</div>
			
			<input type="hidden" value="<?=$this->security->get_csrf_hash()?>" name="csrf_token" />
			<table class="table import">
				<thead>
					<tr>
						<th width="20px">#</th>
						<th>Tên sản phẩm</th>
						<th>Tổng nhập kho</th>
						<th width="180px">Nhập KT</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="tableProduct" >

				</tbody>
			</table>
			
		</div>
		</form>
		<!--End Basic Table-->
	</div>
</div>
<div id="importControl" style="position: fixed; right: 5px; opacity: 1; cursor: pointer;">
	<button class="btn-u btn-u-xs btn-u-green p-3 handle-control d-none"  type="button" onclick="confirm()">Xem lại tất cả</button>
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
							<th>Tổng xuất</th>
							<th>Nhập KT</th>
						</tr>
					</thead>
					<tbody id="tableDataConfirm" >

					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-u rounded-4x btn-u-default" data-dismiss="modal">Thoát</button>
				<button type="button" class="btn-u rounded-4x btn-u-green" id="btn-save-note" onclick="saveListQuoteInventory()">Nhập</button>
			</div>
		</div>
	</div>
</div>