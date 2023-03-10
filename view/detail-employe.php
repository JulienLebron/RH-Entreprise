<?php
// echo '<pre>'; print_r($data); echo '</pre>';

$date = new DateTime($data['date_embauche']);
// echo $date->format('d-m-Y');
?>

<div class="container text-center mt-5">
    <div class="card" style="width: 20rem; margin: 0 auto;">
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
                        <td><?= $date->format('d-m-Y') ?></td>
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

    <div class="container text-center">
        <a href="?op=null" class="btn btn-primary mt-5"><i class="fa-solid fa-right-to-bracket"></i>&nbsp; Retourner sur Gestion des employés</a>
    </div>
</div>