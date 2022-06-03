<?php

use BLibrary\Auth\Auth;
use BLibrary\Database\Connection\DB;
use BLibrary\Router\Router;

$stmt = DB::connect()->prepare("SELECT `books`.*, `authors`.`name`, `authors`.`surname`, `authors`.`about`, `categories`.`title` as category_title 
FROM `books`
JOIN `authors` ON `books`.`existing_author_id` = `authors`.`id`
JOIN `categories` ON `books`.`category` = `categories`.`id` WHERE `books`.`code` = ?");
$stmt->execute([Router::get(3)]);

if ($stmt->rowCount() == 0) {
    redirect(route('home'));
}

$bookData = $stmt->fetch();

require_once __DIR__ . "/../layouts/navbar.php"; ?>

<div class="container">
    <div class="row py-5">
        <div class="col-12 col-md-4">
            <img class="img-thumbnail w-75 d-md-block ms-md-auto" src="<?= $bookData['cover_image'] ?>" />
        </div>
        <div class="col-12 col-md-6">
            <p class="fs-2 fw-bold mb-0"><?= $bookData['title'] ?></p>
            <p class="fs-4 lead mb-0"><?= $bookData['name'] . " " . $bookData['surname'] ?></p>
            <p class="fs-6 lead mb-0">Category: <strong><?= ucfirst($bookData['category_title']) ?></strong></p>
            <p class="fs-6 lead mb-0">Originally published: <strong><?= $bookData['published'] ?></strong></p>
            <p class="fs-6 lead mb-0">Pages: <strong><?= $bookData['pages'] ?></strong></p>

        </div>
    </div>
</div>

<div class="container">
    <div class="row pb-5 justify-content-center">
        <div class="col-md-10 col-xl-8">
            <p class="fw-bold small text-uppercase ps-0">comments</p>
            <div class="card">
                <?php $stmt = DB::connect()->query("SELECT comments.*, users.id as user_id, users.fullname, users.is_admin FROM comments
                JOIN `users` ON `comments`.`existing_user_id` = users.id 
                WHERE 1");
                // MORA: ako vekje ima komentar da ne moze da komentira pak..
                if ($stmt->rowCount() > 0) {
                    while ($commentsData = $stmt->fetch()) {
                        if ($bookData['id'] == $commentsData['commented_on_book']) {
                            if ($commentsData['is_approved']) { ?>
                                <div class="card-body border-bottom" id="comments">
                                    <?php if ($commentsData['user_id'] == Auth::id() || Auth::isAdmin()) {
                                        echo "<div class='float-end'>
                                                    <button id='deleteCommentAction' data-comment-id='{$commentsData['id']}' class='btn btn-danger btn-sm'>Delete comment</button>
                                                </div>";
                                    } ?>
                                    <h5 class="fw-bold text-primary mb-1"><?= $commentsData['fullname'] ?></h5>
                                    <p class="text-muted small mb-0"><?= $commentsData['created_at'] ?></p>
                                    <p class="mt-3 mb-0"><?= $commentsData['comment'] ?></p>
                                </div>
                            <?php } else if (!$commentsData['is_approved'] && Auth::id() == $commentsData['existing_user_id']) { ?>
                                <div class="card-body border-bottom" id="comments" style="background-color: #ffb7b7;">
                                    <?php if ($commentsData['user_id'] == Auth::id() || Auth::isAdmin()) {
                                        echo "<div class='float-end'>
                                                    <button id='deleteCommentAction' data-comment-id='{$commentsData['id']}' class='btn btn-danger btn-sm'>Delete comment</button>
                                                </div>";
                                    } ?>
                                    <h5 class="fw-bold text-primary mb-1"><?= $commentsData['fullname'] ?></h5>
                                    <p class="text-muted small mb-0"><?= $commentsData['created_at'] ?></p>
                                    <p class="mt-3 mb-0"><?= $commentsData['comment'] ?></p>
                                </div>
                <?php }
                        }
                    }
                } else {
                    echo "<p class='ms-3 mt-3'>There aren't any comments yet</p>";
                } ?>

                <?php if (Auth::isLogged()) { ?>
                    <form class="card-footer">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="comment" style="height: 100px; resize: none;"></textarea>
                            <label for="comment">Leave a comment here</label>
                        </div>
                        <div class="float-end mt-2 pt-1">
                            <button id="commentAction" class="btn btn-primary btn-sm">Post comment</button>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="card-footer py-3">
                        Please <a class="text-decoration-none" href="<?= route('login') ?>">Sign In</a> or <a class="text-decoration-none" href="<?= route('register') ?>">Sign Up</a> to leave a comment..
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row pb-5 justify-content-center">
        <div class="col-md-10 col-xl-8" id="ajax">
            <?php
            if (Auth::isLogged()) { ?>
                <div id="notification"></div>
                <div class="d-flex align-items-center mb-2">
                    <p class="fw-bold small text-uppercase my-auto me-2">private notes</p>
                    <button id='addMyNoteAction' class='btn btn-outline-dark btn-sm text-uppercase'>Create note</button>       
                </div>
                <div class="card" id="new_note" style="display: none;">
                    <div class="form-floating">
                        <textarea class="form-control border-0" placeholder="Leave a note here" id="newNote" style="height: 100px; resize: none;"></textarea>
                        <label for="newNote">Leave a note here</label>
                    </div>
                    <div class="card-footer">
                        <button id='createMyNoteAction' data-user-id='<?= Auth::id() ?>' data-book-code='<?= $bookData['id'] ?>' class='btn btn-outline-dark btn-sm'>Submit</button>
                    </div>
                </div>
           <?php } 
            $stmt = DB::connect()->query("SELECT `notes`.*, `users`.`id` as user_id, `books`.`id` as book_id FROM notes
            JOIN `users` ON `notes`.`existing_user_id` = `users`.`id`
            JOIN `books` ON `notes`.`note_on_book` = `books`.`id`
            WHERE `notes`.`note_on_book` = {$bookData['id']} ORDER BY created_at DESC");

            if ($stmt->rowCount() > 0) {
                while ($notesData = $stmt->fetch()) { 
                    if (Auth::isLogged() && $notesData['user_id'] == Auth::id()) { ?>
                    <div class="accordion mt-2" id="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $notesData['id'] ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $notesData['id'] ?>">
                                    Note # - <?= $notesData['created_at'] ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $notesData['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordion<?= $notesData['id'] ?>">
                                <div class="accordion-body">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a note here" id="noteContent" style="height: 100px; resize: none;"><?= $notesData['note_text'] ?></textarea>
                                        <label for="noteContent">Leave a note here</label>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button id='updateMyNoteAction' data-note-id='<?= $notesData['id'] ?>' class='btn btn-outline-dark btn-sm'>Update note</button>
                                    <button id='deleteMyNoteAction' data-note-id='<?= $notesData['id'] ?>' class='btn btn-danger btn-sm'>Delete note</button>
                                </div>
                            </div>
                        </div>
                    </div>
              <?php } } } ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../layouts/scripts.php"; ?>
<script type="module" src="<?= PATH . "source/assets/js/modules.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/book_notes.js" ?>"></script>