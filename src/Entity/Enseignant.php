<?php

namespace Poo\Heritage\Entity;

final class Enseignant extends Personne implements Affichable
{
    private $coursDonnés;
    private $entreeService;
    private $ancienneté;

    public function setCoursDonnés($coursDonnés)
    {
        $this->coursDonnés = $coursDonnés;
    }
    public function getCoursDonnés()
    {
        return $this->coursDonnés;
    }

    public function setEntreeService($entreeService)
    {
        $this->entreeService = $entreeService;
    }
    public function getEntreeService()
    {
        return $this->entreeService;
    }

    public function setAncienneté($ancienneté)
    {
        $this->ancienneté = $ancienneté;
    }
    public function getAncienneté()
    {
        return $this->ancienneté;
    }

    // Fonction d'hydratation qui prend en parm un tableau de valeur ouj objet
    public function hydrate(array $datas) {
        //On boucle dans notre tableau de valeurs
        //$datas[$cle] = valeur => expl : $tableauAdresse['id'] = 1, $tableauAdresse['rue'] = "rue neuve", etc..
        foreach ($datas as $cle => $valeur) {
            //on initialise une variable qui va prendre comme valeur le nom de nos fonctions 'setters'
            //ucfirst() transforme la première lettre en MAJ
            $nomMethode = "set" . ucfirst($cle);
            //si la méthode existe on fait appel à elle
            //
            if (method_exists($this, $nomMethode)) {
                $this->$nomMethode($valeur);
            }
        }
    }
    
    //Fonction resume obligatoire
    public function resume() {

        return "Information de l'enseignant : <br>
        - Nom : ". $this->nom . " ". $this->prenom."<br>
        - Adresse : ".$this->adresse." ".$this->cp. " ".$this->pays. "<br>";
    
    }

    public function __toString() {

        return "Je suis un 'objet' enseignant";

    }

    //méthodes de mon interface obligatoire
    public function bonjour() {

        echo "bonjour je suis dans mon Enseignant";
    }

    public function afficheTableau(){

        echo "<table border='1'> 
        <tr>";
        foreach ($datas as $cle => $valeur) {

            echo "<th>".$cle."</th>";
        }; 
        echo "</tr>";
        echo "<tr>";
        foreach ($datas as $cle => $valeur) {

            echo "<td>".$valeur."</td>";
        }; 
        echo "</tr>";
        echo "</table>";
    }

    public function afficheLigne(){
        
    }

    
}