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

/**
 * Zawszę mogę zrobić podobny projekt w oparciu o symfony. To już może być albo API, albo standardowa strona chociażby
 * z formami i będę tam mógł zrobić funkcje dzięki którym można wykonać operację CRUD na jakiejś encji User plus do tego
 * zapisywać te emaile i ich wystąpienia w jakiejś osobnej encji. Myślę, że wtedy by to lepiej wyglądało. Chociażby to
 * wyświetlanie by było na przyzwoitym poziomie na jakiejś stronie, ale to już zależy od Państwa
 */
