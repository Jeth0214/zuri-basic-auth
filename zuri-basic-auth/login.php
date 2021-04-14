<?php
session_start();
$email = $password = $emailError =  $passwordError = $accountErr = "";

if ($_SESSION['status'] == 'invalid' || empty($_SESSION['status'])) {
    /* Set Default Invalid */
    $_SESSION['status'] = 'invalid';
}


if ($_SESSION['status'] == 'valid') {
    header('Location: home.php');
}
if (isset($_POST['submit'])) {

    //email validation
    if (empty($_POST['email'])) {
        $emailError = "Email is Required";
    } else {
        $email = clean_input_data($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }
    };

    //password validation
    if (empty($_POST['password'])) {
        $passwordError = "Password is required";
    } else {
        $password = clean_input_data($_POST['password']);
        $password = md5($password);
    }

    // when there is no error, check if the database has this data
    if ($passwordError == "" && $emailError === "") {
        $ifExist = checkIfAccountsExists($email, $password);
        if (!$ifExist) {
            $accountErr = "Email/password is incorrect.";
        } else {
            $_SESSION['status'] = 'valid';
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header('Location:home.php');
        }
    }
};


//clean the given input value
function clean_input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkIfAccountsExists($email, $password)
{

    $data =  "$email $password";
    $db = "database/database.txt";
    $dataArray =  file_get_contents($db);
    $newArray = explode("\n", $dataArray);

    return array_search($data, $newArray) > -1 ? true : false;
}

?>



<?php include('./template/header.php') ?>
<div class="container">
    <h1 class="text-center my-5"> Zuri Basic Authentication</h1>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-primary text-center">
                Log In
            </h3>
        </div>
        <div class="card-body">
            <small class="form-text text-danger text-center"><?php echo $accountErr; ?></small>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter your email" name="email" value="<?php echo $email; ?>">
                    <small id="email" class="form-text text-danger"><?php echo $emailError; ?></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <small id="email" class="form-text text-danger"><?php echo $passwordError; ?></small>
                </div>

                <input type="submit" name="submit" class="btn btn-primary" value="Submit">

                <div class="card-text text-center">
                    <small>
                        Not registered yet?
                        <a href="register.php" class="card-link ml-3">Register Here</a>
                    </small>
                </div>
            </form>

        </div>
    </div>
</div>


<?php include('./template/footer.php') ?>