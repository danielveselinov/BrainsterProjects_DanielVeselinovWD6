<?php

use BLibrary\Auth\Auth;

if (!Auth::isAdmin() || !Auth::isLogged()) {
    redirect(route('home'));
}

require_once __DIR__ . "/../layouts/navbar.php"; ?>

<div class="container py-3">
    <ul class="nav nav-tabs" id="myTab">
        <li class="nav-item">
            <button class="nav-link active" id="home-tab" data-bs-target="#home" data-bs-toggle="tab">Home</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="profile-tab" data-bs-target="#profile" data-bs-toggle="tab">Profile</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="contact-tab" data-bs-target="#contact" data-bs-toggle="tab">Contact</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home">
            sec 1
        </div>
        <div class="tab-pane fade" id="profile">
            sec 2
        </div>
        <div class="tab-pane fade" id="contact">
            sec 3
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../layouts/scripts.php"; ?>