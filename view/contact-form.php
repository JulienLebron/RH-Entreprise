<?php
echo '<pre>'; print_r($values); echo '</pre>';
?>

<form action="" method="post">
    <?php foreach($fields AS $field): ?>
        <div class="form-group">
            <label for="name" class="form-label"><?= ucfirst($field['Field']) ?></label>
            <input type="text" class="form-control" name="<?= $field['Field'] ?>" value="<?= ($op == 'update') ? $values[$field['Field']] : ''; ?>">
        </div>
    <?php endforeach; ?>
    <div class="text-center mt-5">
        <button type="submit" class="btn btn-primary">Valider</button>
    </div>
</form>