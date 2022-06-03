<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film</title>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
</head>

<body>
    <?php include 'menu.php'; ?>
    <main>
        <ul>
            <?php
            $id = $_GET["id"];
            $result_movie = mysqli_query($con, "SELECT * FROM movie WHERE `MovieID` = $id LIMIT 1;");
            $res = $result_movie->fetch_array(1);
            $title = $res["Movie_Title"];
            $img = $res["url"];
            $opis = $res["Description"];
            $price = $res["Price"];
            $rating = $res["Rating"];
            if ($result = mysqli_query($con, "SELECT * FROM dvd WHERE `MovieID` = $id;")) {
                $available = 0;
                $not_available = 0;
                while ($row = mysqli_fetch_array($result, 1)) {
                    if ($row["UserID"] == null) {
                        $available += 1;
                    } else {
                        $not_available += 1;
                    }
                }
                echo "<li>";
                echo "<h2>$title</h2>";
                echo "<h4>$price$</h4>";
                echo "<h4>Rating: $rating</h4>";
                echo "<h3>DVD '$title' dostępne: $available </h3>";
                echo "<h3>DVD '$title' nie dostępne: $not_available </h3>";
                echo "<h4>$opis</h4>";
                echo "<h3><img src='$img' width='330' height='436' ></h3>";
                if ($available > 0) {
                    echo '<a href="./koszyk.php?id=' . $id . '"><button>Add that dvd to cart</button></a>';
                } else {
                    echo "No DVD's available";
                }
                echo "</li>";
                $result->free_result();
            }

            $con->close();
            ?>
        </ul>
    </main>
</body>

</html>