<?php

namespace controller;

class Controller 
{
    private $dbEntityRepository;

    public function __construct()
    {
        $this->dbEntityRepository = new \model\EntityRepository;
        // echo "✅ Instanciation de la class Controller réussi !";
    }

    // Méthode permettant le pilotage de notre application
    public function handleRequest()
    {
        session_start();

        // On stocke la valeur de l'indice "op" transmis dans l'url
        $op = isset($_GET['op']) ? $_GET['op'] : NULL;
        $alert = !empty($_GET['alert']) ? $_GET['alert'] : NULL;

        try
        {
            if($op == 'add' || $op == 'update')
                $this->save($op); // si on ajoute ou on modifie un employé, la méthode save() sera exécutée
            elseif($op == 'select')
                $this->select(); // si on sélectionne un employé, la méthode select() sera exécutée
            elseif($op == 'delete')
                $this->delete(); // si on supprime un employé, la méthode delete() sera exécutée
            else
                $this->selectAll($alert); // Dans les autres cas, nous voulons afficher l'ensemble des employés, la méthode selectAll() qui sera exécutée

        }
        catch(\Exception $e)
        {
            echo '<div style="width: 400px; padding: 10px; background: #D59797; border-radius: 4px; margin: 0 auto; color: white; text-align: center;">';
            echo "🛑 Une erreur s'est produite : " . $e->getMessage();
            echo '</div>';
        }
    }

    // Méthode permettant de construire une vue (une page de notre application)
    public function render($layout, $template, $parameters = [])
    {
        // extract() : fonction prédéfinie qui permet d'extraire chaque indice d'un tableau array sous forme de variable
        extract($parameters); // $parameters['employes'] ---> $employes
        // permet de faire une mise en tampon, on commence à garder en mémoire de la données
        ob_start();
        // Cette inclusion sera stockée directement dans la variable $content
        require_once "view/$template";
        // on stock dans la variable $content le template
        $content = ob_get_clean();
        // On temporise la sortie d'affichage
        ob_start();
        // On inclue le layout qui est le gabarit de base (header/nav/footer)
        require_once "view/$layout";
        // ob_end_flush() va libérer et fait tout apparître dans le navigateur
        return ob_end_flush();
    }

    // Méthode permettant d'afficher tous les employés
    public function selectAll($alert)
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $confirmation = (!empty($alert)) ? "✅ L'action sur l'employé n°$id à été effectuer avec succès !" : '';
        $this->render('layout.php', 'affichage-employes.php', [
            'title' => 'Affichage de tous les employes',
            'data' => $this->dbEntityRepository->selectAllEntityRepo(),
            'fields' => $this->dbEntityRepository->getFields(),
            'id' => 'id_' . $this->dbEntityRepository->table,
            'message' => "Ci-dessous vous trouverez un tableau contenant l'ensemble des employés de l'entreprise",
            'alert' => $confirmation
        ]);
    }
    
    // Méthode permettant de selectionner et d'afficher le détail d'un employé
    public function select()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $this->render('layout.php', 'detail-employe.php', [
            'title' => "Affichage du détail d'un employé",
            'data' => $this->dbEntityRepository->selectEntityRepo($id),
            'id' => 'id_' . $this->dbEntityRepository->table,
            'message' => "Ci dessous vous trouverez le détail de l'employé n°$id"
        ]);
    }
    
    // Méthode permettant de supprimer un employé
    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $res = $this->dbEntityRepository->deleteEntityRepo($id);
        
        $this->render('layout.php', 'affichage-employes.php', [
            'title' => 'Affichage de tous les employes',
            'data' => $this->dbEntityRepository->selectAllEntityRepo(),
            'fields' => $this->dbEntityRepository->getFields(),
            'id' => 'id_' . $this->dbEntityRepository->table,
            'message' => "Ci-dessous vous trouverez un tableau contenant l'ensemble des employés de l'entreprise",
            'alert' => "✅ L'employé n°$id à bien été supprimer de la base de données de l'entreprise"
        ]);
    }
    
    // Méthode permettant de faire une redirection
    public function redirect($location)
    {
        header('Location:' . $location);
    }
    
    // Méthode permettant d'enregistrer ou de modifier un employé
    public function save($op)
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $values = ($op == 'update') ? $this->dbEntityRepository->selectEntityRepo($id) : '';

        if($_POST)
        {
            $res = $this->dbEntityRepository->saveEntityRepo();
            $this->redirect("?alert=true&id=$id");
        }

        $this->render('layout.php', 'contact-form.php', [
            'title' => "Formulaire",
            'op' => $op,
            'fields' => $this->dbEntityRepository->getFields(),
            'values' => $values,
            'message' => "Ci-dessous vous trouverer le formulaire pour ajouter ou modifier un employé"
        ]);
    }
}

