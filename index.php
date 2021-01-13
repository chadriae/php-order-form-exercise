//TODO fill in form with cookie variables <br>
<?php
// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
// declare(strict_types=1);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// We are going to use session variables so we need to enable sessions
session_start();
session_set_cookie_params(0);

require 'product.php';

// Use this function when you need to need an overview of these variables
function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    echo '<pre>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    echo '<pre>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    echo '<pre>';
    var_dump($_SESSION);
}

// whatIsHappening();


$product1 = new Product();
$product1->setNewProduct("Jack Rose", 18.5);

$product2 = new Product();
$product2->setNewProduct("Horse's neck", 20.5);

$product3 = new Product();
$product3->setNewProduct("Chicago cocktail", 17.5);

$product4 = new Product();
$product4->setNewProduct("Savoy Affair", 23.5);

$product5 = new Product();
$product5->setNewProduct("Panama", 19.5);


$products = [
    $product1,
    $product2,
    $product3,
    $product4,
    $product5
];

var_dump($products[4]->price);


// if loop to get global variable for total value (if a cookie is set or not)
if (isset($_COOKIE['valueOrders'])) {
    $totalValue = $_COOKIE['valueOrders'];
} else {
    $totalValue = 0;
}


// if loop to get variables (if session is set or not)
if ($_SESSION) {
    $email = $_SESSION['email'];
    $street = $_SESSION['street'];
    $streetnumber = $_SESSION['streetnumber'];
    $city = $_SESSION['city'];
    $zipcode = $_SESSION['zipcode'];
} else {
    $email = "";
    $street = "";
    $streetnumber = "";
    $city = "";
    $zipcode = "";
}

if (empty($_GET) || $_GET['alcohol'] == 1) {
    $cocktailsAlcohol = [
        ['name' => 'Margarita', 'price' => 8.5],
        ['name' => 'Cosmopolitan', 'price' => 10.5],
        ['name' => 'Martini dry', 'price' => 7.5],
        ['name' => 'Gin & Tonic', 'price' => 13.5],
        ['name' => 'Cuba Libre', 'price' => 9.5],
    ];
} else {
    $cocktailsAlcohol = [
        ['name' => 'Virgin Margarita', 'price' => 8.5],
        ['name' => 'Virgin Cosmopolitan', 'price' => 10.5],
        ['name' => 'Virgin Martini dry', 'price' => 7.5],
        ['name' => 'Virgin Gin & Tonic', 'price' => 13.5],
        ['name' => 'Virgin Cuba Libre', 'price' => 9.5],
    ];
}




// Everything after pressing ORDER NOW!
if (isset($_POST['submit'])) {

    $email = $_SESSION['email'] = $_POST['email'];
    $street = $_SESSION['street'] = $_POST['street'];
    $streetnumber = $_SESSION['streetnumber'] = $_POST['streetnumber'];
    $city = $_SESSION['city'] = $_POST['city'];
    $zipcode = $_SESSION['zipcode'] = $_POST['zipcode'];

    $orderTotal = 0;

    if (!isset($_POST['products'])) {
        $orderMessage = "<div class='alert alert-warning' role='alert'>Please order a product first.";
        $totalMessage = "</div>";
    } else {
        foreach ($_POST['products'] as $i => $product) {
            $orderMessage = "<div class='alert alert-info' role='alert'>You ordered:";
            $orderedProducts[$i] = $cocktailsAlcohol[$i]['name'];
            $orderTotal += ($cocktailsAlcohol[$i]['price']);
            $totalMessage = count($orderedProducts) . " items for a total price of &euro;" . $orderTotal . " in drinks.</div>";
        }
    }


    if (empty($_POST["email"]) || empty($_POST['street']) || empty($_POST['streetnumber']) || empty($_POST['city']) || empty($_POST['zipcode'])) {

        $confirmationMessage = "<div class='alert alert-danger' role='alert'>Please check the error messages.</br></div>";

        if ($email !== "" && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $confirmationEmail = "<div class='alert alert-success' role='alert'>Email is valid.</div></br>";
        } elseif (empty($_POST["email"])) {
            $confirmationEmail = "<div class='alert alert-danger' role='alert'>Email is required.</div></br>";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $confirmationEmail = "<div class='alert alert-danger' role='alert'>Email is not valid.</div></br>";
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
    } else {
        // Last step if everything is filled in correctly

        //Total value: If cookie is not created create cookie for total order value of site
        if (!isset($_COOKIE['valueOrders'])) {
            $totalValue += $orderTotal;
            setcookie('valueOrders', strval($totalValue), time() + (86400 * 365), "/");
        } else {
            $totalValue += $orderTotal;
            setcookie('valueOrders', strval($totalValue), time() + (86400 * 365), "/");
        }


        $confirmationMessage =
            "<div class='alert alert-success' role='alert'>
        Thank you for your order! Your 
        Your order details will be sent to your email address: $email.<br>
        This is your address:<br>
        $street $streetnumber<br>
        $zipcode $city.</br>
        
        </div>";
    }
}

// Reset session data
if (isset($_POST['reset'])) {
    session_destroy();
    session_unset();
}


function orderedItems($ordered)
{
    echo "<ul>";
    echo "<li>" . $ordered . "</li>";
    echo "</ul>";
}


require 'form-view.php';
