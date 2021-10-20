<?php

require_once "Idojaras.php";
require_once "db.php";


$szerkesztesId = $_GET["szerkesztesId"] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $datum = $_POST["datum"] ?? null;
    $hofok = $_POST["hofok"] ?? null;
    $leiras = $_POST["leiras"] ?? null;
    $ujIdojaras = new Idojaras(new DateTime($datum), (int)$hofok, $leiras);
    $ujIdojaras->szerkeszt($szerkesztesId);
    header("Location: index.php");
    exit();
}

if ($szerkesztesId === null){
    header("Location: index.php");
    exit();
}

global $db;
$t = $db->query("SELECT * FROM adatok WHERE id LIKE $szerkesztesId")
            ->fetchAll();

$idojaras = new Idojaras(new DateTime($t[0]["datum"]), $t[0]["hofok"], $t[0]["leiras"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form method="POST">
            <span>
                Dátum: 
                <input type="date" name="datum" value="<?php echo $idojaras->getDatum()->format('Y-m-d')?>">
            </span><br>
            <span>
                Hőfok: 
                <input type="number" name="hofok" value="<?php echo $idojaras->getHofok()?>">
            </span><br>
            <span>
                Leírás: 
                <input type="text" name="leiras"  value="<?php echo $idojaras->getLeiras()?>">
            </span><br>
            <span>
                <input type="submit" value="Szerkeszt">                
            </span><br>
        </form>
    </div>
    <a href="index.php"><button>Mégse</button></a>
</body>
</html>