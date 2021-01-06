<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Sportradar code challenge</title>
</head>

<body>
    <?php
        include "dbConn.php"; // Using database connection file here
    ?>
    <nav class="navbar">
        <h2 class="logo" href="index.php">Sports Event Calendar</h2>
        <div class="nav-links-wrapper">
        <a class="nav-link" href="index.php">Calendar</a>
            <a class="nav-link" href="addEvents.php">Add Events</a>
            <a class="nav-link" href="addClubs.php">Add Clubs</a>
        </div>
    </nav>

    <div class="container">
    <h1 class="title">Add a Club</h1>
    <form class="event_form" method="POST" action="">
                <label for="name">Club Name: </label>
                <input type="text" name="name">
                <label for="city">City: </label>
                <input type="text" name="city">
                <label for="country">Country: </label>
                <input type="text" name="country">
                <input class="submit-button" type="submit" name="addEvent" value="Submit">
        </form>
    </div>
    <?php
        // Check if all values are given and insert into DB
        if (isset($_POST['addEvent'])){
            $name = filter_input(INPUT_POST, "name");
            $city = filter_input(INPUT_POST, "city");
            $country = filter_input(INPUT_POST, "country");
            
            if(!empty($name)){
            if(!empty($city)){
            if(!empty($country)){
              $sql = "INSERT INTO `clubs` (`ClubID`, `Name`, `City`, `Country`) VALUES  (NULL, '$name', '$city', '$country');";
              if($db->query($sql)){
                echo "Club created succesfully";
              }else {
                echo "Error: ". $sql . "<br>". $db->error;
              }
            }else{
              echo "Please enter the club's Country...";
            }
            }else{
              echo "Please enter the club's City...";
            }
            }else{
              echo "Please enter the club's Name...";
            }
        }
        
    ?>
    <footer class="footer">
        <h3>Made by Mathias Brichta ©</h3>
    </footer>
</body>

</html>