<?php

include 'util/emailParser.php';
include 'util/opendb.php';
include 'config.php';

$email = $_POST['email'];
$name = $_POST['name'];
$surname = $_POST['surname'];

if (validEmail($email)) {
    insertEmail($subscribeQ, $email, $name, $surname);
    echo $sucMessage;
} else {
    echo $failMessage;
}

$mysqli->close();
?>
