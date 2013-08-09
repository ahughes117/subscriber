<?php

/**
 * Configuration file containing database connection info and database
 * structure info...
 */

//The url of the database
$dbhost = 'aUrl';

//username and password
$dbuser = 'aUser';
$dbpass = 'aPass';

//Name of database - schema
$dbname = 'aSchema';

//Email Table Name
$emailT = 'aTable';

//Email Address Column
$emailC = 'anEmailC';

//email list for notification
$emailL = 'anEmailList';

//Name Column
$nameC = "aNameC";

//Surname Column
$surnameC = "aSurnameC";

//IP Column
$ipC = "anIpC";

//Agent Column
$agentC = "anAgentC";

//Email fromAddress
$fromAddress = "aFromAddress";

//query designed for database...
$subscribeQ = "
    INSERT INTO `{$emailT}` (`{$emailC}`, `{$nameC}`, `{$surnameC}`, `{$ipC}`, `{$agentC}`) VALUES 
        (?, ?, ?, ?, ?) ";

//email message notification start and end
$emailNotifStart = 'Email Address: <b>';
$emailNotifEnd = '</b></br>has been succesfully subscribed to ' . $dbname . ' database.<br><b>IP Address: ';

//success message. Edit the link to redirect wherever you like to.
$sucMessage = '</br>Your address has been subscribed to our newsletter database.</br>' .
        'Click <a href="http://www.google.com">here</a> to continue';

//fail message. Edit the link to redirect wherever you like to.
$failMessage = '</br>Fatal Error while processing your address</br>' .
        'Click <a href="http://www.google.com">here</a> to continue';
?>
