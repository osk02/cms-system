<?php session_start();

function loggedIn() {
    return isset($_SESSION['user_id']);
}
function confirmLoggedInStatus() {
    if (!loggedIn()) {
        redirectTo('login.php');
    }
}
?>