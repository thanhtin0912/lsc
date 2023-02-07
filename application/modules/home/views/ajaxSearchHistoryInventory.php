<table class="table table-striped import">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên sản phẩm</th>
            <th class="hidden-sm">Đơn vị</th>
            <th>Tồn đầu</th>
            <th width="180px">SL nhập</th>
            <th>Tồn cuối</th>
            <?php if($this->session->userdata('userStaff')[0]->isMain) {?>
            <th>Cửa hàng</th>
            <?php } ?>
            <th>Ngày nhập</th>
        </tr>
    </thead>
    <tbody>
    <?php if ($result) {?>
    <?php foreach ($result as $key => $p) {?>
    <tr>
        <td><?= $key +1; ?></td>
        <td class="font-bold"><?= $p->product_name; ?></td>
        <td class="hidden-sm"><?= $p->unit; ?></td>
        <td class="new-inventory"><?= $p->prevQty;?></td>
        <?php if($p->newQty > $p->prevQty) { ?>
        <td class="font-bold"><span class="label rounded label-u"><i class="fa fa-arrow-up"></i></span> <?= $p->adjQty;?> </td>
        <td class="font-bold"><span class="label rounded label-u"><?= $p->newQty;?></span></td>
        <?php } else { ?>   
        <td class="font-bold"><span class="label rounded label-red"><i class="fa fa-arrow-down"></i></span> <?= $p->adjQty;?> </td>
        <td class="font-bold"><span class="label rounded label-red"><?= $p->newQty;?></span></td>
        <?php }?>
        <?php if($this->session->userdata('userStaff')[0]->isMain && $p->mainStore) {?>
        <th><?php $found_key = array_search($p->mainStore, array_column(json_decode(json_encode($stores), true), 'id')); echo ($stores[$found_key]->name); ?></th>
        <?php } else { echo '<th></th>';} ?>
        <td><?= $p->created; ?></td>
    </tr>
    <?php } ?>
    <?php } else { ?>
        <div class="alert alert-warning fade in">
            <strong>Không có sản phẩm nào được tìm thấy,</strong>
        </div>
    <?php } ?>
    </tbody>
</table>
<div class="text-center">
    <ul class="pagination" style="visibility: visible;">
        <?=$this->adminpagination->create_links();?>
    </ul>
</div>