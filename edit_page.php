<?php include('includes/header.php'); ?>
<?php confirmLoggedInStatus(); ?>
<?php
if (intval($_GET['page']) == 0) {
    redirectTo("content.php");
}
if (isset($_POST['submit'])) {
    $errors = array();
    $required_fields = array('menu_name', 'position', 'visible', 'content');
    $errors = array_merge($errors, checkRequiredFields($required_fields));

    $field_length = array('menu_name' => 30);
    $errors = array_merge($errors, checkMaxFieldLength($field_length));

    $id = htmlspecialchars($_GET['page']);
    $menu_name = htmlspecialchars($_POST['menu_name']);
    $position = htmlspecialchars($_POST['position']);
    $visible = htmlspecialchars($_POST['visible']);
    $content = htmlspecialchars($_POST['content']);


    if (empty($errors)) {
        $query = "UPDATE pages SET menu_name = '{$menu_name}', position = '{$position}', visible = '{$visible}', content = '{$content}' WHERE id = {$id}";
        $result = mysqli_query($conn, $query);
        if (mysqli_affected_rows($conn) == 1) {
            $message = "The page was successfully updated.";
        } else {
            $message = "The page update failed.";
            $message .= "<br>" . mysqli_error($conn);
        }
    } else {
        $message = count($errors) . " error(s) in the form.";
    }
} // END isset(submit)
findSelectedPage();
?>
<div class="container mt-3">
    <h1>Edit Page:
        <?php echo $selected_page['menu_name']; ?>
    </h1>
    <?php if (!empty($message)) {
        echo "<p class=\"alert alert-danger\">" . $message . "</p>";
    }
    if (!empty($errors)) {
        displayErrors($errors);
    }
    ?>
    <form action="edit_page.php?page=<?php echo urlencode($selected_page['id']); ?>" method="POST">
        <?php include("page_form.php"); ?>
        <input type="submit" name="submit" value="Update Page">
        <a class="ms-3" href="delete_page.php?page=<?php echo urlencode($selected_page['id']); ?>"
            onclick="return confirm('Are you sure you want to delete this page?');">Delete Page</a>
    </form>
    <br>
    <a href="content.php?page=<?php echo $selected_page['id']; ?>">Cancel</a>
</div>
<?php include('includes/footer.php'); ?>