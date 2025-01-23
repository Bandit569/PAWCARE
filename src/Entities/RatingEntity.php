<?php

namespace Entities;



class RatingEntity
{
    private int $id;
    private int $rating;
    private string $comment;

    private int $serviceRequestId;
    private \DateTime $timestamp;



    private string $type;
    public function __construct(int $id, int $rating, string $comment,int $serviceRequestId, \DateTime $timestamp){
        $this->id = $id;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->timestamp = $timestamp;
        $this->serviceRequestId = $serviceRequestId;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getRating(): int
    {
        return $this->rating;
    }
    /**
     * @return int
     */public function getServiceRequestId(): int
{
    return $this->serviceRequestId;
}
    public function getComment(): string
    {
        return $this->comment;
    }

    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }




}