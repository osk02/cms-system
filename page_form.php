<?php require_once('includes/session.php'); ?>
<?php confirmLoggedInStatus(); ?>
<?php
if (!isset($new_page)) {
    $new_page = false;
}
?>
<div class="mb-3 d-flex align-items-baseline">
    <label for="menu_name" class="form-label me-3">Page Name</label>
    <input type="text" class="form-control w-auto" name="menu_name" value="<?php if(isset($selected_page)){ echo $selected_page['menu_name']; } ?>"
        id="menu_name">
</div>
<div class="mb-3">
    <span class="me-3">Position</span>
    <select id="position" name="position">
        <?php
        if(!$new_page) {
            $page_set = getPagesForSubjects($selected_page['subject_id']);
            $page_count = mysqli_num_rows($page_set);
        } else {
            $page_set = getPagesForSubjects($selected_subject['id']);
            $page_count = mysqli_num_rows($page_set) + 1;
        }
        for ($count = 1; $count <= $page_count; $count++) {
            echo "<option value=\"{$count}\"";
            if (isset($selected_page) && $selected_page['position'] == $count) {
                echo "selected";
            }
            echo ">{$count}</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <span class="me-3">Visible:</span>
    <input class="form-check-input" type="radio" name="visible" id="visible_yes" value="1" <?php if (isset($selected_page) && $selected_page['visible'] == 1) {
        echo " checked";
    } ?>>
    <label class="form-check-label me-3" for="visible_yes">Yes</label>
    <input class="form-check-input" type="radio" name="visible" id="visible_no" value="0" <?php if (isset($selected_page) && $selected_page['visible'] == 0) {
        echo " checked";
    } ?>>
    <label class="form-check-label me-3" for="visible_no">No</label>
</div>
<div class="mb-3">
    <span class="me-3">Content:</span>
    <textarea name="content" rows=20 cols=80><?php if(isset($selected_page)){ echo $selected_page['content'];} ?></textarea>
</div>