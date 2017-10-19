<?php
include_once('../includes/User.php');
session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user']->isAdmin())){
    header('Location: ../login');
}
include_once('./header.php');
?>


<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Overview <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./createpost.php">Create Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./categories.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./links.php">Edit Links</a>
                </li>
            </ul>
        </nav>

        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
            <h1>Links</h1>
            <h2>Create New Link</h2>
            <form>
                <div class="form-group">
                    <label for="categoryName">Link Name</label>
                    <input type="text" class="form-control" id="categoryName" aria-describedby="emailHelp" placeholder="Link Name">
                </div>
                <div class="form-group">
                    <label for="categorySlug">Link URL</label>
                    <input type="text" class="form-control" id="categorySlug" placeholder="Link URL">

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <br/>
            <br/>
            <h2>Categories</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Link Title</th>
                        <th>Link URL</th>
                        <th>Link Times Clicked</th>
                        <th>Delete Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1,001</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td><a href="#" class="text-danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>1,002</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td><a href="#" class="text-danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>1,003</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td><a href="#" class="text-danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>1,004</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td><a href="#" class="text-danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>1,005</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td><a href="#" class="text-danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>1,006</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td><a href="#" class="text-danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>1,007</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td><a href="#" class="text-danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>1,008</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td><a href="#" class="text-danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>1,009</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td><a href="#" class="text-danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>1,010</td>
                        <td>Lorem</td>
                        <td>ipsum</td>
                        <td>dolor</td>
                        <td><a href="#" class="text-danger">Delete</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
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