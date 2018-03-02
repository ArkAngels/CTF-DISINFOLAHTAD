<?php
    include("connect.php");
    session_start();
    if(isset($_POST['submit'])){
        $sql = "SELECT id FROM users WHERE username='".urlencode($_POST['username'])."' AND password='".urlencode($_POST['password'])."';";
        if($result = mysqli_query($conn, $sql)) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['name'] = $_POST['name'];
                $_SESSION['loggedin'] = True;
                $success = '<div class="alert alert-success"> Logged in successfully </div>';
                header("location: profiles.php");
            }
            else if ($count == 0){
                $error = '<div class="alert alert-danger">You must register before you can login.</div>';
            }
            else{
                $error = '<div class="alert alert-danger">Your credentials are invalid.</div>';
            }
        }
    }
?>
<html>
    <head>
        <title>Login</title>
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
                <li><a href="/">Home</a></li>
                <?php
                    if ($_SESSION['loggedin']){
                        echo'<li><a href="profiles.php"> Profiles </a></li>';
                        echo '<li><a href="logout.php"> Logout </a></li>';
                    }
                    else{
                        echo '<li><a href="register.php"> Register </a></li>';
                        echo '<li  class="active"><a href="login.php"> Login </a></li>';
                    }
                ?>
            </ul>
        </nav>
        <?php echo $error ?>
        <?php echo $success ?>
        <form method="post" action="login.php">
            <div class="container">
                <div class="row">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                </div>
            </div>
        </form>
    </body>
</html>