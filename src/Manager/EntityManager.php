<?php

namespace Poo\Heritage\Manager;

use PDO;
//use Poo\Heritage\Entity\Personne;
use Faker\Factory;

abstract class EntityManager {

    public static $paramConnexion;

    public static function getParamConnexion(){
        return self::$paramConnexion;
    }
    
    /*
    public function setConnexion($connexion){
        $this->connexion = $connexion;
    }
    */

    //CRUD

    abstract public function create(Personne $personne);
    abstract public function read($id);
    //abstract public function update();
    //abstract public function delete();
        
}