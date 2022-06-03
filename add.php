<?php
$err = "";
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $price = $_POST["price"];
    $rating = $_POST["rating"];
    $desc = $_POST["opis"];
    $url = $_POST["url"];
	
		
    $result = mysqli_query(
        $con,
        "INSERT INTO `movie`( `Movie_Title`, `Genre`, `Price`, `Rating`, `Description`, `url`) VALUES ( '$title', '$genre', $price, '$rating', '$desc', '$url');"
    );

    if ($result) {
        $err = "Dodawanie powiodło się";
        for ($i = 0; $i < 5; $i++) {
            $dvdid = rand();
            $result2 = mysqli_query(
                $con,
                "INSERT INTO `dvd`(`DVDID`, `UserID`, `Condition`) VALUES ($dvdid,  NULL, '');"
            );
        }
    } else {
        $err = "Dodawanie nie powiodło się";
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj</title>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
</head>

<body>
    <?php
    include 'config.php';
    include 'menu.php';
    if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"])) {
        header("location: ./home.php");
    }
    if (!(isset($_SESSION["role"]) && $_SESSION["role"] == 1)) {
        header("location: ./home.php");
    }
    ?>
    <form action="./add.php" method="post">
        <input type="test" name="title" placeholder="Title">
        <input type="text" name="genre" placeholder="Action">
        <input type="number" name="price" placeholder="10.99" min="0" step="0.1">
        <input type="text" name="rating" placeholder="2/10">
        <textarea style="width: 60%; height: 200px; margin: 20px 20%; padding: 20px 40px; background-color: #bbb; border-radius: 15px; box-shadow: 10px 10px 10px 0px rgba(0, 0, 0, 0.47);" type="text" name="opis" placeholder="Opis"></textarea>
        <input type="text" name="url" placeholder="link">
        <?php echo "<h3><span>$err</span></h3>" ?>
        <button type="submit">Dodaj</button>
    </form>
</body>

</html>