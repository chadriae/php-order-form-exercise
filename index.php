<?php

// declare(strict_types=1);

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'Cola', 'price' => 2.5],
    ['name' => 'Water', 'price' => 2.5],
    ['name' => 'Duvel', 'price' => 3.5],
];

$totalValue = 0;

$email = $_POST["email"];
$street = $_POST["street"];
$streetnumber = $_POST["streetnumber"];
$zipcode = $_POST["zipcode"];
$city = $_POST["city"];




if (isset($_POST['submit'])) {
    $price = 5;
    $amount = 0;

    foreach ($_POST['products'] as $selected) {
        $totalValue = $totalValue + $price;
        $amount++;
        // $name = $_POST['products'];
    }

    //check if email is valid and submitted
    $emailIsValid = true;



    if ($email !== "" && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST["email"];
        $emailIsValid = true;
    } elseif (empty($_POST["email"])) {
        $confirmationEmail = "<div class='alert alert-danger' role='alert'>Email is required.</div></br>";
        $emailIsValid = false;
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $confirmationEmail = "<div class='alert alert-danger' role='alert'>Email is not valid.</div></br>";
        $emailIsValid = false;
    }

    if ($emailIsValid = true) {
        $emailMessage = "email is valid";
    } else {
        $emailMessage = "not";
    }



    $errorMessage = array();

    if (empty($_POST['street'])) {
        $errorMessage['street'] = "Please fill in a street.";
    }
    if (empty($_POST['streetnumber'])) {
        $errorMessage['street'] = "Please fill in a streetnumber.";
    }
    if (empty($_POST['city'])) {
        $errorMessage['city'] = "Please fill in a city.";
    }
    if (empty($_POST['zipcode'])) {
        $errorMessage['zipcode'] = "Please fill in a zipcode.";
    } else {
        if (!is_numeric($zipcode)) {
            $errorMessage['zipcode'] = "Please fill in a valid zipcode, containing only numbers.";
        }
    }


    if (empty($_POST["email"]) || empty($_POST['street']) || empty($_POST['streetnumber']) || empty($_POST['city']) || empty($_POST['zipcode'])) {
        $confirmationMessage = "<div class='alert alert-danger' role='alert'>Please check the error messages.</br></div>";
    } else {
        $confirmationMessage =
            "<div class='alert alert-success' role='alert'>
        Thank you for your order! Your order details will be sent to your email address: $email.<br>
        This is your address:<br>
        $street $streetnumber<br>
        $zipcode $city.</br>
        
        </div>";
    }
}



require 'form-view.php';
