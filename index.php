<?php

require_once 'vendor/autoload.php';

use Poo\Heritage\Entity\Personne;
use Poo\Heritage\Entity\Etudiant;
use Poo\Heritage\Entity\Enseignant;
use Poo\Heritage\Manager\EntityManager;
use Poo\Heritage\Manager\EtudiantManager;
use Poo\Heritage\Manager\EnseignantManager;

echo "<h1>Examen Poo Héritage</h1>";

$etudiant1 = new Etudiant;
$enseignant1 = new Enseignant;
$personnes = [$etudiant1, $enseignant1];

//données en "dure" pour un étudiant
$datasEtudiant1 = [

    'nom' => 'Parmentier',
    'prenom' => 'Tom',
    'adresse' => 'Rue des Ardennes',
    'cp' => '5000',
    'pays' => 'Belgique',
    'cours suivis' => ["math", "français"],
    'niveau' => 'moyen',
    "date d'inscription" => "15/01/1995"

];
// j'hydrate mon objet avec mes données grâce à ma fonction hydrate
$etudiant1->hydrate($datasEtudiant1);

//MEME CHOSE POUR ENSEIGNANT mais juste en "settant" les attributs 
$enseignant1->setNom("D'enfer");
$enseignant1->setPrenom("Cruela");
$enseignant1->setAdresse("Gros chateau Gotique");
$enseignant1->setCp("666");
$enseignant1->setPays("DisneyLand");

//UTILISATION DE LA FONCTION RESUME()
echo "<h3> 1) Utilisationde la fonction resume()</h3>";

foreach ($personnes as $personne) {

    $information = $personne->resume();
    echo $information;
    echo "<br>";
    
}

echo "<h3> 2) Affichage Etudiant et Enseignant avec echo</h3>";
//Utilisation de __tostring simplement en echo mon objet
echo $enseignant1;
echo "<br>";
echo $etudiant1;
echo "<br>";



//UTILISATION DE LA FONCTION AFFICHETABLEAU() et AFFICHELIGNE()
echo "<h3> 3) Utilisationde la fonction afficheTableau() et afficheLigne()</h3>";
$etudiant1->afficheTableau();
echo "<br>";
$etudiant1->afficheLigne();
echo "<br>";
echo "<br>";



//CRUD
echo "<h3>Test CRUD</h3>";

//Connexion à la db via PDO
EntityManager::$paramConnexion = "mysql:host=localhost;dbname=poo_exercices;charset=utf8mb4";
//echo EntityManager::$paramConnexion;
$co = EntityManager::getParamConnexion();
$utilisateur = 'root';
$motDePasse = '';
$pdo = new PDO($co, $utilisateur, $motDePasse);
echo "<h5>Test fonction create</h5>";
$etudiantManager = new EtudiantManager($pdo);
//$etudiantManager->create($etudiant1);
echo "<h5>Test fonction read</h5>";
$EtudiantId1 = $etudiantManager->read(1);
echo $EtudiantId1->resume();
echo "<h5>Test fonction update</h5>";
//je reprend mon nouvel objet qui vient d'être créé ($EtudiantId1)
//je lui effectue des modif et j'update
$EtudiantId1->setNom("Grand");
$etudiantManager->update($EtudiantId1);
