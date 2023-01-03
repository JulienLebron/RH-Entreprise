<?php

namespace model;

use Exception;

class EntityRepository
{
    private $db; // permet de stocker un objet issu de la PDO (la connexion à la BDD)
    public $table; // permet de stocker le nom de la table SQL afin de l'injecter dans les différentes requêtes SQL

    // Méthode permettant de construire la connexion à la BDD
    public function getDb()
    {
        if(!$this->db)
        {
            try
            {
                // simplexml_load_file() : fonction prédéfinie de PHP qui permet de charger un fichier XML et retourne un objet PHP SimpleXMLElement contenant toutes les informations du fichier
                $xml = simplexml_load_file('../app/config.xml');
                // echo '<pre>'; print_r($xml); echo '</pre>';

                // On affecte le nom de la table récupéré via le fichier XML
                $this->table = $xml->table;

                try // On tente d'exécuter la connexion à la base de données
                {
                    //
                    $this->db = new \PDO("mysql:host=" . $xml->host . ";dbname=" . $xml->db, $xml->user, $xml->password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
                }
                catch(\PDOException $e)
                {
                    // 
                    echo '<div style="width: 400px; padding: 10px; background: #D59797; border-radius: 4px; margin: 0 auto; color: white; text-align: center;">';
                    echo "🛑 Une erreur s'est produite pendant la connexion à la BDD : " . $e->getMessage();
                    echo '</div>';
                }

            }
            catch(Exception $e)
            {
                echo '<div style="width: 400px; padding: 10px; background: #D59797; border-radius: 4px; margin: 0 auto; color: white; text-align: center;">';
                echo "🛑 Une erreur s'est produite pendant le chargement du fichier XML : " . $e->getMessage();
                echo '</div>';
            }
        }
        // print_r($this->db);
        return $this->db;
    }
}

// TEST

// $e = new EntityRepository;
// $e->getDb();




