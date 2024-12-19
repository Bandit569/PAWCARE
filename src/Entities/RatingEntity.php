<?php

namespace Entities;

use MongoDB\BSON\Timestamp;

class RatingEntity
{
    private int $id;
    private int $rating;
    private string $comment;
    private int $rater_id;
    private int $rated_id;
    private Timestamp $timestamp;

    private string $type;
    public function __construct(int $id, int $rating, string $comment, int $rater_id, int $rated_id, Timestamp $timestamp, $type){
        $this->id = $id;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->rater_id = $rater_id;
        $this->rated_id = $rated_id;
        $this->timestamp = $timestamp;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getRating(): int
    {
        return $this->rating;
    }
    public function getComment(): string
    {
        return $this->comment;
    }
    public function getRaterId(): int
    {
        return $this->rater_id;
    }
    public function getRatedId(): int
    {
        return $this->rated_id;
    }
    public function getTimestamp(): Timestamp
    {
        return $this->timestamp;
    }

}