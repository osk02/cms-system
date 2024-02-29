<?php
define('BASE_URL', 'http://localhost/cms/');
include('dbconn.php');
include('functions.php');
include('session.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>CMS System</title>

    <!-- Bootstrap CSS File -->
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS File -->
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header id="header">
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php if(loggedIn()) { echo 'staff.php'; } else { echo 'index.php'; } ?>">CMS System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-end">
                        <?php
                        $subject_set = getAllSubjects();
                        while ($subject = mysqli_fetch_array($subject_set)) {
                            if (loggedIn()) {
                                echo "<li class=\"nav-item\">
                                <a class=\"nav-link\" href=\"content.php?sub=" . urlencode($subject['id']) . "\">| {$subject["menu_name"]}</a>
                                </li>";
                            } else {
                                echo "<li class=\"nav-item\">
                                <a class=\"nav-link\" href=\"index.php?sub=" . urlencode($subject['id']) . "\">| {$subject["menu_name"]}</a>
                                </li>";
                            }
                            $page_set = getPagesForSubjects($subject["id"]);
                            while ($page = mysqli_fetch_array($page_set)) {
                                if (loggedIn()) {
                                    echo "<li class=\"nav-item\">
                                    <a class=\"nav-link\" href=\"content.php?page=" . urlencode($page['id']) . "\">o {$page["menu_name"]}</a>
                                    </li>";
                                } else {
                                    echo "<li class=\"nav-item\">
                                    <a class=\"nav-link\" href=\"index.php?page=" . urlencode($page['id']) . "\">o {$page["menu_name"]}</a>
                                    </li>";
                                }
                            }
                        } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php if(loggedIn()) { echo 'logout.php">Logout'; } else { echo 'login.php">Login'; } ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main style="min-height: 100vh;">