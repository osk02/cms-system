<?php include('includes/header.php'); ?>
<?php findSelectedPage(); ?>
<div class="container">
    <?php if ($selected_page) { ?>
        <h2>
            <?php echo htmlentities($selected_page['menu_name']); ?>
        </h2>
        <div class="container page-content">
            <?php echo strip_tags($selected_page['content']); ?>
        </div>
    <?php } else { ?>
        <h2 class="mt-4">Welcome to the CMS System</h2>
        <p>Content management system to demonstrate the CRUD operations developed in PHP with MySQL as the database. It
            makes use of various concepts of PHP which includes sessions, cookies, connection with MySQL, etc.</p>
    <?php } ?>
</div>
<?php include('includes/footer.php'); ?>