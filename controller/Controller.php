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

        try
        {
            if($op == 'add' || $op == 'update')
                $this->save($op); // si on ajoute ou on modifie un employé, la méthode save() sera exécutée
            elseif($op == 'select')
                $this->select(); // si on sélectionne un employé, la méthode select() sera exécutée
            elseif($op == 'delete')
                $this->delete(); // si on supprime un employé, la méthode delete() sera exécutée
            elseif($op == 'action')
                $this->selectAllAction();
            else
                $this->selectAll(); // Dans les autres cas, nous voulons afficher l'ensemble des employés, la méthode selectAll() qui sera exécutée

        }
        catch(\Exception $e)
        {
            echo '<div style="width: 400px; padding: 10px; background: #D59797; border-radius: 4px; margin: 0 auto; color: white; text-align: center;">';
            echo "🛑 Une erreur s'est produite : " . $e->getMessage();
            echo '</div>';
        }
    }
}

