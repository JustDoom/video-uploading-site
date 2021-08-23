<?php
/**
 * @var string $servername
 * @var string $username
 * @var string $password
 * @var string $dbname
 * @var string $domain
 */
    session_start();
    if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['id']) || empty($_SESSION['id'])) {
        // redirect to your login page
        //exit();
    }

    $user = $_SESSION['username'];
    $id = $_SESSION['id'];

    include_once('settings.php');
?>

<head>
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <div class="header">
        <a href=<?php echo $domain ?>>Home</a>
        <?php
        if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
            echo "<a href='$domain/accounts.php'>Sign Up</a> ";
            echo "<a href='$domain/accounts.php'>Login</a> ";
        } else {
            echo "<a href='$domain/channel.php?channel=$id'>Channel</a> ";
            echo "<a href='$domain/signout.php'>Sign Out</a> ";
        }
        ?>
        <form action="upload.php">
            <input value="Upload Video" type="submit">
        </form>
    </div>
</body>
