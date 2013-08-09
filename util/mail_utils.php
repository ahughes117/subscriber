<?php

/**
  Validate an email address.
  Provide email address (raw input)
  Returns true if the email address has the email
  address format and the domain exists.
 * It is the only correct way to check emails.
 * This is not my code. Source: http://www.linuxjournal.com/article/9585?page=0,3
 */
function validEmail($email) {
    $isValid = true;
    $atIndex = strrpos($email, "@");
    if (is_bool($atIndex) && !$atIndex) {
        $isValid = false;
    } else {
        $domain = substr($email, $atIndex + 1);
        $local = substr($email, 0, $atIndex);
        $localLen = strlen($local);
        $domainLen = strlen($domain);
        if ($localLen < 1 || $localLen > 64) {
        // local part length exceeded
            $isValid = false;
        } else if ($domainLen < 1 || $domainLen > 255) {
        // domain part length exceeded
            $isValid = false;
        } else if ($local[0] == '.' || $local[$localLen - 1] == '.') {
        // local part starts or ends with '.'
            $isValid = false;
        } else if (preg_match('/\\.\\./', $local)) {
        // local part has two consecutive dots
            $isValid = false;
        } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
        // character not valid in domain part
            $isValid = false;
        } else if (preg_match('/\\.\\./', $domain)) {
        // domain part has two consecutive dots
            $isValid = false;
        } else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local))) {
        // character not valid in local part unless 
        // local part is quoted
            if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local))) {
                $isValid = false;
            }
        }
        if ($isValid && !(checkdnsrr($domain, "MX") || checkdnsrr($domain, "A"))) {
        // domain not found in DNS
            $isValid = false;
        }
    }
    return $isValid;
}

/**
 * Sends a prepared statement string update to the database, containing the
 * following parameters:
 * 
 * @global type $mysqli
 * @param type $aQuery
 * @param type $aEmail
 * @param type $aName
 * @param type $aSurname
 * @return boolean 
 */
function insertEmail($aQuery, $aEmail, $aName, $aSurname) {
    global $mysqli;

    try {
        //prepare subscribe statement
        $stmt = $mysqli->prepare($aQuery);
        
        //checking if query well written
        if(!$stmt)
            throw new Exception();
        
        //execute subscribe statement
        $stmt->bind_param('sss', $aEmail, $aName, $aSurname);
        $stmt->execute();
        
        if (mysqli_error($mysqli))
            throw new Exception();
        
        if($stmt->affected_rows != 1)
            throw new Exception();
        
        //housekeeping and returning
        $stmt->close();
        return true;
    } catch (Exception $x) {
        return false;
    }
}

function sendMail($aName, $aFromAddress, $aMessage, $aToAddress, $aSubject) {
    $headers = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n" .
            'From: ' . $aFromAddress . "\r\n" .
            'Reply-To: ' . $aFromAddress . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    mail($aToAddress, '=?UTF-8?B?' . base64_encode($aSubject) . '?=' . $aName, $aMessage, $headers);
}

?>
