<?php
session_start();
$email = $password = $emailError =  $passwordError = $accountErr = "";

if (empty($_SESSION['status'])) {
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

    // when there is no error, save new data to our database file
    if ($passwordError == "" && $emailError === "") {
        if (!checkIfAccountsExists($email, $password)) {
            $db = fopen("database/database.txt", "a") or die("Unable to open file!");
            $txt = "$email $password\n";
            fwrite($db, $txt);
            header('Location:login.php');
            fclose($db);
        } else {
            $accountErr = "Account already exist, You can log in now.";
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
// check if the data exists
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
<h1 class="text-center my-5"> Zuri Basic Authentication</h1>
<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-primary text-center">
                Register
            </h3>
        </div>
        <div class="card-body">
            <small class="text-danger"><?php echo $accountErr; ?></small>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter your email" name="email">
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
                        Have a account already?
                        <a href="login.php" class="card-link ml-3">Log in</a>
                    </small>
                </div>
            </form>

        </div>
    </div>
</div>


<?php include('./template/footer.php') ?>