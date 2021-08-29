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
    <link rel="stylesheet" href=<?= "$domain/css/custom.css" ?>>
</head>
<body>
    <div class="header">
        <a href=<?= $domain ?>>Home</a>
        <?php
        if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
            echo "<a href='$domain/accounts.php'>Sign Up</a> ";
            echo "<a href='$domain/accounts.php'>Login</a> ";
        } else {
            echo "<a href='$domain/channel?channel=$id'>Channel</a> ";
            echo "<a href='$domain/signout.php'>Sign Out</a> ";
        }
        ?>
        <a href=<?= "$domain/analytics" ?>>Analytics</a>
        <form action=<?= "$domain/upload.php" ?>>
            <input value="Upload Video" type="submit">
        </form>
    </div>
</body>
