<?php

$can_post = '/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/';
$can_phone = '/^([0-9]{3})-[0-9]{3}-[0-9]{4}$/';
$GLOBALS['Is_valid'] = true;
$GLOBALS['valid_Check'] = true;
$valid =FALSE;
$name = $_POST["name"];
$Amount = $_POST["pAmount"];
$Rate = $_POST["iRate"];
$year = $_POST["years"];
$pCode = $_POST["pCode"];
$pNumber = $_POST["pNumber"];
$eAddress = $_POST["eAddress"];
$contactpref = $_POST["pref"];
$pref = $_POST["prefchk"];
$can_name = "/^[a-zA-Z'-]+$/";
#$count = 0;
if($_SERVER["REQUEST_METHOD"] =="POST"){
function checkbox() {
    if (!isset($_POST['checkbox'])) {
        global $errorCheckbox;
        $errorCheckbox = "you must agree with the terms and conditions";
        global $valid;
        $valid = FALSE;
    } else {
        global $valid;
        $valid = TRUE;
    }
}


function ValidateName($can_name, $name) {
    if (!preg_match($can_name, $name) || empty($name)) {
        $nameError = "*Invalid name,Please try again";
        $GLOBALS['Is_valid'] = false;
       
        return $nameError;
    }
}

$name1 = ValidateName($can_name, $name);

function ValidateCode($can_post, $pCode) {
    if (!preg_match($can_post, $pCode) || empty($pCode)) {
        $pcodeError = "*Invalid Postal Code,Please try again";
        $GLOBALS['Is_valid'] = false;
               

        return $pcodeError;
    }
}

$pcode1 = ValidateCode($can_post, $pCode);

function ValidatePhone($can_phone, $pNumber) {
    if (!preg_match($can_phone, $pNumber) || empty($pNumber)) {
        $pNumberError = "*Invalid Phone number,Please try again";
        $GLOBALS['Is_valid'] = false;
               
        return $pNumberError;
    }
}

$phone = ValidatePhone($can_phone, $pNumber);

function ValidateEmail($eAddress) {
    if (!filter_var($eAddress, FILTER_VALIDATE_EMAIL)) {
        $emailError = "*Invalid email ,Please try again";
        $GLOBALS['Is_valid'] = false;
               

        return $emailError;
    }
}

$email2 = ValidateEmail($eAddress, FILTER_VALIDATE_EMAIL);

function ValidatePrincipal($Amount) {
    if (empty($Amount) || $Amount < 0 || (!is_numeric($Amount))) {
        $AmountError = "*Amount should be filled and numeric and greater than 0";
        $GLOBALS['valid_Check'] = false;
        return $AmountError;
    }
}

$amount = ValidatePrincipal($Amount);

function ValidateRate($Rate) {
    if (empty($Rate) || $Rate < 0 || (!is_numeric($Rate))) {
        $RateError = "*Rate is Required and Rate should be numeric and not negative<br/><br/>";
        $GLOBALS['valid_Check'] = false;
        return $RateError;
    }
}

$rate = ValidateRate($Rate);

function ValidateYears($year) {
    if (($year > 20 ) || ($year < 1)) {
        $yearError = "*Number of years to deposit must be a numeric between 1 and 20.<br/><br/>";
        $GLOBALS['valid_Check'] = false;
        return $yearError;
    }
}

$yearError = ValidateYears($year);

function ValidatePref($contactpref, $pref) {
    if ($contactpref == "Phone" && empty($pref)) {
        $prefError = "* When preferred contact method is phone, you have to select contact time";
        $GLOBALS['Is_valid'] = false;
       
        return $prefError;
    }
}

$valpref = ValidatePref($contactpref, $pref);
}

?>