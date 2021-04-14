<?php
require('./session.php');
$newpassword =   $passwordError = "";
if (isset($_POST['submit'])) {


    //password validation
    if (empty($_POST['newpassword'])) {
        $passwordError = "Password is required";
    } else {
        $newpassword = clean_input_data($_POST['newpassword']);
        $newpassword = md5($newpassword);
    }

    //when there is no error, check if the database has this data
    if ($passwordError == "") {
        $email = $_SESSION['email'];
        $oldPassword = $_SESSION['password'];
        echo $email;
        echo '<br>';
        echo $oldPassword;
        echo '<br>';
        $data =  "$email $oldPassword";
        $db = "database/database.txt";
        $dataArray =  file_get_contents($db);
        $newArray = explode("\n", $dataArray);
        print_r($newArray);
        echo '<br>';
        echo array_search($data, $newArray);
        echo '<br>';
        echo $newpassword;
        echo '<br>';
        $index = array_search($data, $newArray);
        $newArray[$index] = "$email $newpassword";
        print_r($newArray);
        $myfile = fopen($db, "w") or die("Unable to open file!");

        foreach ($newArray as $i => $val) {
            fwrite($myfile, "$val\n");
        }

        fclose($myfile);
        header('Location:home.php');
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
?>

<?php include('./template/header.php') ?>
<h1 class="text-center my-5"> Reset Password</h1>
<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-primary text-center">
                Enter our new Password
            </h3>
        </div>
        <div class="card-body">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="newpassword">
                    <small id="email" class="form-text text-danger"><?php echo $passwordError; ?></small>
                </div>

                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </form>

        </div>
    </div>
</div>

<?php include('./template/footer.php') ?>