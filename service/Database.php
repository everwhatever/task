<?php

namespace service;


use mysqli;

class Database
{

    /**
     * @param string|null $database
     * @return mysqli
     */
    private function createConnection(string $database = null): mysqli
    {
        $servername = "localhost";
        $username = "root";
        $password = "admin123";

        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }


    public function createDatabase(): void
    {
        $conn = $this->createConnection();
        $sql = "CREATE DATABASE smartbeesDB";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }

        $conn->close();
    }

    public function createEmailsTable(): void
    {
        $conn = $this->createConnection("smartbeesDB");

        $sql = "CREATE TABLE Emails (
                id INT  AUTO_INCREMENT PRIMARY KEY NOT NULL,
                email VARCHAR(100) NOT NULL,
                domain_occurrence INT
                )";

        if ($conn->query($sql) === TRUE) {
            echo "Table Emails created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        $conn->close();
    }

    /**
     * @param string $email
     * @param int $domainOccurrence
     */
    public function insertToDatabase(string $email, int $domainOccurrence): void
    {
        $conn = $this->createConnection('smartbeesDB');

        $query = "INSERT INTO Emails (email, domain_occurrence) 
             VALUES(?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $email, $domainOccurrence);
        $stmt->execute();
    }

}