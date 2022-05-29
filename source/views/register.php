<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="d-flex flex-column col-10 col-md-3">
        <div class="form-floating mb-3">
            <input type="email" class="form-control is-invalid" id="email" placeholder="name@example.com">
            <label for="email">Email address</label>
            <div id="validationServerEmailAddress" class="invalid-feedback">
                Please provide valid email address
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="fullname" placeholder="John Doe">
            <label for="fullname">Full name</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>
        
        <button id="signUpAction" class="btn btn-primary mt-3">Sign Up</button>
        <a href="<?= route("home") ?>" class="btn btn-danger mt-2">Go Back</a>

        <p class="lead fs-6 ps-0 mt-2">Already have an account? <a href="<?= route("login") ?>" class="text-decoration-none">Sign In</a></p>
    </div>
</div>

<?php require_once __DIR__ . "/../layouts/scripts.php"; ?>
<script src="<?= PATH . "source/assets/js/register.js" ?>"></script>