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
	
	function moveProductStore(proId, oldInven){
        var url = '<?= PATH_URL ?>';
		var qty = $('#qty' + proId).val();
        if ($('#seachStore').val()=='') {
			notify('Vui lòng chọn cửa hàng cần chuyển.', 'danger');
			return false;
		}
		if (qty && qty <=0) {
			notify('Số lượng sản phẩm chưa được nhập hoặc số lượng = 0.', 'danger');
			return false;
		}
		if (proId =='') {
			notify('Lỗi cập nhật dữ liệu.', 'danger');
			return false;
		}
		if (parseFloat(oldInven) < parseFloat(qty)) {
			notify('Không thể chuyển nhiều hơn tồn kho.', 'danger');
			return false;
		}
		$('#qty' + proId).attr('disabled', true);
		$('#btn-save-' + proId).attr('disabled', true);		
        let selText = $("#seachStore option:selected").text();
		var d = new Date();
        $.confirm({
			title: 'Chuyển hàng cho '+ selText +'',
			content: '' +
			'<form action="" class="formName">' +
			'<strong>'+formatDate(d)+'</strong>' +
			'<div class="form-group d-flex align-items-center pt-2">' +
			'<label class="w-75">'+$('#name' + proId).html()+'</label>' +
			'<input value="'+qty+'" class="ml-2 name form-control" disabled />' +
			'</div>' +
			'</form>',
			buttons: {
				formSubmit: {
					text: 'Xác nhận',
					btnClass: 'btn-blue',
					action: function () {
                        $.ajax({    
                            type: 'POST',
                            url:  url +'moveProductStore',
                            data: {
                                qty    : qty,
                                productId : proId,
                                store : $('#seachStore').val(),
                                csrf_token: $('#csrf_token').val()
                            },           
                            success: function(data) { 
                                responseText = data.split(".");          
                                if(responseText[0]=='success'){
                                    notify('Vui lòng chờ hệ thống xác nhận và chuyển hàng.', 'success');
                                    setTimeout(function(){
                                        $('#csrf_token').val(responseText[1])
                                        searchProduct(); 
                                    }, 1500);
                                } else {
                                    notify('Không thể thực hiện chuyển hàng cho đơn hàng trên.', 'danger');
                                }
                            },
                            error: function () {
                            },
                            async:false ,       
                        });
					}
				},
				cancel: function () {
					//close
					$('#btn-save-' + proId).attr('disabled', false);
				},
			},
		});

    }

    function formatDate(d) {
		var yyyy = d.getFullYear().toString();
		var mm = (d.getMonth()+1).toString(); // getMonth() is zero-based
		var dd  = d.getDate().toString();
		var h = d.getHours().toString();
		var m = d.getMinutes().toString();
		var s = d.getSeconds().toString();

		return (dd[1]?dd:"0"+dd[0])  + "/" + (mm[1]?mm:"0"+mm[0]) + "/" + yyyy + " - " + ((h > 12) ? h-12 : h) + ":" + m + ":" + s;
	};


    function searchProduct(){
        $('#tableProduct').load('<?= PATH_URL ?>ajaxSearchMoveProductStore', {
			name: $('#seachProduct').val(),
            csrf_token: $("#csrf_token").val(),
        },function() {
        }); 
    }

</script>
<div class="col-md-12">
	<div class="profile-body">
		<div class="col-md-8 col-md-offset-2 margin-bottom-20" >
			<h2 style="text-align: center;">Tìm kiếm sản phẩm</h2>
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
		<div class="panel panel-grey margin-bottom-40">
			<div class="panel-heading d-flex justify-content-between">
				<h3 class="panel-title font-bold"><i class="fa fa-tasks"></i> Danh sách sản phẩm</h3>
			</div>
			<form id="frmManagement" action="<?= PATH_URL ?>exportListQtyPruoduct" method="post" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
			<input type="hidden" value="<?=$this->security->get_csrf_hash()?>" name="csrf_token" />
			<table class="table table-striped import">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên sản phẩm</th>
						<th>Tồn kho</th>
						<th width="180px">Xuất kho</th>
						<th class="text-center">Tồn dự tính</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="tableProduct" >
					<?php if ($products) {?>
					<?php foreach ($products as $key => $p) {?>
					<tr>
						<td><?= $key +1; ?></td>
						<td class="font-bold"><span id="name<?=$p->id?>"><?= $p->name; ?></span></td>
						<td class="new-inventory fa-2x font-bold"><?= $p->inventory;?></td>
						<td>
							<button type="button" class="quantity-button" name="subtract" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value--;" value="-">-</button>
							<input type="number" min="0" tabindex="<?= $key +1;?>" onkeypress="return Enter(event,<?=$p->id?>)" name="qty<?=$p->id?>"  class="quantity-field" id="qty<?=$p->id?>" value="0" data-inventory="<?= $p->inventory;?>">
							<button type="button" class="quantity-button" name="add" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value++;" value="+">+</button>
						</td>
						<td class="text-center font-bold"><span class="label rounded label-red"></span></td>
						<td>
						    <button class="btn-u btn-u-xs rounded-4x btn-u-dark btn-export" id="btn-save-<?=$p->id?>" type="button" onclick="moveProductStore(<?=$p->id?>,<?= $p->inventory;?>)"><i class="fa  fa-recycle"></i></button>
						</td>
					</tr>
					<?php } ?>
					<?php } ?>
				</tbody>
			</table>
			</form>
		</div>
		<!--End Basic Table-->
	</div>
</div>

<div id="importControl" style="position: fixed; right: 5px; opacity: 1; cursor: pointer;">
	<button class="btn-u btn-u-xs btn-u-dark p-3 handle-control d-none"  type="button" onclick="saveListQtyPruoduct()">Nhập tất cả</button>
</div>