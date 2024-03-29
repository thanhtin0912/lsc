
<style>
.table-hover>tbody>tr:hover, .table-hover>tbody>tr:hover>td {
    background: #fffccc!important;
} 
.fixed-table-container tbody td {
	border-left: none ! important;
	font-size: 16px;
	padding: 10px;
} 
.fixed-table-container {
    border: none ! important;
}  
.portlet.box.blue {
    border: none ! important;
}
.color-down {
    background-color: #36c6d3;
}
.color-up{
    background-color: #F1C40F;
}
.color-danger {
    background-color: #de1a1a;
}
</style>
<link href="<?= PATH_URL . 'assets/css/admin/' ?>bootstrap-table.min.css" rel="stylesheet" type="text/css"/>
<?php if ($products) { ?>
    <div class="bootstrap-table">
    <div class="fixed-table-toolbar"></div>
    <div class="fixed-table-container" style="height: 599px;">
        <div class="fixed-table-header" style="margin-right: 0px;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th data-field="id" tabindex="0" width="5%">
                            <div class="th-inner bold">STT.</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th width="20%" data-field="name" tabindex="0">
                            <div class="th-inner bold">Sản phẩm</div>
                            <div class="fht-cell" ></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Tồn kho</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Tồn kho KT</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Cần hàng</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Định mức</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Định mức(Min)</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Nhập kho</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Xuất kho</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Hủy</div>
                            <div class="fht-cell"></div>
                        </th>

                    </tr>
                </thead>
            </table>
        </div>
        <div class="fixed-table-body">
            <div class="fixed-table-loading" style="top: 41px; display: none;">Loading, please wait...</div>
            <table id="data-table" data-height="599" class="table table-hover" style="margin-top: -40px;">
                <thead>
                    <tr>
                        <th data-field="id" tabindex="0" width="5%">
                            <div class="th-inner bold">STT.</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th width="20%" data-field="name" tabindex="0">
                            <div class="th-inner">Sản phẩm</div>
                            <div class="fht-cell" ></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Tồn kho</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Cần hàng</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Định mức</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Định mức(Min)</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Nhập kho</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Xuất kho</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th data-field="name" tabindex="0" width="10%">
                            <div class="th-inner center">Hủy</div>
                            <div class="fht-cell"></div>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <?php if($products) { ?>
                        <?php foreach ($products as $key => $p) { ?>
                        
                        <tr>
                            <td class="center"><?=$key+1;?></td>
                            <td class="bold" ><?=$p->name;?></td>
                            <td class="center bold <?php if($p->quoteMin >= $p->inventory){echo "color-danger";}?>"><?=$p->inventory;?></td>
                            <td class="center bold"><?=$p->inventoryKT;?></td>
                            <td class="center bold <?php $hieu= $p->quote - $p->inventory; if($hieu > 0) {echo "color-down";} else { if($hieu < 0 ) {echo "color-up";} }?>"><?php echo $hieu= $p->quote - $p->inventory;?></td>
                            
                            <td class="center bold"><?=$p->quote;?></td>
                            <td class="center bold"><?=$p->quoteMin;?></td>
                            <td class="center bold"><?=$p->import;?></td>
                            <td class="center bold"><?=$p->export;?></td>
                            <td class="center bold"><?=$p->remove;?></td>
                            
                        </tr>
                        
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>	
    </div>
</div>


<?php } ?>

						