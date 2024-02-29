<?php include('includes/header.php'); findSelectedPage(); ?>
<div class="container">
    <?php if (!is_null($selected_subject)) { ?>
        <h1>
            <?php echo $selected_subject['menu_name']; ?>
        </h1>
    <?php } elseif (!is_null($selected_page)) { ?>
        <h1>
            <?php echo $selected_page['menu_name']; ?>
        </h1>
        <div class="container page-content">
            <?php echo $selected_page['content']; ?>
        </div>
    <?php } else {?>
        <h1>Select a page to edit</h1>
    <?php }?>
    <br>
    <?php if(isset($selected_page)) { ?>
        <a class="ms-3" href="edit_page.php?page=<?php echo urlencode($selected_page['id']); ?>">Edit Page</a>
    <?php } ?>
    <?php if(isset($selected_subject['menu_name'])) { ?>
        <a class="ms-3" href="edit_subject.php?sub=<?php echo urlencode($selected_subject['id']); ?>">Edit Subject</a>
    <?php } ?>
</div>
<?php include('includes/footer.php'); ?>