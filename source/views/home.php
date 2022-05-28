<?php require_once __DIR__ . "/../layouts/navbar.php"; ?>

<div id="banner" class="d-flex justify-content-center align-items-center">
    <p class="display-3 text-capitalize text-light mb-0">feed your brain</p>
</div>

<!-- Filter initialization -->
<div class="container">
    <div class="row justify-content-start pt-5" style="user-select: none;">
        <div class="border border-2 rounded">
            <div class="col-12 col-md-4">
                <div class="form-check form-check-inline fs-5">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1">
                    <label class="form-check-label" for="inlineCheckbox1">Category Name Bla bla</label>
                </div>
                <div class="form-check form-check-inline fs-5">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2">
                    <label class="form-check-label" for="inlineCheckbox2">Category</label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cards initialization -->
<div class="container">
    <div class="row py-5">
        <div class="col-12 col-md-4 mt-3">
            <div class="book text-light card-has-bg click-col" style="background-image:url('https://source.unsplash.com/600x900/?tech,street');">
                <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                <div class="card-img-overlay d-flex flex-column">
                    <div class="card-body">
                        <small class="text-warning mb-2">Thought Leadership</small>
                        <a href="#" class="h4 d-block mt-0 text-light ">Goverment Lorem Ipsum Sit Amet Consectetur dipisi?</a>
                        <small><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                                <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z" />
                                <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z" />
                            </svg> Tech</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-4 mt-3">
            <div class="book text-light card-has-bg click-col" style="background-image:url('https://source.unsplash.com/600x900/?tech,street');">
                <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                <div class="card-img-overlay d-flex flex-column">
                    <div class="card-body">
                        <small class="text-warning mb-2">Thought Leadership</small>
                        <a href="#" class="h4 d-block mt-0 text-light ">Goverment Lorem Ipsum Sit Amet Consectetur dipisi?</a>
                        <small><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                                <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z" />
                                <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z" />
                            </svg> Tech</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mt-3">
            <div class="book text-light card-has-bg click-col" style="background-image:url('https://source.unsplash.com/600x900/?tech,street');">
                <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                <div class="card-img-overlay d-flex flex-column">
                    <div class="card-body">
                        <small class="text-warning mb-2">Thought Leadership</small>
                        <a href="#" class="h4 d-block mt-0 text-light ">Goverment Lorem Ipsum Sit Amet Consectetur dipisi?</a>
                        <small><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                                <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z" />
                                <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z" />
                            </svg> Tech</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../layouts/footer.php"; ?>
<?php require_once __DIR__ . "/../layouts/scripts.php"; ?>
<script src="<?= PATH . "source/assets/js/footer.js" ?>"></script>