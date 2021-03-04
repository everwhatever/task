<?php

use service\Database;
use user\User;

require_once("User.php");
require_once(__DIR__."/service/Database.php");
require_once(__DIR__."/vendor/autoload.php");

/**
 * funkcja do tworzenia bazy danych i utworzenia tabeli. Wywoływana osobno by tylko raz stworzyć potrzebną tabelę
 */
function createDatabaseTable(){
    $database = new Database();
    $database->createDatabase();
    $database->createEmailsTable();
}


/**
 * funkcja main odpowiada za wywołanie wszytskich funkcji jedna za drugą
 */
function main(){
    $user = new User();
    $user->fetchEmailDomain();
    $user->displayUserDataInJson();
    $user->displayUserDataInQrCode();
    $user->addEmailToDatabase();
}

createDatabaseTable();
main();
