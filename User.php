<?php

namespace user;

use chillerlan\QRCode\QRCode;
use service\Database;

class User
{
    /**
     * Możemy wziąć dane jednego użytkownika lub kilku w zależności z jakiego linka pobierzemy dane(kod w komentarzu)
     *
     * @return mixed
     */
    private function getUserDataFromURL(): mixed
    {
        $json = file_get_contents('https://jsonplaceholder.typicode.com/users/1');
        //$json = file_get_contents('https://jsonplaceholder.typicode.com/users/');
        return json_decode($json, true);
    }

    /**
     * Funkcja zwraca domeny emaili. W zależności czy wyszukiwaliśmy jednego użystkownika czy kilku
     *
     * @return mixed
     */
    public function fetchEmailDomain(): mixed
    {
        if (isset($this->getUserDataFromURL()['email'])) {
            $email = $this->getUserDataFromURL()['email'];
            return explode("@", $email)[1];
        }
        return $this->fetchEmailsDomains();
    }

    /**
     * @return array
     */
    private function fetchEmailsDomains(): array
    {
        $domains = [];
        foreach ($this->getUserDataFromURL() as $user) {
            $email = $user['email'];
            array_push($domains, explode("@", $email)[1]);
        }
        return $domains;
    }

    public function displayUserDataInJson()
    {
        echo json_encode($this->getUserDataFromURL());
    }

    /**
     * Kod QR jest generowany tylko gdy mamy dane jednego użytkownika inaczej zadziała kod z bloku catch
     */
    public function displayUserDataInQrCode()
    {
        try {
            $userData = $this->getUserDataFromURL();
            echo '<img src="' . (new QRCode())->render(json_encode($userData)) . '" alt="QR Code" />';

        } catch (\Exception $e) {
            echo "błąd: ", $e->getMessage();
        }

    }

    /**
     * funkcja wrzuca emaile do funkcji z klasy Database i tam są one zapisywane w bazie.
     * W zależności czy mamy jednego czy wielu użytkowników funkcja zachowa się inaczej
     */
    public function addEmailToDatabase(): void
    {
        $database = new Database();
        $emails = $this->fetchEmailDomain();

        if (!is_array($emails)) {
            $database->insertToDatabase($emails, 1);
        } else {
            $countedEmails = array_count_values($emails);
            $this->insertAllEmails($countedEmails, $database);
        }
    }

    /**
     * @param array $emails
     * @param Database $database
     */
    private function insertAllEmails(array $emails, Database $database): void
    {
        foreach ($emails as $key => $value) {
            $database->insertToDatabase($key, $value);
        }
    }
}