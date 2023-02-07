
<?php if ($products) {?>
<div class="panel-group acc-v1 p-2" id="accordion-1">
<?php foreach ($products as $key => $p) {?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title font-bold">
                <a class="accordion-toggle collapsed d-flex p-3 justify-content-between" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-<?= $key; ?>" aria-expanded="false">
                    <span><?= $p->name; ?></span>
                    <span>Nhập: <?= $p->totalImport; ?></span>
                    <span>Xuất: <?= $p->totalExport; ?></span>
                </a>
            </h4>
        </div>
        <div id="collapse-<?= $key; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex p-3 justify-content-between">
                            <div class="import">
                                
                                <ul class="list-unstyled">
                                    <?php $listImport = unserialize($p->import);?>
                                    <?php if ($listImport) {?>
                                    <?php foreach ($listImport as $key => $i) {?>
                                    <li class="py-2"><i class="fa fa-check color-green"></i> <?= $i->created ?> - <span class="badge bg-color-green font-16">Số lượng: <?= $i->adjQty ?></span></li>
                                    <?php } ?>
                                    <?php } else { echo "No data";} ?>
                                </ul>
                                
                            </div>
                            <div class="export">
                                <ul class="list-unstyled">
                                    <?php $listExport = unserialize($p->export);?>
                                    <?php if ($listExport) {?>
                                    <?php foreach ($listExport as $key => $e) {?>
                                    <li class="py-2"><i class="fa fa-check color-green"></i> <?= $e->created ?> - <span class="badge bg-color-red font-16">Số lượng: <?= $e->adjQty ?></span></li>
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