<?php
include('includes/header.php');
findSelectedPage();
confirmLoggedInStatus();
?>
<div class="container mt-3">
    <h1>Add Subject</h1>
    <form action="create_subject.php" method="POST">
        <div class="mb-3 d-flex align-items-baseline">
            <label for="menu_name" class="form-label me-3">Subject Name</label>
            <input type="text" class="form-control w-auto" name="menu_name" id="menu_name">
        </div>
        <div class="mb-3">
            <span class="me-3">Position</span>
            <select id="position" name="position">
                <?php
                    $subject_set = getAllSubjects();
                    $subject_count = mysqli_num_rows($subject_set);
                    for($count = 1; $count <= $subject_count+1; $count++) {
                        echo "<option value=\"{$count}\">{$count}</option>";
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <span class="me-3">Visible:</span>
            <input class="form-check-input" type="radio" name="visible" id="visible_yes" value="1">
            <label class="form-check-label me-3" for="visible_yes">Yes</label>
            <input class="form-check-input" type="radio" name="visible" id="visible_no" value="0">
            <label class="form-check-label me-3" for="visible_no">No</label>
        </div>
        <button type="submit" class="btn btn-primary">Add Subject</button>
    </form>
    <br>
    <a href="content.php">Cancel</a>
</div>
<?php include('includes/footer.php'); ?>