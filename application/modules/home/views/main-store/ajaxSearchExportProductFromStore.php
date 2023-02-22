
<?php if ($products) {?>
<?php foreach ($products as $key => $p) {?>
<tr>
    <td><?= $key +1; ?></td>
    <td class="font-bold"><?= $p->name; ?></td>
    <?php $total = 0;
        if (($p->totalExport*2)%2 > 0) { 
            $total = $p->totalExport;
        } else {
            $total = number_format($p->totalExport,0);
        }?>
    <td class="new-inventory fa-2x font-bold"><?=$total?></td>
    <td>
        <button type="button" class="quantity-button" name="subtract" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value--;" value="-">-</button>
        <input type="number" min="0" onkeypress="return Enter(event,<?=$p->id?>)"  class="quantity-field" name="qty<?=$p->id?>"  id="qty<?=$p->id?>" value="<?=$total?>" data-inventory="<?= $p->totalExport;?>">
        <button type="button" class="quantity-button" name="add" onclick="javascript: document.getElementById(&quot;qty<?=$p->id?>&quot;).value++;" value="+">+</button>
    </td>
    <td class="text-center font-bold"><span class="label rounded label-u"></span></td>
    <td>
        <button class="btn-u btn-u-xs rounded-4x btn-u-green btn-import" id="btn-save-<?=$p->id?>" type="button" onclick="saveQuoteInventory(<?=$p->id?>)"><i class="fa fa-cloud-download"></i></button>
    </td>
</tr>
<?php } ?>
<?php } ?>

<script type="text/javascript">
     $(document).ready(function() {
		$("input[type=number]").on('change',function(){
			var $button = $(this);
			if (parseFloat($button.parent().find('input').val()) <= 0){
				return $button.parent().find('input').val(0);
			}
		});
        $('#flexInputAll').click(function() {
			if ($(this).is(':checked')) {
				const collection = document.querySelectorAll(".btn-import")
				for (let i = 0; i < collection.length; i++) {
					collection[i].className += " d-none";
				}
				document.getElementsByClassName("handle-control")[0].classList.remove("d-none")
			} else {
				const collection = document.querySelectorAll(".btn-import")
				for (let i = 0; i < collection.length; i++) {
					collection[i].classList.remove("d-none")
				}
				document.getElementsByClassName("handle-control")[0].className += " d-none";
			}
		});
    });
    function Enter(e, id){
        if(e.keyCode == 13){ 
			var $button = $(this);
			if (parseFloat($button.parent().find('input').val()) <= 0){
				return $button.parent().find('input').val(0);
			}
            saveQuoteInventory(id);
        }
    }
	$(document).on('click', '.quantity-button', function() {
            var $button = $(this);
			if (parseFloat($button.parent().find('input').val()) <= 0){
				return $button.parent().find('input').val(0);
			}
	});

	function confirm() {
		$('#modalConfirm').modal('show');
		var p = <?php echo json_encode($products) ?>;
		var str = '' ;
		for (var i = 0; i < p.length; i++) {
			var checkQty = $('#qty' + p[i].id).val();
			if (checkQty > 0) {
				str += '<tr>';
				str += '<td>' + (i + 1) + '</td>';
				str += '<td class="font-bold">' + p[i].name + '</td>';
				str += '<td class="font-bold">' + p[i].totalExport + '</td>';
				str += '<td ><span class="badge bg-color-red font-16">' + checkQty+ '</span></td>';
				str += '</tr>';
			}
		}
		$('#tableDataConfirm').children().remove();
        $('#tableDataConfirm').append(str);
	}

</script>