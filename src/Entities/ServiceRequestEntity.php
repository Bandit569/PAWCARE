<?php

namespace Entities;



class ServiceRequestEntity
{
    private int $id;

    private \DateTime $date;

    private string $status;

    private UserEntity $user;


    private AddressEntity  $address;

    private string $request_type;

    private String $service_type;

    private int $acceptor_id;

    private int $price;

    private string $description;


    public function __construct($id, $date, $status, $request_type, $service_type, $address, $description = "No Description", $price = 0,$user = null, $acceptor_id=-1){
        $this->id = $id;
        $this->date = $date;
        $this->status = $status;
        $this -> user = $user;
        $this->address = $address;
        $this->request_type = $request_type;
        $this->service_type = $service_type;
        $this->acceptor_id = $acceptor_id;
        $this->description = $description;
        $this->price = $price;

    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getDate(): \DateTime
    {
        return $this->date;
    }
    public function getStatus(): string{
        return $this->status;
    }
    public function getUser(): UserEntity
    {
        return $this->user;
    }
    public function getAddress(): AddressEntity{
        return $this->address;
    }
    public function getRequestType(): string{
        return $this->request_type;
    }
    public function getServiceType(): string{
        return $this->service_type;
    }
    public function getAcceptorId(): int{
        return $this->acceptor_id;
    }
    public function getDescription(): string{
        return $this->description;
    }
    public function getPrice(): float{
        return $this->price;
    }

}