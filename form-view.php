<?php // This files is mostly containing things for your view / html 
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/jpg" href="images/cocktail.png" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>DRINK COCKTAILS AT HOME</title>

</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo&family=Libre+Baskerville&display=swap');

    footer {
        text-align: center;
    }

    body {
        font-family: 'Cairo', sans-serif;
        /* background-image: url('images/background.jpeg'); */
        margin: 10px;
        padding: 5px;
        opacity: 0.9;
        background-size: cover;
    }
</style>

<body>
    <div class="container bg-light">
        <h1>COCKTAILS AT HOME</h1>
        <p>We've been in lockdown for so long now, we might forget how it feels and tastes to drink a qualitative cocktail, made by your favorite bartender. Order online and get a cocktail package delivered at your home. You don't need anything, we will provide everything! All you have to do is follow the instructions and enjoy!</p>
        <?php
        ?>
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="?alcohol=1">Order alcoholic drinks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?alcohol=0">Order non-alcoholic Drinks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?alcohol=6">Order beer</a>
                </li>
            </ul>
        </nav>

        <form method="post" action="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">E-mail:</label>
                    <input type="text" id="email" name="email" class="form-control" value="<?php $_POST['email'] ?>" />
                </div>
                <div></div>
            </div>

            <fieldset>
                <legend>Address</legend>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="street">Street:</label>
                        <input type="text" name="street" id="street" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="streetnumber">Street number:</label>
                        <input type="text" id="streetnumber" name="streetnumber" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" id="zipcode" name="zipcode" class="form-control">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Products</legend>
                <?php foreach ($products as $i => $product) : ?>
                    <label>
                        <?php // <?p= is equal to <?php echo 
                        ?>
                        <input type="checkbox" value="1" name="products[<?php echo $i ?>]" /> <?php echo $product->name ?> -
                        &euro; <?= number_format($product->price, 2) ?></label><br />
                <?php endforeach; ?>
            </fieldset>

            <button type="submit" class="btn btn-primary" name="submit">Order!</button>
            <button type="submit" class="btn btn-danger" name="reset">Reset session</button>
        </form>
        <br>
        <footer>
            <?php
            echo $orderMessage;
            foreach ($orderedProducts as $ordered) orderedItems($ordered);
            echo $totalMessage;
            ?>


            <?php foreach ($errorMessage as $error) {
                echo "<div class='alert alert-danger' role='alert'>$error</div></br>";
            } ?>

            <?php echo $confirmationEmail ?>

            <?php echo $confirmationMessage ?>

            <div class="alert alert-primary" role="alert">You already ordered <strong>&euro; <?= $totalValue ?></strong> in Our Shop.</div>


        </footer>
    </div>

</body>

</html>