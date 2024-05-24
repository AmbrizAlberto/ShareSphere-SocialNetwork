<!--
This file represents the error 404 page.
It displays a message indicating that the requested page does not exist.
The user is provided with a button to go back to the home page.
-->

<?php require "includes/header.php"; ?>
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1 class="display-1 fw-bold">404</h1>
        <p class="fs-3"> <span class="text-danger">Opps!</span> Page not found.</p>
        <p class="lead">
            The page you’re looking for doesn’t exist.
        </p>
        <a href="<?php echo APPURL; ?>" class="btn btn-primary">Go Home</a>
    </div>
</div>

<?php //require "includes/footer.php"; 
?>