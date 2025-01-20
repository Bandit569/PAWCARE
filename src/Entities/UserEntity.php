<?php

namespace Entities;

use Models\RatingModel;

class UserEntity
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;

    private string $userName;

    private UserTypeEntity $userType;
    private ?int $contactNumber;

    public function __construct($id,$firstName, $lastName, $email, $userName, $userType, ?int $contactNumber = null){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->userName = $userName;
        $this->userType = $userType;
        $this->contactNumber = $contactNumber;
        $this->id = $id;
    }
    public function getId(): int{
        return $this->id;
    }
    public function getFirstName(): string{
        return $this->firstName;
    }
    public function getLastName(): string{
        return $this->lastName;
    }
    public function getEmail(): string{
        return $this->email;
    }
    public function getUserName(): string{
        return $this->userName;
    }
    public function getUserType(): UserTypeEntity
    {
        return $this->userType;
    }
    public function getContactNumber(): int{
        return $this->contactNumber;
    }
    public function getPetOwnerReviewAverage(): int{
        $ratingModel = new RatingModel();

        return $ratingModel -> getPetOwnerReviewAverageById($this->id);
    }

    public function getLastReview(): ?RatingEntity
    {
        $ratingModel = new RatingModel();
        return $ratingModel -> getLastReviewByRatedId($this->id);

    }
}