<?php
    //Start the session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 02</title>
</head>
<body>

    <?php
    
    if (!isset($_SESSION['productCount']) || !isset($_SESSION['worker']) || !isset($_SESSION['product']) || !isset($_SESSION['quantity'])) {

        $_SESSION['productCount'] = array("milk" => 0, "soft drink" => 0);
        $_SESSION['worker'] = "";
        $productCount["milk"] = $_SESSION['productCount']["milk"];
        $productCount["soft drink"] = $_SESSION['productCount']["soft drink"];
    
        }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $productCount = $_SESSION['productCount'];

        $_SESSION['worker'] = $_POST['worker'];
        $_SESSION['product'] = $_POST['product'];
        $_SESSION['quantity'] = $_POST['quantity'];

        if (isset($_POST['add'])) {

            switch ($_SESSION['product']) {
                case "milk":
                    $productCount["milk"] += $_SESSION['quantity'];
                    break;
                case "soft drink":
                    $productCount["soft drink"] += $_SESSION['quantity'];
                    break;
            }

            $_SESSION['productCount'] = $productCount;
        }

        if (isset($_POST["remove"])) {

            if ($_SESSION['productCount'][$_SESSION['product']] >= $_SESSION['quantity']) {

                switch ($_SESSION['product']) {
                    case "milk":
                        $productCount["milk"] -= $_SESSION['quantity'];
                        break;
                    case "soft drink":
                        $productCount["soft drink"] -= $_SESSION['quantity'];
                        break;
                }

                $_SESSION['productCount'] = $productCount;
            } else { {
                    echo "<p>Error: la cantidad que quieres retirar supera el límite permitido.</p>";
                }
            }
        }
    }
    
    ?>
    
    <h1>Supermarket management</h1>

    <form action="" method="post">

        <label for="name">Worker name:</label>
        <input type="text" name="worker" value=<?php echo $_SESSION['worker']; ?>><br><br>
        <h2>Choose product:</h2>
        <select name="product">
            <option value="milk">Milk</option>
            <option value="soft drink">Soft Drink</option>
        </select><br>
        <h2>Product quantity:</h2>
        <input type="number" name="quantity" required><br><br>
        <input type="submit" value="add" name="add">
        <input type="submit" value="remove" name="remove">
        <input type="reset" value="reset">

    </form>

    <h2>Inventory:</h2>
    <p>Worker: <?php echo $_SESSION['worker'] ?>
    </p>
    <p>Units milk: <?php echo $_SESSION['productCount']["milk"] ?>
    </p>
    <p>Units soft drink: <?php echo $_SESSION['productCount']["soft drink"] ?>
    </p>
    
</body>
</html>