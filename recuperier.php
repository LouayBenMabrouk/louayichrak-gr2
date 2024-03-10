<?php
require_once('../connexion.php');
require_once('../user.php');

class cvC
{
    public function create($cv)
    {
        // Requête SQL pour l'insertion des données du CV
        $sql = "INSERT INTO cv`(nom`, adresse, telephone, email, Compétences, Nom de l'entreprise, Poste occupé, Date de début, Date de fin, Description des tâche, Nom de l'école, Diplôme obtenu, Année de début, Année de fin, Domaine d'étude) 
                VALUES (:nom, :adresse, :telephone, :email, :competences, :nom_entreprise, :poste_occupe, :date_debut, :date_fin, :description_tache, :nom_ecole, :diplome_obtenu, :annee_debut, :annee_fin, :domaine_etude)";

        // Récupérer l'instance de connexion à la base de données
        $db = config::getConnexion();

        try {
            // Préparer la requête SQL
            $query = $db->prepare($sql);

            // Exécuter la requête SQL avec les valeurs du CV
            $query->execute([
                'nom' => $cv['nom'],
                'adresse' => $cv['adresse'],
                'telephone' => $cv['telephone'],
                'email' => $cv['email'],
                'competences' => $cv['competences'],
                'nom_entreprise' => $cv['nom_entreprise'],
                'poste_occupe' => $cv['poste_occupe'],
                'date_debut' => $cv['date_debut'],
                'date_fin' => $cv['date_fin'],
                'description_tache' => $cv['description_tache'],
                'nom_ecole' => $cv['nom_ecole'],
                'diplome_obtenu' => $cv['diplome_obtenu'],
                'annee_debut' => $cv['annee_debut'],
                'annee_fin' => $cv['annee_fin'],
                'domaine_etude' => $cv['domaine_etude']
            ]);
        } catch (PDOException $e) {
            // Gérer les erreurs de la requête SQL
            echo "Erreur lors de l'insertion des données du CV : " . $e->getMessage();
        }
    }
}



    public function read()
    {
        $sql = "SELECT * FROM cv";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    public function delete()
    {
        if (isset($_GET['del'])) {
            $db = config::getConnexion();
            if (isset($_GET['del'])) {
                $id = $_GET['del'];
                $sql = "DELETE FROM cv WHERE id = '$id' ";
                $req = $db->prepare($sql);
                try {
                    $req->execute();
                    header("Location:dashboard.php");
                } catch (Exception $e) {
                    die('Erreur:' . $e->getMessage());
                }
            }
        }
    }

    public function sort($r)
    {
        $sql = "SELECT * FROM cv order by $r";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }