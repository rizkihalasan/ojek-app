<html>
<head>
    <link rel="stylesheet" type="text/css" href="profil.css">
</head>
<title>Profil</title>
<body>
    <?php
        session_start();
        function connectTOSQL(){
            return mysqli_connect("localhost", "root", "", "ojek2an");
        }
        $id = $_GET['id_active'];
        $db = connectTOSQL();
        $usersql = "select Username, Driver from profil where ID = '$id'";
        $user_result = mysqli_query($db, $usersql);
        $user_row = mysqli_fetch_array($user_result, MYSQLI_ASSOC);
        $username = $user_row['Username'];
        $driver = $user_row['Driver'];

        //menghitung rating
        if($driver[0] == 1) {
            $driversql = "select ID_Driver,avg(Rating),count(Rating) from history where ID_Driver = '$id' group by ID_Driver";
            $driver_result = mysqli_query($db, $driversql);
            $driver_rating_row = mysqli_fetch_array($driver_result, MYSQLI_ASSOC);
            $driver_avg_rating = $driver_rating_row['avg(Rating)'];
            $driver_vote = $driver_rating_row['count(Rating)'];

            $driversql = "select Location from pref_location where ID = '$id'";
            $driver_result = mysqli_query($db, $driversql);
            $driver_location_row = mysqli_fetch_array($driver_result, MYSQLI_ASSOC);
            $driver_location = $driver_location_row['Location'];          
        }



        connectTOSQL();

        echo $driver_avg_rating + " ";
        echo $driver_vote + " ";
        echo sizeof($driver_location) + " ";
        foreach ($driver_location as $value) {
            echo $value + " ";
        }

    ?>
</body>
</html>