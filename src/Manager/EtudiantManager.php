<?php

namespace Poo\Heritage\Manager;

use PDO;
use Faker\Factory;
use Poo\Heritage\Entity\Etudiant;

class EtudiantManager extends EntityManager {

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

    //Fonction CREATE
    //avoir une méthode abstraite dans le parent ne sert à rien.
    //il y'a conflit si je met que je veux recevoir un objet qui vient de la classe 'Etudiant'
    //car ça ne respecte pas la signature de la méthode parent...
    //je dois utiliser cette même fonction dans Enseignant manager donc il y'a problème !
    // il faut du coup faire un code plus long et rajouter un if else pour vérifier que c'est bien 
    //une instance de la classe qu'on souhaite
    public function create($etudiant) {

        //Vérifier si $etudiant est une instance de Etudiant
        if ($etudiant instanceof Etudiant) {
        
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
            echo "l'enregestriment à été effectué";

        } else {
            
            echo "problème ! l'objet n'est pas une instance d'étudiant ";

        }
        

    }

    //FONCTION READ
    public function read($id) {
        $id = (int) $id;
        
        $query = $this->getConnexion()->query(
            'SELECT id,nom,prenom,adresse,cp,pays
                FROM etudiant
            WHERE id = ' . $id
        );
        
        $datas = $query->fetch(PDO :: FETCH_ASSOC);

        echo "<br>";

        $newEtudiant = new Etudiant;

        $newEtudiant->hydrate($datas);

        return $newEtudiant;
        
    }

    //---- FONCTION UPDATE----//
    public function update(Etudiant $etudiant) {
    
        // REQUETE SQL
        $query = $this->getConnexion()->prepare(
                'UPDATE etudiant SET
                id=:id,
                nom=:nom,
                prenom=:prenom,
                adresse=:adresse,
                cp=:cp,
                pays=:pays
                WHERE id=:id
            ');
        
        // LIER LES VALEURS
        $query->bindValue(':id', $etudiant->getId(), PDO::PARAM_INT);
        $query->bindValue(':nom', $etudiant->getNom());
        $query->bindValue(':prenom', $etudiant->getPrenom());
        $query->bindValue(':adresse', $etudiant->getAdresse());
        $query->bindValue(':cp', $etudiant->getCp());
        $query->bindValue(':pays', $etudiant->getPays());
        
        // EXECUTER LA REQUETE  
        $query->execute();
        echo "la modification a été effectuée";
    }

    //----FONCTION DELETE----//


    public function delete(Etudiant $etudiant) {
        
        // SUPRESSION DE L'ADRESSE     
        $this->getConnexion()->exec(
            'DELETE FROM etudiant
            WHERE id = '.$etudiant->getId().'
            ');

            echo "la suppression a été effectuée";
        
    }
    
}