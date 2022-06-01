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
                <!-- ako vekje ima komentar taj korisnik ne moze nov, ako e author togaj ima delete comment kopce, ako e admin togas ima isto delete, opcii -->
                <div class="card-body">
                    <!-- ako e on avtor izbrisi komentar, plus administrator da go ima ovoa -->
                    <div class="float-end">
                        <button id="deleteCommentAction" class="btn btn-danger btn-sm">Delete comment</button>
                    </div>
                    <h5 class="fw-bold text-primary mb-1">Lily Coleman</h5>
                    <p class="text-muted small mb-0">Joined - 2022.06.01</p>
                    <p class="mt-3 pb-2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.
                    </p>
                </div>

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

<?php require_once __DIR__ . "/../layouts/scripts.php"; ?>