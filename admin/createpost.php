<?php
include_once('../includes/User.php');
include_once('../includes/PostCategories.php');
session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user']->isAdmin())){
    header('Location: ../login');
}
include_once('./header.php');
include_once('../includes/Posts.php');

if (isset($_POST['action']) && $_POST['action'] == 'submit'){
    Posts::createPost($_POST['postTitle'], $_POST['postBody'], 'published', null, null, $_SESSION['user']->getUID(), $_POST['postCategory']);
}

$is_edit = isset($_GET['edit']);
$is_delete = isset($_GET['delete']);

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'update') {
        Posts::updatePost($_GET['edit'], $_POST['postTitle'], $_POST['postBody'], 'published', $_SESSION['user']->getUID(), $_POST['postCategory']);
    }else if($_POST['action'] == 'new'){
        Posts::createPost($_POST['postTitle'], $_POST['postBody'], 'published', null, null, $_SESSION['user']->getUID(), $_POST['postCategory']);
    }
}else if ($is_delete) {
    Posts::deletePost($_GET['delete']);
    header("Location: ./index.php");
}

?>

<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./createpost.php">Create Post <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./categories.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Edit Links</a>
                </li>
            </ul>
        </nav>

        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
            <form method="post">
            <h1>Create Post</h1>

            <div class="form-group">
                <h3 for="postTitle">Post Title</h3>
                <input type="text" class="form-control" id="postTitle" placeholder="Post title goes here" name="postTitle">
            </div>
            <?php
            PostCategories::getCategoryDropdown('postCategory');
            ?>
            <div class="form-group">
                <label for="postBody">Post Body</label>
                <textarea class="form-control" id="postBody" rows="13" name="postBody"></textarea>
            </div>


            <button type="submit" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" name="action" value="<?= $is_edit? "update" : "new"?>"> Submit</button>
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