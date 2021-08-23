<?php

    include_once('settings.php');

    $user = $_POST['name'];
    $pass = $_POST['password'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo $user . "<br>";
    echo $pass;

    $sql = "SELECT * FROM accounts WHERE username='$user'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if($row['pass'] == $pass){
                session_start();
                $_SESSION['username'] = $user;
                $_SESSION['id'] = $row['id'];

                echo "<br> logged in";
                break;
            }

            echo "<br>Wrong password";
            break;
        }
    } else {
        echo "<br>Wrong username";
    }
?>
