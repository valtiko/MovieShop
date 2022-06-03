<?php
if (!isset($_GET["search"])) {
    $_GET["search"] = "";
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css" type="text/css">
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
    <style>
        input {
            text-align: center;
            margin: 20px 0 10px calc(20% + 40px) !important;
        }

        ul {
            padding: 0;
        }
    </style>
</head>

<body>
    <?php include 'menu.php'; ?>
    <main>
		<div class="panel" style="float:left">
		<ol>
		<li>Filmy akcji</li>
		<li>Dramat</li>
		<li>Komedia</li>
		<li>Horror</li>
		<li>Western</li>
		
		

		
		
		<li>	
			<form action="" method="get" id="szukaj">
			<input type="text" name="search" placeholder="Szukaj" value="<?php echo $_GET["search"]; ?>">
			</form>
		</li>
		</ol>		
		</div>
		<div style="clear:both;"></div>
        <div class="menu1">
            <?php
            if ($result = mysqli_query($con, "SELECT * FROM movie")) {
                while ($row = mysqli_fetch_array($result, 1)) {
                    $mid = $row["MovieID"];
                    $mt = $row["Movie_Title"];
                    $genre = $row["Genre"];
                    $img = $row["url"];
                    if ($_GET["search"] == "" || is_int(strpos($mt, $_GET["search"])) || is_int(strpos($genre, $_GET["search"]))) {
                        echo '<div class="film">';
						echo "<h2>$mt</h2>";
                        echo '<div class="plakat">';
                        echo "<a href='./movie.php?id=$mid'><img src='$img' width='330' height='436' ></a>";
                        echo '</div>';
                      
                        echo "</div>";
                    }
                }
                $result->free_result();
            }

            $con->close();
            ?>
        </div>
    </main>
</body>

</html>