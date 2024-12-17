<?php

namespace Models;

class AddressEntity
{
    private int $id;
    private int $flat_number;
    private string $street;
    private string $town;
    private string $country;
    private int $user_id;

    public function __construct(int $id, int $flat_number, string $street, string $town, string $country, int $user_id){
        $this->id = $id;
        $this->flat_number = $flat_number;
        $this->street = $street;
        $this->town = $town;
        $this->country = $country;
        $this->user_id = $user_id;
    }

    public function getId(): int{
        return $this->id;
    }
    public function getFlatNumber(): int{
        return $this->flat_number;
    }
    public function getStreet(): string{
        return $this->street;
    }
    public function getTown(): string{
        return $this->town;
    }
    public function getCountry(): string{
        return $this->country;
    }
    public function getUserId(): int{
        return $this->user_id;
    }

}