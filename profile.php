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
    $info = "";
    $id = $_SESSION["id"];
    $username = $_SESSION["username"];

    if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"])) {
        header("location: ./home.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $CCID = rand();
        $fullname = $_POST["fullname"];
        $cc = $_POST["cc"];
        $exp_month = $_POST["exp_month"];
        $exp_day = $_POST["exp_day"];

        if (mysqli_query($con, "INSERT INTO `creditcard`(`CCID`, `UserID`, `Name`, `CC_Number`, `Exp_Month`, `Exp_Day`) VALUES ('$CCID','$id','$fullname','$cc','$exp_month','$exp_day')")) {
            if (mysqli_query($con, "INSERT INTO `creditcarduser`(`CCID`, `UserID`) VALUES ('$CCID','$id')")) {
                $info = "Successfully added a Credit Card";
            }
        } else {
            $info = "Failed addition of a Credit Card";
        }
    }
    ?>
    <main>
        <ul>
            <li>
                <?php
                if ($result = mysqli_query($con, "SELECT * FROM user WHERE UserID = $id")) {
                    while ($row = mysqli_fetch_row($result)) {
                        echo "<h2>$username</h2>";
                        echo "<h3>Cards:</h3>";
                        if ($result = mysqli_query($con, "SELECT * FROM creditcard WHERE UserID = $id")) {
                            while ($row = mysqli_fetch_array($result)) {
                                $card = $row["CCID"] . " - " . $row["Name"];
                                echo "<p><h3>$card</h3></p>";
                            }
                        }
                    }
                    $result->free_result();
                }

                $con->close();
                ?>

                <a href="./buy_history.php"><button>Historia zakupów</button></a>

                <form action="./profile.php" method="post">
                    <input type="text" name="fullname" placeholder="Fullname">
                    <input type="text" max="3" name="cc" placeholder="CC number">
                    <input type="number" min="0" max="12" name="exp_month" placeholder="Expiration Month">
                    <input type="number" min="0" max="31" name="exp_day" placeholder="Expiration Day">
                    <span><?php echo $info; ?></span>
                    <button>Add a Card</button>
                </form>
            </li>
        </ul>
    </main>
</body>

</html>