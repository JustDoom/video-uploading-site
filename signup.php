<?php

    include_once('settings.php');

    $email = $_POST['email'];
    $user = $_POST['name'];
    $pass = $_POST['password'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = generateRandomString();
    if(checkIfExists($id, $conn)){
        echo "existststststs";
    }
    
    echo $email . "<br>";
    echo $user . "<br>";
    echo $pass;

    $sql = "SELECT username FROM accounts WHERE username='$user'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Username taken";
    } else {
        $sql = "INSERT INTO accounts (id, email, pass, username, joindate)
        VALUES ('$id', '$email', '$pass', '$user', '" . time() . "')";

        $conn->query($sql);

        session_start();
        $user = // grab the username from your results set  
        $_SESSION['username'] = $user; 

        echo "<br> account created";
    }

    function checkIfExists($id, $conn){
        $sql = "SELECT id FROM accounts WHERE id='$id'";
        $result = $conn->query($sql);
      
        if ($result->num_rows > 0) {
          echo "resultdewffsf";
          return true;
        } else {
          echo "0 results";
          return false;
        }
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>