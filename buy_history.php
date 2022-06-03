<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
</head>

<body>
    <?php
    include 'menu.php';
    $id = $_SESSION["id"];
    ?>
    <main>
        <ul>
            <?php
            if ($result = mysqli_query($con, "SELECT * FROM transactionitem WHERE UserID = $id")) {
                while ($transaction = mysqli_fetch_array($result, 1)) {
                    $bookid = $transaction["MovieID"];
                    if ($result2 = mysqli_query($con, "SELECT * FROM movie WHERE MovieID = $bookid")) {
                        while ($row = mysqli_fetch_array($result2, 1)) {
                            $mid = $row["MovieID"];
                            $mt = $row["Movie_Title"];
                            echo "<li>";
                            echo "<h2>$mt</h2>";
                            echo "<h3>" . $row["Price"] . "</h3>";
                            echo "<a href='./movie.php?id=$mid'><button>Show</button></a>";
                            echo "</li>";
                        }
                    }
                    $result2->free_result();
                }
                $result->free_result();
            }

            $con->close();
            ?>
        </ul>
    </main>
</body>

</html>