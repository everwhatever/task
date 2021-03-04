<?php

use service\Database;
use user\User;

require_once("User.php");
require_once(__DIR__."/service/Database.php");
require_once(__DIR__."/vendor/autoload.php");

function createDatabaseTable(){
    $database = new Database();
    $database->createDatabase();
    $database->createEmailsTable();
}



function main(){
    $user = new User();
//    $user->fetchEmailDomain();
//    $user->displayUserDataInJson();
    $user->displayUserDataInQrCode();
    //$user->addEmailToDatabase();
}

//createDatabaseTable();
main();
