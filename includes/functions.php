<?php
function publicNavigation(){}
function queryCheck($res) {
    global $conn;
    if (!$res) {
        die("DB Query Failed: " . mysqli_error($conn));
    }
}
function getAllSubjects($public = true) {
    global $conn;
    $query = "SELECT * FROM subjects ";
    if($public) {
        $query .= "WHERE visible = 1";
    }
    $query .= " ORDER BY position ASC";
    $result = mysqli_query($conn, $query);
    queryCheck($result);

    return $result;
}
function getPagesForSubjects($subject_id) {
    global $conn;
    $query = "SELECT * FROM pages WHERE subject_id={$subject_id}";
    // if($public) {
    //     $query .= " AND visible = 1";
    // }
    $query .= " ORDER BY position ASC";
    $result = mysqli_query($conn, $query);
    queryCheck($result);

    return $result;
}
function getSubjectById($subject_id) {
    global $conn;
    $query = "SELECT * FROM subjects WHERE id={$subject_id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    queryCheck($result);

    if ($subject = mysqli_fetch_array($result)) {
        return $subject;
    } else {
        return NULL;
    }
}
function getPageById($page_id) {
    global $conn;
    $query = "SELECT * FROM pages WHERE id={$page_id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    queryCheck($result);

    if ($page = mysqli_fetch_array($result)) {
        return $page;
    } else {
        return NULL;
    }
}

function getDefaultPage($subject_id) {
    $page_set = getPagesForSubjects($subject_id, true);
    if($first_page = mysqli_fetch_array($page_set)) {
        return $first_page;
    } else {
        return NULL;
    }
}
function findSelectedPage() {
    global $selected_subject;
    global $selected_page;
    if (isset($_GET['sub'])) {
        $selected_subject = getSubjectById($_GET['sub']);
        $selected_page = getDefaultPage($selected_subject['id']);
    } elseif (isset($_GET['page'])) {
        $selected_page = getPageById($_GET['page']);
        $selected_subject = NULL;
    } else {
        $selected_subject = NULL;
        $selected_page = NULL;
    }
}
function redirectTo($location = NULL) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

// Form Functions Below
function checkRequiredFields($required) {
    $errors = array();
    foreach($required as $fieldname) {
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname]) && $_POST[$fieldname] != 0) {
            $errors[] = $fieldname;
        }
    }

    return $errors;
}

function checkMaxFieldLength($length) {
    $errors = array();
    foreach ($length as $fieldname => $maxlength) {
        if (strlen(trim(htmlspecialchars($_POST[$fieldname]))) > $maxlength) {
            $errors[] = $fieldname;
        }
    }

    return $errors;
}

function displayErrors($errors) {
    echo "<p class=\"alert alert-danger\">";
    echo "Please review the following fields: <br>";
    foreach ($errors as $err) {
        echo " - " . $err . "<br>";
    }
    echo "</p>";
}
?>