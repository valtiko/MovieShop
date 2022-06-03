<html lang="en">

<head>
    <meta char set="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy</title>
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

    $id = $_SESSION["id"];
    $result_card = mysqli_query($con, "SELECT * FROM creditcard WHERE UserID = $id LIMIT 1;");

    $tid = rand();
    $ccid = $result_card->fetch_array(1)["CCID"];

    $result_transaction = mysqli_query(
        $con,
        "INSERT INTO `transaction`(`TransactionID`, `UserID`, `CCID`, `Total_Charge`) VALUES ($tid, $id, $ccid, 0)"
    );

    foreach ($_SESSION["cart"] as $item) {
        if ($result = mysqli_query($con, "SELECT * FROM dvd WHERE `MovieID` = $item AND UserID IS NULL LIMIT 1;")) {
            $result_update = mysqli_query($con, "UPDATE dvd SET UserID = $id WHERE `MovieID` = $item AND UserID IS NULL LIMIT 1;");
            if ($result_update) {
                $result_movie = mysqli_query($con, "SELECT * FROM movie WHERE `MovieID` = $item LIMIT 1;");
                $price = floatval($result_movie->fetch_array(1)["Price"]);
                $result_transaction = mysqli_query(
                    $con,
                    "SELECT * FROM `transaction` WHERE `TransactionID` = $tid"
                );
                $cash = floatval($result_transaction->fetch_array(1)["Total_Charge"]) + $price;
                $result_transaction = mysqli_query(
                    $con,
                    "UPDATE `transaction` SET Total_Charge = $cash WHERE `TransactionID` = $tid"
                );

                $dvdid = $result->fetch_array(1)["DVDID"];
                $tidi = rand();

                $result_item = mysqli_query(
                    $con,
                    "SELECT * FROM `transactionitem` WHERE `TransactionID` = $tid AND `UserID` = $id AND `MovieID` = $item LIMIT 1;"
                );
                $data = $result_item->fetch_array(1);
                if (null !== $data) {
                    $amount = intval($data["Quantity"]) + 1;
                    $result2 = mysqli_query(
                        $con,
                        "UPDATE `transactionitem` SET `Quantity` = $amount WHERE `TransactionID` = $tid AND `UserID` = $id AND `MovieID` = $item LIMIT 1;"
                    );
                } else {
                    $result2 = mysqli_query(
                        $con,
                        "INSERT INTO `transactionitem`(`TransactionID`, `UserID`, `TransactionItemID`, `DVDID`, `MovieID`, `Quantity`) VALUES ($tid, $id, $tidi, $dvdid, $item, 1)"
                    );
                }
            } else {
                echo "Error while buying / Not enough DVD's";
            }
        }
    }
    header("location: ./print.php");

    ?>
</body>

</html>