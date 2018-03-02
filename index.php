<?php
    session_start();
    if($_SESSION['loggedin']){
        header("Location: profiles.php");
    }
?>
<html>
    <head>
        <title>Profile Madness</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>

    <body style="background-color: lavender;">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/"> Profile Madness </a>
                </div>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a  href="/">Home</a></li>
                <?php
                    if ($_SESSION['loggedin']){
                        echo'<li><a href="profiles.php"> Profiles </a></li>';
                        echo '<li><a href="logout.php"> Logout </a></li>';
                    }
                    else{
                        echo '<li><a href="register.php"> Register </a></li>';
                        echo '<li><a href="login.php"> Login </a></li>';
                    }
                ?>
            </ul>
        </nav>
            <?php
            if (!$_SESSION['loggedin']){
                echo '<p>Please login or register to see user profiles, maybe you can make a new friend.</p>';
            }
            ?>
    </body>
</html>