<?php

use BLibrary\Auth\Auth;
use BLibrary\Database\Connection\DB;

if (!Auth::isAdmin() || !Auth::isLogged()) {
    redirect(route('home'));
}

require_once __DIR__ . "/../layouts/navbar.php"; ?>

<div id="modal-load"></div>

<div class="container py-3">
    <ul class="nav nav-tabs" id="myTab">
        <li class="nav-item">
            <button class="nav-link active" id="dashboard-tab" data-bs-target="#dashboard" data-bs-toggle="tab">Dashboard</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="categories-tab" data-bs-target="#categories" data-bs-toggle="tab">Categories</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="authors-tab" data-bs-target="#authors" data-bs-toggle="tab">Authors</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="comments-tab" data-bs-target="#comments" data-bs-toggle="tab">Comments</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="books-tab" data-bs-target="#books" data-bs-toggle="tab">Books</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div id="notification" class="mt-4"></div>
        <div class="tab-pane fade show active" id="dashboard">
            <strong>Stats:</strong> categoris(a, in_a), authors, comments, books -> same(boxes)
        </div>
        <div class="tab-pane fade" id="categories">
            <small class="small text-uppercase fw-bold mt-2 mb-0">insert new categry</small>
            <form class="form-floating mb-3">
                <input type="text" class="form-control" id="category_name" placeholder="e.g. Marketing, Business, etc.">
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

        <div class="tab-pane fade" id="authors">
            <small class="small text-uppercase fw-bold mt-2 mb-0">insert new author</small>
            <form class="row g-2">
                <div class="col col-md col-xl-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="author_name" placeholder="John">
                        <label for="author_name">First Name</label>
                    </div>        
                </div>
                <div class="col col-md col-xl-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="author_surname" placeholder="Doe">
                        <label for="author_surname">Last Name</label>
                    </div>
                </div>
                <div class="col col-md col-xl-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="author_about" placeholder="Author short bio. (min. 20 chars)..">
                        <label for="author_about">Author short bio. (min. 20 chars)..</label>
                    </div>
                </div>
                <div class="d-block mt-0">
                    <button id="createAuthorAction" class="btn btn-outline-dark btn-sm mt-1">Insert author</button>
                </div>
            </form>
            
            <div class="container">
                <ul class="list-group my-4" id="authors_list">
                    <?php $stmt = DB::connect()->query("SELECT * FROM authors WHERE 1");
                    if ($stmt->rowCount() > 0) {
                        while ($authorData = $stmt->fetch()) { ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center <?= ($authorData['is_deleted'] ? 'bg-secondary' : '') ?>">
                                <div class="d-flex">
                                    <p class="fw-bold mb-0 me-4">Author: </p><?= $authorData['name'] . " " . $authorData['surname'] ?>
                                </div>
                                <div class="d-flex">
                                    <?php
                                    if (!$authorData['is_deleted']) { ?>
                                        <span id="updateAuthorModalA" data-author-id="<?= $authorData['id'] ?>" data-name="<?= $authorData['name'] ?>" data-surname="<?= $authorData['surname'] ?>" data-about="<?= $authorData['about'] ?>" data-created="<?= $authorData['created_at'] ?>" class="badge bg-warning rounded-pill mx-2 pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </span>
                                        <span id="deleteAuthorModal" data-author-id="<?= $authorData['id'] ?>" class="badge bg-danger rounded-pill mx-2 pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                                                <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                                            </svg>
                                        </span>
                                    <?php } else { ?>
                                    <span id="restoreAuthorAction" data-author-id="<?= $authorData['id'] ?>" class="badge bg-danger rounded-pill mx-2 pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                        </svg>
                                    </span>
                                </div>
                            </li>
                    <?php } } } else { echo "<li class='list-group-item fw-bold'>No authors found yet</li>"; } ?>
                </ul>
            </div>
        </div>
        
        <div class="tab-pane fade" id="comments">
            comments read, restore, delete
        </div>

        <div class="tab-pane fade" id="books">
            books crud
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../layouts/scripts.php"; ?>
<script type="module" src="<?= PATH . "source/assets/js/modules.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/categories.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/authors.js" ?>"></script>