<?php
include('includes/header.php');
findSelectedPage();
?>
<div class="container mt-3">
    <h1>Adding New Page</h1>
    <?php if (!empty($message)) {
        echo "<p class=\"alert alert-danger\">" . $message . "</p>";
    } ?>
    <?php if (!empty($errors)) {
        displayErrors($errors);
    } ?>
    <form action="create_page.php?sub=<?php echo $selected_subject['id']; ?>" method="POST">
        <?php $new_page = true; ?>
        <?php include("page_form.php"); ?>
        <input type="submit" name="submit" value="Create Page">
    </form>
    <br>
    <a href="edit_subject.php?sub=<?php echo $selected_subject['id']; ?>">Cancel</a>
</div>
<?php include('includes/footer.php'); ?>