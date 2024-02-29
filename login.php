<?php include('includes/header.php'); ?>
<?php
if (loggedIn()) {
    redirectTo('staff.php');
}

if (isset($_POST['submit'])) {
    $errors = array();

    $required_fields = array('username', 'password');
    $errors = array_merge($errors, checkRequiredFields($required_fields));

    $field_length = array('username' => 30, 'password' => 30);
    $errors = array_merge($errors, checkMaxFieldLength($field_length));

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $hashed_password = sha1($password);

    if (empty($errors)) {
        $query = "SELECT id, username FROM users WHERE username = '{$username}' AND hashed_password = '{$hashed_password}' LIMIT 1";
        $result = mysqli_query($conn, $query);
        queryCheck($result);
        if (mysqli_num_rows($result) == 1) {
            $found_user = mysqli_fetch_array($result);
            $_SESSION['user_id'] = $found_user['id'];
            $_SESSION['username'] = $found_user['username'];
            redirectTo('staff.php');
        } else {
            $message = "Incorrect credentials.";
        }
    } else {
        $message = count($errors) . " error(s) in the form.";
    }

} else {
    if(isset($_GET['logout']) && $_GET['logout'] == 1) {
        $message = "You are now logged out.";
    }
    $username = '';
    $password = '';
}
?>

<div class="container">
    <h3>Login</h3>
    <?php if (!empty($message)) {
        echo "<p class=\"alert alert-success\">" . $message . "</p>";
    } ?>
    <?php if (!empty($errors)) {
        displayErrors($errors);
    } ?>
    <form action="login.php" method="POST">
        <div class="mb-3">
            <span>Username: </span>
            <input class="form-control w-auto" type="text" name="username" maxlength="30"
                value="<?php echo htmlentities($username); ?>" />
        </div>
        <div class="mb-3">
            <span>Password: </span>
            <input class="form-control w-auto" type="password" name="password" maxlength="30"
                value="<?php echo htmlentities($password); ?>" />
        </div>
        <input type="submit" name="submit" value="Login">
    </form>
</div>
<?php include('includes/footer.php') ?>