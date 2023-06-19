
<?php if ($products) {?>
<?php foreach ($products as $key => $p) {?>
<tr>
    <td><?= $key +1; ?></td>
    <td class="font-bold"><span id="name<?=$p->id?>"><?= $p->name; ?></span></td>
    <td class="hidden-xs"><span id="note-<?=$p->id?>" ><?= $p->note; ?></span></td>
    <?php
    $foramt_inventory = 0;
    if (($p->inventory*2)%2 > 0) {
        $foramt_inventory = $p->inventory;
    } else {
        $foramt_inventory = number_format($p->inventory,0);
    }
    ?>
    <td class="new-inventory fa-2x font-bold"><?php echo $foramt_inventory?></td>
    
    <td class="font-bold"><span <?php if($p->estimates > 0) { echo 'class="badge bg-color-red"'; }?>><?= $p->estimates; ?></span></td>
    <td>
        <button type="button" class="quantity-button hidden-xs" name="subtract" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value--;" value="-">-</button>
        <input type="number" min="0" onkeypress="return Enter(event,<?=$p->id?>)"  class="quantity-field" id="qty<?=$p->id?>" 
            name="qty<?=$p->id?>" value="<?= ($p->estimates < $p->inventory) ? $p->estimates : $p->inventory ;?>" 
            data-inventory="<?= $p->inventory;?>"
        >
        <button type="button" class="quantity-button hidden-xs" name="add" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value++;" value="+">+</button>
    </td>
    <td class="text-center font-bold hidden-xs"><span class="label rounded label-red"></span></td>
    <td class="new-inventory text-center"><?php echo $p->valueMin?></td>
</tr>
<?php } ?>
<?php } else { echo "No data";} ?>

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
        $("input[type='number']").on("click", function () {
			$(this).select();
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