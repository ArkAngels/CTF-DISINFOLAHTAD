<?php
    include("connect.php");
    session_start();
    if(isset($_GET['search']) && $_GET['search'] != 'admin') {
        $sql = "SELECT username, name, description FROM users WHERE name='".$_GET['search']."' OR username='".$_GET['search']."' AND username!='admin';";
        if (mysqli_query($conn, $sql)) {
            $result = mysqli_query($conn, $sql);
        }
        else{
            $bad_result = '<div class="alert alert-danger">'. mysqli_error($conn) . '</div>';
        }
    }
    else{
        $sql = "SELECT username, name, description FROM users WHERE username != 'admin';";
        if (mysqli_query($conn, $sql)) {
            $result = mysqli_query($conn, $sql);
        }
        else{
            $bad_result = '<div class="alert alert-danger">'. mysqli_error($conn) . '</div>';
        }
    }
?>
<html>
    <head>
        <title> Profiles </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <style>
        .input-mysize{
            width:791px;
        }
        .table {
            background-color:white;
            border-style: solid;
            border-width: 2px;
            right-margin: 50px;
            width:1000px;
        }
        </style>
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
                        echo'<li class="active"><a href="profiles.php"> Profiles </a></li>';
                        echo '<li><a href="logout.php"> Logout </a></li>';
                    }
                    else{
                        echo '<li><a href="register.php"> Register </a></li>';
                        echo '<li><a href="login.php"> Login </a></li>';
                    }
                ?>
            </ul>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-2">
                    <form role="search" action="profiles.php">
                        <div class="form-group" >
                            <input type="text" class="form-control input-mysize" placeholder="Search" name="search">
                            <button type="submit" class="btn btn-default"> Search<!--<i class="glyphicon glyphicon-search"></i>--> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <?php echo $bad_result?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <?php
                        if ($_SESSION['username'] == 'admin' ) {
                           $flag_result = '<div class="alert alert-sucess" role="alert">flag{adm1n_s3cr3t_d0nt_t3ll_4ny0ne}</div>';
                           echo($flag_result);
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <table class="table">
                        <?php
                            if (isset($result)){
                                echo "
                                    <tr>
                                        <th> Username </th>  <th> Name </th> <th> Description </th>
                                    </tr>
                                    ";
                                while($row = mysqli_fetch_object($result)) {
                                    echo "<tr><td>". $row->username ."</td><td>". $row->name ."</td><td>". $row->description ."</tr>";
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>