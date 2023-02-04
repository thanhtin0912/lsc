<style > 
.history-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.history-page > a {
	color: #72c02c;
}
</style>

<script type="text/javascript">
    $(document).ready(function() {
		searchHistoryInventory(0);
    });
   
    function searchHistoryInventory(start){
        $('#tableProduct').load('<?= PATH_URL ?>searchHistoryInventory', {
            per_page: 20,
            start: start,
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
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Tên sản phẩm ..." id="seachProduct">
				<span class="input-group-btn">
					<button class="btn-u" type="button" onclick="searchHistoryInventory(0)"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</div>

		<!--Basic Table-->
		<div class="panel panel-green margin-bottom-40">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-tasks"></i> Danh sách sản phẩm</h3>
			</div>
            <div id="tableProduct">
            </div>
			
		</div>
		<!--End Basic Table-->

	</div>
</div>