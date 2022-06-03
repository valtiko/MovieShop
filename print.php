<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width   , initial-scale=1.0">
    <title>Rachunek</title>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
</head>

<body>
    <?php
    session_start();
    if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"])) {
        header("location: ./home.php");
    }

    include 'config.php';

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_GET['id'])) {
        array_push($_SESSION['cart'], $_GET['id']);
    }
    ?>
    <main>
        <ul>
            <?php
            foreach ($_SESSION["cart"] as $item) {
                if ($result = mysqli_query($con, "SELECT * FROM movie WHERE `MovieID` = " . $item . ";")) {
                    $row = mysqli_fetch_array($result, 1);
                }
                echo "<h3>" . $row['Movie_Title'] . " - " . $row['Price'] . "$</h3>";
            }
            ?>
        </ul>
    </main>
    <script>
        window.print();
    </script>
</body>

</html>