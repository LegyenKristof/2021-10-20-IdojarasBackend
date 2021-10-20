<?php

require_once "db.php";
require_once "Idojaras.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $datum = $_POST["datum"] ?? null;
    $hofok = $_POST["hofok"] ?? null;
    $leiras = $_POST["leiras"] ?? null;
    $ujIdojaras = new Idojaras(new DateTime($datum), (int)$hofok, $leiras);
    $ujIdojaras->mentes();
}
 
$idojarasok = Idojaras::osszes();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Időjárás</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div>
        <form method="POST">
            <span>
                Dátum: 
                <input type="date" name="datum">
            </span><br>
            <span>
                Hőfok: 
                <input type="number" name="hofok">
            </span><br>
            <span>
                Leírás: 
                <input type="text" name="leiras">
            </span><br>
            <span>
                <input type="submit" value="Hozzáad">
            </span><br>
        </form>
    </div>
    <div>
    <?php
    foreach ($idojarasok as $idojaras) {
        echo "Dátum: " . $idojaras->getDatum()->format("Y-m-d") .
            "<br>Hőfok: " . $idojaras->getHofok() . 
            "<br>Leírás: " . $idojaras->getLeiras() . "<br><br>";
    }
    ?>
    </div>
</body>
</html>