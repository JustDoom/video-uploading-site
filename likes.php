<?php
    session_start();
    include_once('settings.php');

    $user = $_SESSION['username'];

    $id = $_REQUEST['v'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT likes FROM videos WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $likes = $row['likes'];

            if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
                // redirect to your login page
                echo "Likes: " . $likes;
                return; 
                //exit();
            }

            $sql = "SELECT id FROM accounts WHERE username='$user'";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $userid = $row['id'];
            }

            $sql = "SELECT * FROM likes WHERE videoid='$id' AND userid='$userid'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $sql = "DELETE FROM likes WHERE videoid='$id' AND userid='$userid'";
                $conn->query($sql);

                $likes -= 1;

                $sql = "UPDATE videos 
                SET likes = $likes
                WHERE id = '$id'";

                $conn->query($sql);
            } else {
                $sql = "INSERT INTO likes (videoid, userid)
                VALUES ('$id', '$userid')";
                $conn->query($sql);

                $likes += 1;

                $sql = "UPDATE videos 
                SET likes = $likes
                WHERE id = '$id'";

                $conn->query($sql);
            }
            break;
        }
    }

    echo "Likes: " . $likes;
    $conn->close();
?>