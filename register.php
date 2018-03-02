<?php
    include("connect.php");
    if(isset($_POST['submit'])){
        $sql = "SELECT id FROM users WHERE username='".urlencode($_POST['username'])."';";
        if ($result = mysqli_query($conn, $sql)){
            $count = mysqli_num_rows($result);
            if ($count == 0) {
                $sql = "INSERT INTO users (username, password, name, description) values ('".urlencode($_POST['username'])."','".urlencode($_POST['password'])."','".urlencode($_POST['name'])."','". urlencode($_POST['desc']) ."');";
                if (mysqli_query($conn, $sql)){
                    $success = '<div class="alert alert-success"> Registered successfully </div>';
                }
                else {
                $result = '<div class="alert alert-danger">'. mysqli_error($conn) . '</div>';
                }
            }
            else {
                $error = '<div class="alert alert-danger">A user with that username already exists.</div>';
            }
        }
        else {
            $error = '<div class="alert alert-danger">'. mysqli_error($conn) . '</div>';
        }
    }
?>
<html>
    <head>
        <title>Register</title>
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
                        echo '<li class="active"><a href="register.php"> Register </a></li>';
                        echo '<li><a href="login.php"> Login </a></li>';
                    }
                ?>
            </ul>
        </nav>
        <?php echo $error ?>
        <?php echo $success ?>
        <form method="POST" action="register.php">
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
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="form-group">
                            <label for="desc">Description:</label>
                            <input type="text" class="form-control" id="desc" name="desc" required>
                        </div>
                    </div>
                </div>
            <div class="container">
                <div class="row">
                    <button type="submit" class="btn btn-default" name="submit" id="submit">Submit</button>
                </div>
            </div>
        </form>
    </body>
</html>