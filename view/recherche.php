<?php
// echo $date->format('d-m-Y');
if(!empty($result))
{

?>
<div class="alert alert-success text-center">✅ Nombre de résultat(s) : <?= sizeof($result); ?></div>
<div class="container d-flex justify-content-around flex-wrap text-center mt-5">
    <?php foreach($result AS $data): ?>

    <div class="card mb-5" style="width: 20rem; margin: 0 auto;">
        <?php
                if($data['sexe'] == 'm')
                {
                    echo '<img src="https://picsum.photos/id/1005/200/150" alt="photo du salarié" class="card-img-top">';
                }
                else
                {
                    echo '<img src="https://picsum.photos/id/1011/200/150" alt="photo du salarié" class="card-img-top">';
                }
                ?>
        <div class="card-body">
            <h5 class="card-title"><?= $data['prenom'] . ' ' . $data['nom'] ?></h5>
            <table class="table table-bordered mt-4 mb-4">
                <tbody>
                    <tr>
                        <th scope="row">🔰 Id_employé</th>
                        <td><?= $data['id_employes'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fa-solid fa-venus-mars"></i> Sexe</th>
                        <td><?= $data['sexe'] . ' '  ?></td>
                    </tr>
                    <tr>
                        <th scope="row">🏭 Service</th>
                        <td><?= $data['service'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">📑 Date Embauche</th>
                        <td><?= $data['date_embauche'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">💰 Salaire</th>
                        <td><?= $data['salaire'] . ' €'?></td>
                    </tr>
                </tbody>
            </table>
            <div class="container">
                <a href="?op=update&id=<?= $data['id_employes'] ?>" class="btn btn-warning"><i
                        class="fa-sharp fa-solid fa-user-pen"></i></a>
                <a href="?op=delete&id=<?= $data['id_employes'] ?>" class="btn btn-danger"
                    onclick="return(confirm('⚠ Vous êtes sur le point de supprimer cet employé. En êtes vous certain ?'))"><i
                        class="fa-solid fa-user-xmark"></i></a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php
}
else
{
    echo '<div class="alert alert-danger text-center">⚠ Aucun résultat ne correspond à votre recherche !</div>';
}
    