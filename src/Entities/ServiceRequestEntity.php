<?php

namespace Entities;



class ServiceRequestEntity
{
    private int $id;

    private \DateTime $date;

    private string $status;

    private int $user_id;


    private AddressEntity  $address;

    private string $request_type;

    private String $service_type;

    private int $acceptor_id;


    public function __construct($id, $date, $status, $request_type, $service_type, $address, $user_id, $acceptor_id=-1){
        $this->id = $id;
        $this->date = $date;
        $this->status = $status;
        $this->user_id = $user_id;
        $this->address = $address;
        $this->request_type = $request_type;
        $this->service_type = $service_type;
        $this->acceptor_id = $acceptor_id;

    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getDate(): Date{
        return $this->date;
    }
    public function getStatus(): string{
        return $this->status;
    }
    public function getUserId(): int{
        return $this->user_id;
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
}