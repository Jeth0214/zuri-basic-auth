<?php
require('./session.php');
?>

<?php include('./template/header.php') ?>
<div class="container">
    <h1 class="text-center my-5">Welcome to Zuri Dasboard </h1>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-primary text-center">
                Profile
            </h3>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Your Email: </strong> <?php echo $_SESSION['email'] ?></li>
                <li class="list-group-item"><strong>Your hashed password: </strong> <?php echo $_SESSION['password'] ?></li>
            </ul>
            <div class="d-flex justify-content-between">
                <div class="">
                    <a href=" resetpassword.php" class="btn btn-success">Reset Password?</a>
                </div>
                <div class="">
                    <form action="logout.php" method="post">
                        <input type="submit" value="LOGOUT" class="btn btn-warning " />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('./template/footer.php') ?>