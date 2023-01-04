<?php

// echo '<pre>'; print_r($data); echo '</pre>';
// echo '<pre>'; print_r($fields); echo '</pre>';

?>


<table class="table table-bordered table-striped table-hover text-center">
    <thead class="table-dark">
        <tr>
            <th><?= $id ?></th>
            <?php foreach($fields AS $value): ?>
                <th><?= $value['Field'] ?></th>
            <?php endforeach; ?>
            <th>Consulter</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data AS $dataEmploye): ?>
            <tr>
                <td><?= implode('</td><td>', $dataEmploye); ?></td>
                <td><a href="?op=select&id=<?= $dataEmploye[$id] ?>" class="btn btn-success"><i class="fas fa-eye"></i></a></td>
                <td><a href="?op=update&id=<?= $dataEmploye[$id] ?>" class="btn btn-primary"><i class="far fa-edit"></i></a></td>
                <td><a href="?op=delete&id=<?= $dataEmploye[$id] ?>" class="btn btn-danger" onclick="return(confirm('⚠ Vous êtes sur le point de supprimer cet employé. En êtes vous certain ?'))"><i class="far fa-trash-alt"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>