<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

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


if (isset($_POST['submit'])) {
    $price = 5;
    $amount = 0;

    foreach ($_POST['products'] as $selected) {
        $totalValue = $totalValue + $price;
        $amount++;
        // $name = $_POST['products'];
    }

    //check if email is valid and submitted
    if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST["email"];
        $confirmationEmail =
            "<div class='alert alert-success' role='alert'>
            Thank you for your order! Your order will be emailed to: $email.</br>
            </div>";
    } elseif (empty($_POST["email"])) {
        $confirmationEmail = "<div class='alert alert-danger' role='alert'>Email is required.</div></br>";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $confirmationEmail = "<div class='alert alert-danger' role='alert'>Email is not valid.</div></br>";
    }
}


require 'form-view.php';
