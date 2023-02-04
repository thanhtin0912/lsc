<style > 
.export-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.export-page > a {
	color: #72c02c;
}
</style>

<script type="text/javascript">
    $(document).ready(function() {

    });

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
</script>
<div class="col-md-12">
	<div class="profile-body p-0 p-md-4">
		<div class="col-md-8 col-md-offset-2 margin-bottom-20" >
			<h2 style="text-align: center;">Tìm kiếm</h2>
            <div class="d-flex flex-column flex-lg-row">
                <div class="input-group mr-0 mr-lg-2 pb-2">
                    <input class="form-control hasDatepicker" type="text" name="date" id="date">
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
			</div>
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
		</div>
		<!--End Basic Table-->
	</div>
</div>
