<?php

/**
 * A small subscriber php script. Parameters are posted from sample form subscriber.html 
 */
require_once 'util/mail_utils.php';
require_once 'util/opendb.php';
require_once 'config.php';

//remove for production version
//error_reporting(E_ALL | E_STRICT);
//ini_set("display_errors", "1");

$email = $_POST['email'];
$name = $_POST['name'];
$surname = $_POST['surname'];

if (validEmail($email)) {
    if (insertEmail($subscribeQ, $email, $name, $surname)) {
        sendMail($fromAddress, $dbName, $emailNotifStart . $email . $emailNotifEnd . $_SERVER['REMOTE_ADDR'] . "</b>", $emailL, 'subscriber');
        echo $sucMessage;
    } else {
        echo $failMessage;
    }
} else {
    echo $failMessage;
}

$mysqli->close();
?>
