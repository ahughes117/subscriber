<?php

/**
 * A small subscriber php script. Parameters are posted from sample form subscriber.html 
 */

require_once 'util/mail_utils.php';
require_once 'util/opendb.php';
require_once 'config.php';

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
