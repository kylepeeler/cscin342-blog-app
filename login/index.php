<?php
include_once ('../includes/User.php');
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != null){
    if ($_SESSION['user']->isAdmin()){
        header('Location: ../admin');
    }else{
        header('Location: ./logout.php');
    }
}else if (isset($_POST['action']) && $_POST['action'] == 'login'){
    $user = new User();
    $user->setCredentials($_POST['email'], $_POST['password']);
    if ($user->isValidCredentials()){
        $user->fetchFromDB();
        var_dump($user);
        $_SESSION['user'] = $user;
        if ($_SESSION['user']->isAdmin()){
            header('Location: ../admin');
        }else{
            echo "<div class='container'><div class=\"alert alert-warning\" role=\"alert\">
  User is not an admin, user functionality (i.e. commenting coming soon!)
</div></div>";
        }
    }else{
        echo "<div class='container'><div class=\"alert alert-danger\" role=\"alert\">
  Invalid login.
</div></div>";
    }
}else if (isset($_GET['signout']) && $_GET['signout'] == 'true'){
    echo "<div class='container'><div class=\"alert alert-info\" role=\"alert\">
  You have signed out.
</div></div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login to Admin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../styles/signin.css" rel="stylesheet">
</head>

<body>

<div class="container">

    <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Kyle's Blog Login</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
<!--        <div class="checkbox">-->
<!--            <label>-->
<!--                <input type="checkbox" value="remember-me"> Remember me-->
<!--            </label>-->
<!--        </div>-->
        <button class="btn btn-lg btn-primary btn-50" type="submit" name="action" value="login">Sign in</button>
        <a href="../register.php"><button type="button" class="btn btn-lg btn-secondary btn-50" formnovalidate>Register</button></a>
        <br>
        <a href="..">< Return to blog</a>
    </form>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
</body>
</html>
