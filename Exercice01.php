<?php
    //Start the session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 01</title>
</head>
<body>
    
    
    <?php

        if (isset($_SESSION['valor']) == null) {
        $_SESSION['valor'] = array(10,20,30);
        }

        $valores = $_SESSION['valor'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $_SESSION['Position'] = $_POST['Position'];
        $_SESSION['value'] = $_POST['value'];

        if (isset($_POST['Modify'])) {
            $valores[$_SESSION['Position']] = $_SESSION['value'];
            $_SESSION['valor'] = $valores;
        }

        if (isset($_POST["Average"])) {
            $average = array_sum($_SESSION['valor']) / count($_SESSION['valor']);
        }
        
    }

    ?>

    <h1>Modify array saved in session</h1>

    <form action="" method="post">

        <label for="name">Position to modify:</label>
        <select id="position" name="Position">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select><br><br>

        <label for="name">New value:</label>

        <input type="number" name="value"><br><br>
        <input type="submit" name="Modify" value="Modify">
        <input type="submit" name="Average" value="Average">
        <input type="reset" name="Reset" value="Reset"><br>

    </form>

    <p>Current array: <?php echo implode(", ", $_SESSION['valor']) ?></p>
   
    <?php
    if (isset($average)) {
        echo "<p>Average: " . number_format($average, 2) . "</p>";
    }
    ?>

</body>
</html>