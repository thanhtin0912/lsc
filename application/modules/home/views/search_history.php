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

    function searchHistoryProduct(){
		if ($('#searchHistoryDate').val()=='') {
			notify('Vui lòng chọn ngày cần tìm kiếm.', 'danger');
		}

		$('#loadProduct').load('<?= PATH_URL ?>ajaxSearchHistory', {
			name: $('#seachProduct').val(),
			date: $('#searchHistoryDate').val(),
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
					<input type="text" class="form-control date-picker"  placeholder="Chọn ngày"   id="searchHistoryDate">
                </div>
                <div class="input-group pb-2">
                    <input type="text" class="form-control" placeholder="Tên sản phẩm ..." id="seachProduct">
                    <span class="input-group-btn">
                        <button class="btn-u" type="button" onclick="searchHistoryProduct()"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
		</div>

		<!--Basic Table-->
		<div class="panel panel-grey margin-bottom-40 ">
			<div class="panel-heading d-flex justify-content-between">
				<h3 class="panel-title font-bold"><i class="fa fa-tasks"></i> Danh sách sản phẩm</h3>
			</div>
			<div id="loadProduct">

			</div>

		</div>
		<!--End Basic Table-->
	</div>
</div>
