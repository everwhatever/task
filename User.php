<?php

namespace user;

use chillerlan\QRCode\QRCode;
use service\Database;

class User
{
    private function getUserDataFromURL():mixed
    {
        $json = file_get_contents('https://jsonplaceholder.typicode.com/users/1');
        return json_decode($json, true);
    }

    public function fetchEmailDomain(): mixed
    {
        if (isset($this->getUserDataFromURL()['email'])) {
            $email = $this->getUserDataFromURL()['email'];
            return explode("@", $email)[1];
        }
        return $this->fetchEmailsDomains();
    }

    private function fetchEmailsDomains():array
    {
        $domains = [];
        foreach ($this->getUserDataFromURL() as $user){
            $email = $user['email'];
            array_push($domains, explode("@", $email)[1]);
        }
        return $domains;
    }

    public function displayUserDataInJson()
    {
        echo json_encode($this->getUserDataFromURL());
    }

    public function displayUserDataInQrCode()
    {
        try {
            $userData = $this->getUserDataFromURL();
            echo '<img src="'.(new QRCode())->render(json_encode($userData)).'" alt="QR Code" />';

        }catch (\Exception $e){
            echo "błąd: ",$e->getMessage();
        }

    }

    public function addEmailToDatabase():void
    {
        $database = new Database();
        $emails = $this->fetchEmailDomain();

        if (!is_array($emails)){
            $database->insertToDatabase($emails,1);
        }else{
            $countedEmails = array_count_values($emails);
            $this->insertAllEmails($countedEmails, $database);
        }
    }

    private function insertAllEmails(array $emails, Database $database): void
    {
        foreach ($emails as $key => $value){
            $database->insertToDatabase($key, $value);
        }
    }
}