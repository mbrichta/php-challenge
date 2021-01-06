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
    <h1 class="title">Add an Event</h1>
    
        <form class="event_form" method="POST" action="">
            <div>
                <label for="datetime">Date & Time: </label>
                <input type="datetime-local" name="datetime">
            </div>
                <label for="league">League: </label>
                <input type="text" name="league">
                <label for="sport">Sport: </label>
                <input type="text" name="sport">
                <label for="home_team">Select Home Team: </label>
                <select name="home_team" id="home_team">
                    <option value=""></option>
                    <?php
                        $sports = mysqli_query($db,"select distinct(Name) as Name, City, Country from clubs"); 

                        while($data = mysqli_fetch_array($sports))
                        {
                    ?>
                        <option value="<?php echo $data['Name']?>"><?php echo $data['Name'] . " - " . $data['City']?></option>
                    <?php
                        }
                    ?>
                </select>
                <label for="away_team">Select Away Team: </label>
                <select name="away_team" id="away_team">
                    <option value=""></option>
                    <?php
                        $sports = mysqli_query($db,"select distinct(Name) as Name from clubs");
                        while($data = mysqli_fetch_array($sports))
                        {
                    ?>
                        <option value="<?php echo $data['Name']?>"><?php echo $data['Name'] ?></option>
                    <?php
                        }
                    ?>
                </select>
                
                <input class="submit-button" type="submit" name="addEvent" value="Submit">

                <p class="info-text">*If the Club is not on the dropdown make sure to add it first before creating the event</p>
        </form>
    </div>
    
    <?php
    // Check if all values are given and if so, insert into DB
        if (isset($_POST['addEvent'])){
            $date_time = filter_input(INPUT_POST, "datetime");
            $formated_dateTime= str_replace("T", " ", $date_time) . ":00";
            $league = filter_input(INPUT_POST, "league");
            $sport = filter_input(INPUT_POST, "sport");
            $home_team = filter_input(INPUT_POST, "home_team");
            $away_team = filter_input(INPUT_POST, "away_team");

            $homeTeam_query = mysqli_query($db,"select ClubID from clubs where Name='{$home_team}'");
            $homeTeam_array = mysqli_fetch_array($homeTeam_query);
            $homeTeam_id = $homeTeam_array[0];

            $awayTeam_query = mysqli_query($db,"select ClubID from clubs where Name='{$away_team}'");
            $awayTeam_array = mysqli_fetch_array($awayTeam_query);
            $awayTeam_id = $awayTeam_array[0];

            if(!empty($date_time)){
            if(!empty($league)){
            if(!empty($sport)){
            if(!empty($home_team)){
            if(!empty($away_team)){
                $sql = "INSERT INTO events (EventID, DateTime, League, Sport, _HomeTeam, _AwayTeam) VALUES (NULL, '$formated_dateTime', '$league', '$sport', '$homeTeam_id', '$awayTeam_id');";
                if($db->query($sql)){
                    echo "Event created succesfully";
                }
                else {
                    echo "Error: ". $sql . "<br>". $db->error;
                }
            }
            else{
                echo "Please choose an Away Team...";
            }
            }
            else{
                echo "Please choose a Home Team...";
            }
            }else {
                echo "Please enter the sport...";
                die();
            }
            }
            else {
                echo "Please enter a League...";
                die();
            }
            }
            else {
                echo "Please provide date and time...";
                die();
            }
        }
        
    ?>

    <footer class="footer">
        <h3>Made by Mathias Brichta ©</h3>
    </footer>
</body>

</html>