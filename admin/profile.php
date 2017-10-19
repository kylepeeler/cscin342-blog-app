<?php
include('../includes/User.php');
session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user']->isAdmin())){
    header('Location: ../login');
}

if (isset($_POST['action']) && $_POST['action'] == 'update'){
    $_SESSION['user']->setEmail(htmlspecialchars($_POST['email']));
    $_SESSION['user']->setPassword(htmlspecialchars($_POST['password']));
    $_SESSION['user']->setFirstname(htmlspecialchars($_POST['first_name']));
    $_SESSION['user']->setLastname(htmlspecialchars($_POST['last_name']));
    $_SESSION['user']->setAvatarUrl(htmlspecialchars($_POST['avatar_url']));
    $_SESSION['user']->setProfileDesc(htmlspecialchars($_POST['profile_desc']));
    $_SESSION['user']->updateDB();
    echo '<br/><br/>User information updated successfully!';
}
include('./header.php');
?>

<div class="container-fluid">
    <div class="row">
<!--        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">-->
<!--            <ul class="nav nav-pills flex-column">-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link active" href="#">Overview <span class="sr-only">(current)</span></a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="./createpost.php">Create Post</a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="./categories.php">Categories</a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="#">Edit Links</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </nav>-->

        <main class="col-sm-12 ml-sm-auto col-md-12" role="main">
            <br>
            <h1>Your Profile</h1>

            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" value="<?=$_SESSION['user']->getEmail()?>" name="email" required readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="First Name" value="<?=$_SESSION['user']->getFirstname()?>" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" id="lastname" placeholder="Last Name" value="<?=$_SESSION['user']->getLastname()?>" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="fullName">Avatar URL</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Avatar URL" value="<?=$_SESSION['user']->getAvatarUrl()?>" name="avatar_url" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Profile Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="profile_desc"><?=$_SESSION['user']->getProfileDesc()?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="action" value="update">Submit</button>
            </form>


        </main>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>