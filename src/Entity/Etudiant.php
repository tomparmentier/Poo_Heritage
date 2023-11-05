<?php

namespace Poo\Heritage\Entity;

final class Etudiant extends Personne implements Affichable
{
    private $coursSuivis = [];
    private $niveau;
    private $dateInscription;

    public function hydrate(array $datas) {

        foreach ($datas as $cle => $valeur) {

            $nomMethode = "set" . ucfirst($cle);

            if (method_exists($this, $nomMethode)) {
                $this->$nomMethode($valeur);
            }
        }
    }


    public function setCoursSuivis($coursSuivis)
    {
        $this->coursSuivis = $coursSuivis;
    }
    public function getCoursSuivis()
    {
        return $this->coursSuivis;
    }
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }
    public function getNiveau()
    {
        return $this->niveau;
    }
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }
    public function getDateInscription()
    {
        return $this->dateInscription;
    }
    
    //Fonction resume obligatoire
    public function resume() {

        return "Information de l'étudiant : <br>
        - Nom : ". $this->nom . " " . $this->prenom ."<br>
        - Adresse : ".$this->adresse." ".$this->cp. " ".$this->pays. "<br>";
        
    }

    public function __toString() {

        return "Je suis un 'objet' etudiant";

    }

    //méthodes de mon interface obligatoire
    public function bonjour() {

        echo "bonjour je suis dans ma classe Etudiant";
    }

    public function afficheTableau(){

        $attributs = get_object_vars($this);

        echo "<table border='1'> 
        <tr>";
        foreach (array_keys($attributs) as $nomAttribut) {
            echo '<th>' . ucfirst($nomAttribut) . '</th>';
        } 
        echo "</tr>";
        echo "<tr>";
        foreach ($attributs as $valeur) {
            echo '<td>' . $valeur . '</td>';
        } 
        echo "</tr>";
        echo "</table>";
    }

    public function afficheLigne(){

        echo $this->nom. ", ".$this->prenom.", etc etc";

    }
}