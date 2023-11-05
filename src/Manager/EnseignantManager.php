<?php

namespace Poo\Heritage\Manager;

use PDO;
use Faker\Factory;
use Poo\Heritage\Entity\Enseignant;

class EnseignantManager extends EntityManager {

    private $connexion;

    public function __construct($connex) {
                 $this->connexion = $connex;
             }
             
    public function getConnexion(){
        return $this->connexion;
    }
             
    public function setConnexion($connexion){
        $this->connexion = $connexion;
    }

    //----C R U D----//
    //Fonction Create
    //avoir une méthode abstraite dans le parent ne sert à rien !
    //il y'a conflit si je met que je veux recevoir un objet qui vient de la classe 'Etudiant'
    //car ça ne respecte pas la signature de la méthode parent...
    //je dois utiliser cette même fonction dans Enseignant manager donc il y'a problème !
    // il faut du coup fair un code plus long et rajouter un if else
    public function create($etudiant) {

        //Vérifier si $etudiant est une instance de Etudiant
        if ($etudiant instanceof Enseignant) {
        
            // REQUETE SQL
            $stmt = $this->getConnexion()->prepare('
            INSERT INTO etudiant 	
            (id,nom,prenom,adresse,cp,pays)
                            VALUES
            (:id,:nom,:prenom,:adresse,:cp,:pays)
    ');

                // LIER LES VALEURS
            $stmt->bindValue(':id', $etudiant->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':nom', $etudiant->getNom());
            $stmt->bindValue(':prenom', $etudiant->getPrenom());
            $stmt->bindValue(':adresse', $etudiant->getAdresse());
            $stmt->bindValue(':cp', $etudiant->getCp());
            $stmt->bindValue(':pays', $etudiant->getPays());


            //On execute la requête sql
            $stmt->execute();

        } else {
            
            echo "problème ! l'objet n'est pas une instance de la classe enseignant ";

        }
        

    }

    //FONCTION READ
    public function read($id) {
        $id = (int) $id;
        
        $query = $this->getConnexion()->query(
            'SELECT id,nom,prenom,adresse,cp,pays
                FROM enseignant
            WHERE id = ' . $id
        );
        
        $datas = $query->fetch(PDO :: FETCH_ASSOC);

        echo "<br>";

        $newEnseignant = new Enseignant;

        $newEnseignant->hydrate($datas);

        return $newEnseignant;
        
    }

    //---- FONCTION UPDATE----//
    public function update(Enseignant $enseignant) {
    
        // REQUETE SQL
        $query = $this->getConnexion()->prepare(
                'UPDATE enseignant SET
                id=:id,
                nom=:nom,
                prenom=:prenom,
                adresse=:adresse,
                cp=:cp,
                pays=:pays
                WHERE id=:id
            ');
        
        // LIER LES VALEURS
        $query->bindValue(':id', $enseignant->getId(), PDO::PARAM_INT);
        $query->bindValue(':nom', $enseignant->getNom());
        $query->bindValue(':prenom', $enseignant->getPrenom());
        $query->bindValue(':adresse', $enseignant->getAdresse());
        $query->bindValue(':cp', $enseignant->getCp());
        $query->bindValue(':pays', $enseignant->getPays());
        
        // EXECUTER LA REQUETE  
        $query->execute();
        echo "la modification a été effectuée";
    }

    //----FONCTION DELETE----//
    public function delete(Enseignant $enseignant) {
        
        // SUPRESSION DE L'ADRESSE     
        $this->getConnexion()->exec(
            'DELETE FROM etudiant
            WHERE id = '.$enseignant->getId().'
            ');

            echo "la suppression a été effectuée";
        
    }

    
}