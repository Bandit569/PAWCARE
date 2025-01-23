<?php

namespace Entities;


class ServiceRequestEntity
{
    private int $id;

    private \DateTime $date;

    private string $status;

    private UserEntity $user;

    private AddressEntity $address;

    private string $request_type;

    private string $service_type;

    private UserEntity $acceptor;

    private array $pets = []; // Ensure pets array is initialized

    public function __construct($id, $date, $status, $request_type, $service_type, $address, $user)
    {
        $this->id = $id;
        $this->date = $date;
        $this->status = $status;
        $this->user = $user;
        $this->address = $address;
        $this->request_type = $request_type;
        $this->service_type = $service_type;
    }

    /**
     * @param UserEntity $acceptor
     */
    public function setAcceptor(UserEntity $acceptor): void
    {
        $this->acceptor = $acceptor;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getUser(): UserEntity
    {
        return $this->user;
    }

    public function getAddress(): AddressEntity
    {
        return $this->address;
    }

    public function getRequestType(): string
    {
        return $this->request_type;
    }

    public function getServiceType(): string
    {
        return $this->service_type;
    }

    public function getAcceptor(): UserEntity
    {
        return $this->acceptor;
    }

    public function getPet(): array
    {
        return $this->pets;
    }

    public function addPet(PetEntity $pet): void
    {
        $this->pets[] = $pet;
    }

    // New Methods
    public function getPetName(): string
    {
        $names = array_map(fn($pet) => $pet->getName(), $this->pets);
        return implode(", ", $names);
    }

    public function getPetAge(): string
    {
        $ages = array_map(fn($pet) => $pet->getAge(), $this->pets);
        return implode(", ", $ages);
    }

    public function getPetBreed(): string
    {
        $breeds = array_map(fn($pet) => $pet->getBreed(), $this->pets);
        return implode(", ", $breeds);
    }

    public function getPetSpecies(): string
    {
        $species = array_map(fn($pet) => $pet->getSpecies(), $this->pets);
        return implode(", ", $species);
    }

    public function getPetInfo(): string
    {
        $info = array_map(fn($pet) => $pet->getInfo(), $this->pets);
        return implode("; ", $info); // Use semicolon to separate more detailed information
    }

    public function getPetMedication(){
        $medications = array_map(fn($pet) => $pet->getMedication(), $this->pets);
        return implode(", ", $medications);
    }
}
