<?php

/**
 * A small subscriber php script. Parameters are posted from sample form subscriber.html 
 */

include 'util/emailParser.php';
include 'util/opendb.php';
include 'config.php';

$email = $_POST['email'];
$name = $_POST['name'];
$surname = $_POST['surname'];

if (validEmail($email)) {
    insertEmail($subscribeQ, $email, $name, $surname);
    sendMail('', $dbName, $emailNotifStart . $email . $emailNotifEnd, 
            $emailL, 'subscriber');
    echo $sucMessage;
} else {
    echo $failMessage;
}

$mysqli->close();
?>
