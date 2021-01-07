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

        $sql = "select * from calendar";

        if (isset($_POST['filter'])) {
            $sport_filter = $_POST['sports'];
            if($sport_filter == "all"){
                $sql = "select * from calendar";
            }
            else{
                $sql .= " where sport = '{$sport_filter}'";
            }
        }
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
        <div class="filter">
            <form name="filter_sports" method="POST" action="index.php">
                <label for="sports">Filter by sports:</label>
                <select name="sports" id="sports">
                    <option value="all">All</option>
                    <?php
                        // fetch unique sports in db
                        $sports = mysqli_query($db,"select distinct(Sport) as Sport from calendar");

                        while($data = mysqli_fetch_array($sports))
                        {
                    ?>
                    <option value="<?php echo $data['Sport']?>"><?php echo $data['Sport'] ?></option>
                    <?php
                        }
                    ?>
                    <input class="button" type="submit" name="filter" value="Submit">
                </select>
            </form>
        </div>

        <div class="cards">
            <?php
                // Fetch and display data on cards
                $date_sort = " order by DateTime asc";
                $records = mysqli_query($db, $sql . $date_sort);
                while($data = mysqli_fetch_array($records))
                {
            ?>
            <div class="card">
                <p class="sport"><?php echo $data['Sport']?></p>
                <p class="league"><?php echo $data['League'] ?></p>
                <div class="teams">
                    <p><?php echo $data['HomeTeam']?></p>
                    <p class="versus">VS</p>
                    <p><?php echo $data['AwayTeam']?></p>
                </div>
                <p class="card-title"><?php echo $data['DateTime']?></p>                
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <footer class="footer">
        <h3>Made by Mathias Brichta ©</h3>
    </footer>
</body>

</html>