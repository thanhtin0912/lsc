<style > 
.home-page {
	position: relative;
    border-bottom: solid 2px #72c02c;
}
.home-page > a {
	color: #72c02c;
}
</style>
<div class="col-md-12">
	<div class="profile-body">
		<div class="row margin-bottom-10">
			<div class="col-sm-6 sm-margin-bottom-20">
				<div class="service-block-v3 service-block-u">
					<i class="icon-user"></i>
					<span class="service-heading"><?= $this->session->userdata('userStaff')[0]->name;?></span>
					<span class="counter">52,147</span>

					<div class="clearfix margin-bottom-10"></div>

					<div class="row margin-bottom-20">
						<div class="col-xs-6 service-in">
							<small>Đang nhập lần cuối</small>
							<h4 class="counter"><?= $this->session->userdata('userStaff')[0]->created;?></h4>
						</div>
					</div>
					<div class="statistics">
						<h3 class="heading-xs">Statistics in Progress Bar <span class="pull-right">67%</span></h3>
						<div class="progress progress-u progress-xxs">
							<div style="width: 67%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="67" role="progressbar" class="progress-bar progress-bar-light">
							</div>
						</div>
						<small>11% less <strong>than last month</strong></small>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="service-block-v3 service-block-blue">
					<i class="icon-home"></i>
					<span class="service-heading">Overall Page Views</span>
					<span class="counter"><?= $this->session->userdata('userStaff')[0]->store_name;?></span>

					<div class="clearfix margin-bottom-10"></div>

					<div class="row margin-bottom-20">
						<div class="col-xs-6 service-in">
							<small>Last Week</small>
							<h4 class="counter">26,904</h4>
						</div>
						<div class="col-xs-6 text-right service-in">
							<small>Last Month</small>
							<h4 class="counter">124,766</h4>
						</div>
					</div>
					<div class="statistics">
						<h3 class="heading-xs">Statistics in Progress Bar <span class="pull-right">89%</span></h3>
						<div class="progress progress-u progress-xxs">
							<div style="width: 89%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="89" role="progressbar" class="progress-bar progress-bar-light">
							</div>
						</div>
						<small>15% higher <strong>than last month</strong></small>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>