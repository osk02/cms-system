<?php include('includes/header.php'); ?>
<?php confirmLoggedInStatus(); ?>
<?php
if (intval($_GET['sub']) == 0) {
    redirectTo("content.php");
}
if (isset($_POST['submit'])) {
    $errors = array();
    $required_fields = array('menu_name', 'position', 'visible', 'content');
    $errors = array_merge($errors, checkRequiredFields($required_fields));

    $length_validation = array('menu_name' => 30);
    foreach ($length_validation as $fieldname => $maxlength) {
        if (strlen(trim(htmlspecialchars($_POST[$fieldname]))) > $maxlength) {
            $errors[] = $fieldname;
        }
    }

    if (empty($errors)) {
        $id = htmlspecialchars($_GET['sub']);
        $menu_name = htmlspecialchars($_POST['menu_name']);
        $position = htmlspecialchars($_POST['position']);
        $visible = htmlspecialchars($_POST['visible']);

        $query = "UPDATE subjects SET menu_name = '{$menu_name}', position = '{$position}', visible = '{$visible}' WHERE id = {$id}";
        $result = mysqli_query($conn, $query);
        queryCheck($result);
        if (mysqli_affected_rows($conn) == 1) {
            $message = "The subject was successfully updated.";
        } else {
            $message = "The subject update failed.";
            $message .= "<br>" . mysqli_error($conn);
        }
    } else {
        $message = count($errors) . " error(s) in the form.";
    }
} // END isset(submit)
findSelectedPage();
?>
<div class="container mt-3">
    <h1>Edit Subject:
        <?php echo $selected_subject['menu_name']; ?>
    </h1>
    <?php if (!empty($message)) {
        echo "<p class=\"alert alert-danger\">" . $message . "</p>";
    } ?>
    <?php
    if (!empty($errors)) {
        echo "<p class=\"alert alert-danger\">";
        echo "Please review the following fields: <br>";
        foreach ($errors as $err) {
            echo " - " . $err . "<br>";
        }
        echo "</p>";
    }
    ?>
    <form action="edit_subject.php?sub=<?php echo urlencode($selected_subject['id']); ?>" method="POST">
        <div class="mb-3 d-flex align-items-baseline">
            <label for="menu_name" class="form-label me-3">Subject Name</label>
            <input type="text" class="form-control w-auto" name="menu_name"
                value="<?php echo $selected_subject['menu_name']; ?>" id="menu_name">
        </div>
        <div class="mb-3">
            <span class="me-3">Position</span>
            <select id="position" name="position">
                <?php
                $subject_set = getAllSubjects();
                $subject_count = mysqli_num_rows($subject_set);
                for ($count = 1; $count <= $subject_count + 1; $count++) {
                    echo "<option value=\"{$count}\"";
                    if ($selected_subject['position'] == $count) {
                        echo "selected";
                    }
                    echo ">{$count}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <span class="me-3">Visible:</span>
            <input class="form-check-input" type="radio" name="visible" id="visible_yes" value="1" <?php if ($selected_subject['visible'] == 1) {
                echo " checked";
            } ?>>
            <label class="form-check-label me-3" for="visible_yes">Yes</label>
            <input class="form-check-input" type="radio" name="visible" id="visible_no" value="0" <?php if ($selected_subject['visible'] == 0) {
                echo " checked";
            } ?>>
            <label class="form-check-label me-3" for="visible_no">No</label>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Edit Subject</button>
        <a class="ms-3" href="delete_subject.php?sub=<?php echo urlencode($selected_subject['id']); ?>" onclick="return confirm('Are you sure?');">Delete Subject</a>
    </form>
    <br>
    <a href="content.php">Cancel</a>
    <div class="container">
        <h3>Pages in this subject:</h3>
        <ul>
            <?php
                $subject_pages = getPagesForSubjects($selected_subject['id']);
                while($page = mysqli_fetch_array($subject_pages)) {
                    echo "<li><a href=\"content.php?page={$page['id']}\">{$page['menu_name']}</a></li>";
                }
            ?>
        </ul><br>
        <span>+ <a href="new_page.php?sub=<?php echo $selected_subject['id']; ?>">Add a new page to this subject</span>
    </div>
</div>
<?php require('includes/footer.php'); ?>