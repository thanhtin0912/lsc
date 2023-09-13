
<?php if ($products) {?>
<div class="panel-group accordion scrollable p2" id="accordion-1">
<?php foreach ($products as $key => $p) {?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title font-bold">
                <a class="accordion-toggle collapsed bold p-1" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-<?= $key; ?>" aria-expanded="false" style="<?php if($p->totalChange > 0 ) { echo 'background: #ffbc62;';}?>">
                <div class="container">    
                    <div class="row">
                            <div class="col-5"><div class="d-flex p-3 justify-content-between"><span class="bold"><?= $p->name; ?></span></div></div>
                            <div class="col-7">
                                <div class="d-flex p-3 justify-content-between">
                                    <span class="bold font-red mt-sweetalert">Xuất CH: <?= $p->totalExport; ?></span>
                                    <span class="bold font-green mt-sweetalert">Nhập KT: <?= $p->totalCheck; ?></span>
                                    <span class="bold mt-sweetalert">CL: <?= $p->totalExport - $p->totalCheck; ?></span>
                                </div>
                            </div>
                        </div> 
                    </div>   
                </a>
            </h4>
        </div>
        <div id="collapse-<?= $key; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body p-1 p-md-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex p-3 justify-content-between flex-column flex-md-row">
                            <div class="export">
                                <ul class="list-unstyled">
                                    <?php $listExport = unserialize($p->exported);?>
                                    <?php if ($listExport) {?>
                                    <?php foreach ($listExport as $key => $e) {?>
                                    <li class="py-2"><i class="fa fa-check color-green"></i> <?= $e->created ?> - <span class="label label-danger font-16 bold">SL: <?= $e->adjQty ?></span></li>
                                    <?php } ?>
                                    <?php } else { echo "No data";} ?>
                                </ul>
                            </div>
                            <div class="import">
                                <ul class="list-unstyled">
                                    <?php $checkDate = unserialize($p->checkDate);?>
                                    <?php if ($checkDate) {?>
                                    <?php foreach ($checkDate as $key => $i) {?>
                                    <li class="py-2"><i class="fa fa-check color-green"></i> <?= $i->created ?> - <span class="label label-success font-16 bold">SL: <?= $i->value ?></span></li>
                                    <?php } ?>
                                    <?php } else { echo "No data";} ?>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>		
<?php } ?>
</div>
<?php } else { echo "No data";} ?>
