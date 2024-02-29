<?php
require_once('includes/dbconn.php');
require_once('includes/functions.php');
?>
<?php
$errors = array();
$required_fields = array('menu_name', 'position', 'visible', 'content');
foreach ($required_fields as $fieldname) {
    if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
        $errors[] = $fieldname;
    }
}
$length_validation = array('menu_name' => 30);
foreach ($length_validation as $fieldname => $maxlength) {
    if (strlen(trim(htmlspecialchars($_POST[$fieldname]))) > $maxlength) {
        $errors[] = $fieldname;
    }
}

if (!empty($errors)) {
    redirectTo("new_page.php");
}
?>
<?php
$menu_name = htmlspecialchars($_POST['menu_name']);
$position = htmlspecialchars($_POST['position']);
$visible = htmlspecialchars($_POST['visible']);
$content = htmlspecialchars($_POST['content']);
$subject_id = htmlspecialchars($_GET['sub']);

$query = "INSERT INTO pages (subject_id, menu_name, position, visible, content) VALUES({$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}')";
if (mysqli_query($conn, $query)) {
    header("Location: content.php");
    exit;
} else {
    echo "<p>Page creation failed.</p>";
    echo "<p>" . mysqli_error($conn) . "</p>";
}
?>
<?php mysqli_close($conn); ?>