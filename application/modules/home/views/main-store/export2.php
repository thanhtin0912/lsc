<style > 
.export2-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.export2-page > a {
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
.modal-body {
    height: 85vh;
    overflow-y: auto;
}
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#seachStore').change(function(){
			var mainStore = $('#seachStore').val();
			$("#mainStore").val(mainStore);
            searchProduct();
        });

    });


    function searchProduct(){
		if ($('#seachStore').val()=='') {
			notify('Vui lòng chọn cửa hàng cần xuất kho.', 'danger');
			return false;
		}
        let selText = $("#seachStore option:selected").text();
		var d = new Date();
        $('#nameStoreModal').html(selText + ' - ' +formatDate(d));
        $('#tableProduct').load('<?= PATH_URL ?>ajaxSearchExport2MainStore', {
			name: $('#seachProduct').val(),
            store: $('#seachStore').val(),
            csrf_token: $("#csrf_token").val(),
        },function() {
           
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

    function saveListQtyPruoduct(){
		if ($('#seachStore').val()=='') {
			notify('Vui lòng chọn cửa hàng cần xuất kho.', 'danger');
			return false;
		}
	    $('#btn-save-list-qty').hide()
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
			$('#btn-save-list-qty').show()
			setTimeout(function(){ 
				searchProduct();
			}, 1500);
		} else {
			notify('Không Sản phẩm được xuất kho.', 'danger');
		}
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
				<h3 class="panel-title font-bold"><i class="fa fa-tasks"></i> Danh sách sản phẩm </h3>
			</div>
			<form id="frmManagement" action="<?= PATH_URL ?>exportListQtyPruoduct2" method="post" enctype="multipart/form-data" class="form-horizontal form-row-seperated">
			<input type="hidden" value="<?=$this->security->get_csrf_hash()?>" name="csrf_token" />
			<input type="hidden" value="" name="mainStore" id="mainStore"/>
            <input type="hidden" value="1" name="export2" id="export2"/>
			<table class="table table-striped import">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên sản phẩm</th>
						<th class="hidden-sm">Ghi chú</th>
						<th>Tồn kho</th>
                        <th>Hàng cần <span id="txtStore"></span></th>
						<th width="180px">Xuất kho dự tính</th>
						<th class="text-center hidden-sm">Tồn dự tính</th>
                        <th>Định mức lần 2</th>
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
	<button class="btn-u btn-u-xs btn-u-dark p-3 handle-control"  type="button" onclick="confirm()">Xem lại</button>
</div>

<div class="modal lg fade" id="modalConfirm" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-bold">Thông tin xuất - <strong><span id="nameStoreModal"></span></strong></h5>
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
							<th>Ghi chú</th>
						</tr>
					</thead>
					<tbody id="tableDataConfirm" >

					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-u rounded-4x btn-u-default" data-dismiss="modal">Thoát</button>
				<button type="button" class="btn-u rounded-4x btn-u-green" id="btn-save-list-qty" onclick="saveListQtyPruoduct()">Xuất Kho</button>
			</div>
		</div>
	</div>
</div>