
<?php if ($products) {?>
<?php foreach ($products as $key => $p) {?>
<tr>
    <td><?= $key +1; ?></td>
    <td class="font-bold"><?= $p->name; ?></td>
    <td><span id="note-<?=$p->id?>" ><?= $p->note; ?></span></td>
    <td class="new-inventory fa-2x font-bold"><?= $p->inventory;?></td>
    <td>
        <button type="button" class="quantity-button" name="subtract" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value--;" value="-">-</button>
        <input type="number" min="0" onkeypress="return Enter(event,<?=$p->id?>)"  class="quantity-field" id="qty<?=$p->id?>" value="0" data-inventory="<?= $p->inventory;?>">
        <button type="button" class="quantity-button" name="add" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value++;" value="+">+</button>
    </td>
    <td class="text-center font-bold"><span class="label rounded label-red"></span></td>
    <td>
        <button class="btn-u btn-u-xs rounded-4x btn-u-dark btn-export" id="btn-save-<?=$p->id?>" type="button" onclick="saveInventory(<?=$p->id?>,<?= $p->inventory;?>)"><i class="fa fa-cloud-upload"></i></button>
		<button class="btn-u btn-u-xs rounded-4x btn-u-dark" type="button" onclick='loadData(<?=$p->id?>)'><i class="fa fa-pencil"></i></button>
    </td>
</tr>
<?php } ?>
<?php } ?>

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
    });
    function Enter(e, id){
        if(e.keyCode == 13){ 
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

</script>