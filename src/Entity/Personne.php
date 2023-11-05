<?php

namespace Poo\Heritage\Entity;

abstract class Personne
{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $adresse;
    protected $cp;
    protected $pays;
    protected $societe;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    public function getNom()
    {
        return strtoupper($this->nom);
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function setCp($cp)
    {
        $this->cp = $cp;
    }
    public function getCp()
    {
        return $this->cp;
    }
    public function setPays($pays)
    {
        $this->pays = $pays;
    }
    public function getPays()
    {
        return strtoupper($this->pays);
    }
    public function setSociete($societe)
    {
        $this->societe = $societe;
    }
    public function getSociete()
    {
        return $this->societe;
    }

    //ne pas ouvrir les '{}'
    //une fonction abstraite va forcer les classes filles à l'utiliser
    abstract public function resume();
}