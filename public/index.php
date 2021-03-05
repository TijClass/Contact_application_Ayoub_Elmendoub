<?php
$crud = require_once "../core/init.php";

if (!isset($_SESSION["userId"]) && !$crud->checkCookie()) {
    header("location:login.php");
    die();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>kkk</title>
    <!-- external Styles-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="../assets/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- external js scripts -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery-ui.js"></script>
</head>

<body>
<header class="d-xl-flex py-3" style="background: linear-gradient(73deg, #094c71, #0e5691 100%);">
    <div class="container">
        <div class="row">
            <div class="col col-2">
                <h1>logo</h1>
            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <a class="btn btn-light" href="<?= 'logout.php?userId=' . $_SESSION["userId"] ?>"><i class="fa fa-chevron-left"></i>&nbsp; Logout</a>
            </div>
        </div>
    </div>
</header>

<main>
    <section>
        <h1 class="text-center my-5">Contact list</h1>
        <div class="container">
            <div class="row">
                <div class="col col-6"></div>
                <div class="col d-flex justify-content-xl-center align-items-xl-center">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input class="form-control" type="text" placeholder="Search">
                        <div class="input-group-append">
                            <button id="add" name="add" class="btn btn-primary ml-2" type="button">Add Person</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <table class="table table-striped shadow bg-white rounded bg-gray mt-3">
                    <thead>
                    <tr>
                        <th class="text-center" width="10%" scope="col">ID</th>
                        <th class="text-center" width="10%" scope="col">Firstname</th>
                        <th class="text-center" width="10%" scope="col">Lastname</th>
                        <th class="text-center" width="20%" scope="col">Email</th>
                        <th class="text-center" width="10%" scope="col">Adress</th>
                        <th class="text-center" width="10%" scope="col">Phone</th>
                        <th class="text-center" width="10%" scope="col">Group</th>
                        <th class="text-center" width="20%" scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody id="contact-data">
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<!-- Modal -->

<div id="user_dialog" title="App Person">
    <form method="post" id="user_form">
        <div class="row">
            <div class="mb-3 col-6">
                <label class="col-form-label">First name:</label>
                <input maxlength="20" type="text" id="fname" name="fname" class="form-control" required>
            </div>
            <div class="mb-3 col-6">
                <label class="col-form-label">Last name:</label>
                <input maxlength="20" type="text" id="lname" name="lname" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label class="col-form-label">Email:</label>
                <input maxlength="40" type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3 col-6">
                <label class="col-form-label">Address:</label>
                <input type="text" id="address" name="address" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label class="col-form-label">Phone:</label>
                <input maxlength="20" type="text" id="phone" name="phone" class="form-control" required>
            </div>
            <fieldset class="mb-3 col-6">
                <label for="group-text" class="col-form-label d-block mb-1">Group:</label>
                <input required class="shadow ml-3 mr-1" type="radio" id="family" name="group" value="family"> <label for="family">Family</label>
                <input required class="shadow ml-3 mr-1" type="radio" id="friend" name="group" value="friend"> <label for="friend">Friend</label><br>
                <input required class="shadow ml-3 mr-1" type="radio" id="business" name="group" value="business"> <label for="business">Business</label>
            </fieldset>
        </div>
        <div class="row">
            <div class="mb-3 ml-3">
                <label class="col-form-label">Note:</label>
                <textarea name="note" class="form-control" required></textarea>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 text-right ml-3">
                <input type="hidden" name="action" id="action">
                <input type="hidden" name="id" id="hidden_id">
                <button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
    </form>
</div>

<div id="action_alert" title="Action">

</div>

<div id="delete_confirmation" title="Confirmation">
    <p>Are you sure you want to Delete this data?</p>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>

</html>