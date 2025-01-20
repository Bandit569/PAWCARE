<?php

namespace Models;

use DateTime;
use Entities\RatingEntity;
use PDO;


class RatingModel
{

    private string $table;
    private PDO $conn;


    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance();
        $this->table = "rating";
    }
    public function getRatingsByCaretakerId($ratedId): array
    {
        $sql = "SELECT r.rating_id, r.rating, r.comments, r.service_request_id, r.timestamp
        From ".$this -> table." r
        Join service_request rs on rs.service_request_id = r.service_request_id
        Where rs.acceptor_id = :ratedId and rs.request_type != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ratedId', $ratedId, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ratings = [];
        foreach ($results as $row) {
            $ratings[] = new RatingEntity(
                $row['rating_id'],
                $row['rating'],
                $row['comments'],
                $row['service_request_id'],
                new DateTime($row['timestamp']),
            );
        }

        return $ratings;
    }

    public function getLastReviewByRatedId(int $ratedId): ?RatingEntity
    {
        $query = "SELECT r.rating_id, r.rating, r.comments, r.service_request_id, r.timestamp
        From ".$this -> table." r
        Join service_request rs on rs.service_request_id = r.service_request_id
        Where rs.acceptor_id = :ratedId and rs.request_type != 0
        Order by r.timestamp DESC
        LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ratedId', $ratedId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $timeStamp = new DateTime($result['timestamp']);
                return new RatingEntity(
                    (int)$result['rating_id'],
                    (int)$result['rating'],
                    $result['comments'],
                    $result["service_request_id"],
                    $timeStamp
                );
            }
        }

        return null; // No record found
    }

    public function getPetOwnerReviewAverageById(int $ratedId): int
    {
        $query = "SELECT AVG(r.rating) AS average_rating
              FROM " . $this->table . " r
              JOIN service_request rs ON rs.service_request_id = r.service_request_id
              WHERE rs.acceptor_id = :ratedId AND rs.request_type != 0";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ratedId', $ratedId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result && $result['average_rating'] !== null) {
                return (int)round($result['average_rating']); // Convert to int and round for clarity.
            }
        }

        return 0; // Return 0 if no results or the query fails.
    }




}