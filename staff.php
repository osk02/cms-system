<?php include('includes/header.php'); ?>
<?php confirmLoggedInStatus(); ?>
<div class="container">
    <h2 class="mt-4 pt-4">Staff Menu</h2>
    <p>Welcome to the staff area, <?php echo $_SESSION['username']; ?></p>
    <ul>
        <li><a href="content.php">Manage Website Content</a></li>
        <li><a href="new_user.php">Add Staff User</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
<?php include('includes/footer.php'); ?>