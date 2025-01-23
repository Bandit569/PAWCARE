<?php

namespace Entities;

class PetEntity
{
    private int $id;
    private String $name;
    private String $breed;
    private String $species;
    private int $age;
    private String $medication;
    private String $Info;
    private int $userId;

    public function __construct($id, $name, $breed, $species, $age, $medication, $Info, $userId){
        $this->id = $id;
        $this->name = $name;
        $this->breed = $breed;
        $this->species = $species;
        $this->age = $age;
        $this->medication = $medication;
        $this->Info = $Info;
    }

    public function getId(){
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getName(){
        return $this->name;
    }
    public function getBreed(){
        return $this->breed;
    }
    public function getSpecies(){
        return $this->species;
    }
    public function getAge(){
        return $this->age;
    }
    public function getMedication(){
        return $this->medication;
    }
    public function getInfo(){
        return $this->Info;
    }

}