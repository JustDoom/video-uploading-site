<?php

?>

<form action="signup.php" method="post" enctype="multipart/form-data">
    Sign up: <br>
    Username: <input type="text" name="name" id="name" placeholder="Username" maxlength="70" required><br>
    Email: <input type="text" name="email" id="email" placeholder="Email" required><br>
    Password: <input type="password" name="password" id="password" placeholder="Password" maxlength="70" required><br>
    <input type="submit" value="Sign up" name="submit">
</form>

<form action="login.php" method="post" enctype="multipart/form-data">
    Login: <br>
    Username: <input type="text" name="name" id="name" placeholder="Username" maxlength="70"><br>
    Password: <input type="password" name="password" id="password" placeholder="Password" maxlength="70"><br>
    <input type="submit" value="Login" name="submit">
</form>