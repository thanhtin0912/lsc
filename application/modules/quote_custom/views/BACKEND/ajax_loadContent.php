

    <?php foreach ($results as $key => $p) { ?>
        <div class="form-group">
            <label class="control-label col-md-2"><?= $p->name;?> : </label>
            <div class="col-md-3"><input value="<?= $p->value;?>" type="text" name="valueAdmincp[<?= $p->id;?>]" class="form-control"/></div>
        </div>
    <?php } ?>
