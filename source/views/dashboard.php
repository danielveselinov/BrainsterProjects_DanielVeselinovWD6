<?php

use BLibrary\Auth\Auth;
use BLibrary\Database\Connection\DB;

if (!Auth::isAdmin() || !Auth::isLogged()) {
    redirect(route('home'));
}

require_once __DIR__ . "/../layouts/navbar.php"; ?>

<div class="container py-3">
    <ul class="nav nav-tabs" id="myTab">
        <li class="nav-item">
            <button class="nav-link active" id="dashboard-tab" data-bs-target="#dashboard" data-bs-toggle="tab">Dashboard</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="categories-tab" data-bs-target="#categories" data-bs-toggle="tab">Categories</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div id="notification" class="mt-4"></div>
        <div class="tab-pane fade show active" id="dashboard">
            This section is still in progress..
        </div>
        <div class="tab-pane fade" id="categories">
            <form class="form-floating mb-3">
                <input type="text" class="form-control mt-4" id="category_name" placeholder="e.g. Marketing, Business, etc.">
                <label for="category_name">e.g. Marketing, Business, etc.</label>
                <button id="createCategoryAction" class="btn btn-outline-dark btn-sm mt-1">Create category</button>
            </form>

            <div class="container">
                <div class="row justify-content-center my-5" id="categories_list">
                    <?php $stmt = DB::connect()->query("SELECT * FROM categories WHERE 1");
                    if ($stmt->rowCount() > 0) {
                        while ($categoryData = $stmt->fetch()) { ?>
                            <div class="col-12 col-md-4 col-xl-3 mt-2" id="category<?= $categoryData['id'] ?>">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="category_title_<?= $categoryData['id'] ?>" placeholder="Category" value="<?= $categoryData['title'] ?>">
                                            <label for="category">Category</label>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <?php 
                                        if ($categoryData['is_deleted']) { ?>
                                            <span class="xs-small text-uppercase text-danger mb-0">deleted</span>
                                            <button id="restoreCategoryAction" data-category-id="<?= $categoryData['id'] ?>" class="btn btn-warning btn-sm mt-1">Restore</button>
                                        <?php } else if (!$categoryData['is_deleted']) { ?>
                                            <button id="updateCategoryAction" data-category-id="<?= $categoryData['id'] ?>" class="btn btn-outline-primary btn-sm mt-1">Update</button>
                                            <button id="deleteCategory" data-category-id="<?= $categoryData['id'] ?>" class="btn btn-danger btn-sm mt-1">Delete</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="col-12">
                            <div class="card border-0">
                                <div class="card-footer">
                                <p class="lead mb-0">No categories were found yet</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../layouts/scripts.php"; ?>
<script type="module" src="<?= PATH . "source/assets/js/modules.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/categories.js" ?>"></script>