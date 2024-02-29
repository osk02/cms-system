</main>
<footer class="bg-body-tertiary text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2024 Copyright:
        <a class="text-body" href="/">Content Management System</a>
    </div>
</footer>
</body>
</html>
<?php
if (isset($conn)) {
    mysqli_close($conn);
}
?>