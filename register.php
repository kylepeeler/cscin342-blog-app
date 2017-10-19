<?php include('header.php');
      include_once ('includes/User.php');
?>

<div class="container">

    <h2>User Registration</h2>
    <br>
    <?php
    if (isset($_POST['action']) && $_POST['action'] == "register") {
        $new_user = new User();
        $new_user->setCredentials($_POST['email'], $_POST['password']);
        if ($new_user->isRegistered()){
            echo 'User has already been registered';
        }else{
            echo 'User has been created, check your email for activation instructions';
            $new_user->create(htmlspecialchars($_POST['firstname']), htmlspecialchars($_POST['lastname']), htmlspecialchars($_POST['password']), htmlspecialchars($_POST['email']), htmlspecialchars($_POST['profile_desc']));
            $new_user->register();
        }
    }

    if(isset($_GET['code']) && isset($_GET['email'])){
        $activation_user = new User();
        $activation_user->setEmail($_GET['email']);
        $activation_user->fetchFromDB();
        if ($activation_user->getisActivated()){
            echo 'User has already been activated';
        }else{
            if ($activation_user->activateUser($_GET['code'])){
                echo 'User has been activated';
            }else{
                echo 'Invalid activation code';
            }
        }
    }
    ?>
    <br>
    <form method="post">
        <div class="form-group">
            <label for="firstname">First Name (*)</label>
            <input type="text" class="form-control" id="firstname" aria-describedby="emailHelp" placeholder="First Name" name="firstname" required>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name (*)</label>
            <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" required>
        </div>
        <div class="form-group">
            <label for="email">Email (*)</label>
            <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password (*)</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
            <label for="profile-desc">Profile Description</label>
            <textarea class="form-control" id="profile-desc" rows="3" name="profile_desc"></textarea>
            <small id="profile-desc-help" class="form-text text-muted">Tell us about yourself!</small>
        </div>

        <button type="submit" name="action" class="btn btn-primary" value="register">Register</button>
    </form>
    <br>
    <br>
    <br>
</div><!-- /.container -->

<?php include('footer.php');?>
