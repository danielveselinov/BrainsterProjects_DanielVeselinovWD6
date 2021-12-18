<?php include "./source/connection.php" ?>
<!doctype html>
<html>
    <head>
        <title>Project 01 - Brainster Labs</title>
        <meta charset="utf-8" />
        <meta name="keywords" content="brainster, labs, brainster labs, academy, full sack, web development" />
        <meta name="description" content="Brainster Labs is first project for Full Stack Academy" />
        <meta name="author" content="Daniel Veselinov" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />

        <!-- Latest compiled and minified Bootstrap 4.6.1 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        <!-- Latest Font-Awesome CDN -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

        <link rel="stylesheet" href="./assets/css/style.css">
    </head>
    <body class="d-flex flex-column justify-content-between vh-100 bg-yellow position-relative">
        <!-- Alert after submitting the form -->
        <?php 
            if (isset($_GET['true'])) {
                echo '
                <div class="alert alert-success alert-dismissible fade show position-fixed" role="alert">
                    <strong>Честитки!</strong> Вашето барање е регистрирано база и ќе биде процесирано наскоро
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
            else if (isset($_GET['false'])) {
                echo '
                <div class="alert alert-warning alert-dismissible fade show position-fixed" role="alert">
                    <strong>Грешка!</strong> Неуспешен обид за испраќање на податоците до серверот
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
            else if (isset($_GET['false-course'])) {
                echo '
                <div class="alert alert-warning alert-dismissible fade show position-fixed" role="alert">
                    <strong>Грешка!</strong> Задолжително е да одберете ставка од полето Тип на студент
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        ?>
        <!-- Default navbar laptop and more -->
        <nav class="d-flex justify-content-between align-items-center bg-primary">
            <a href="./home" class="nav-link ml-5">
                <div class="d-flex justify-content-center">
                    <div class="d-block">
                        <img src="./assets/images/logo.png" class="logo" alt="Brainster Logo">
                        <p class="small font-weight-bold text-dark text-uppercase mb-0">brainster</p>
                    </div>
                </div>
            </a>
            <div class="nav-content">
                <ul class="d-flex align-items-center font-weight-bold list-unstyled mb-0">
                    <li class="nav-link mr-md-0 mr-lg-5">
                        <a class="text-dark" href="https://brainster.co/marketing/">Академија за маркетинг</a>
                    </li>
                    <li class="nav-link mr-md-0 mr-lg-5">
                        <a class="text-dark" href="https://brainster.co/full-stack/">Академија за програмирање</a>
                    </li>
                    <li class="nav-link mr-md-0 mr-lg-5">
                        <a class="text-dark" href="https://brainster.co/data-science/">Академија за data science</a>
                    </li>
                    <li class="nav-link mr-md-0 mr-lg-5">
                        <a class="text-dark" href="https://brainster.co/graphic-design/">Академија за дизајн</a>
                    </li>
                    <li class="nav-link mr-md-0 mr-lg-5">
                        <a href="./form" class="btn btn-danger font-weight-bold">Вработи наш студент</a>
                    </li>
                </ul>
            </div>
            <button onclick="toggleSidebar()" class="toggle-mobile-icon mr-5"><span></span><span></span><span></span></button>
        </nav>
        <!-- Initaliznig mobile navbar -->
        <div class="mobile-nav bg-dark">
            <div class="mobile-content py-5 position-relative">
                <button onclick="toggleSidebar()" class="toggle-mobile-icon text-light mr-5"><i class="fas fa-times fa-3x"></i></button>
                <ul class="d-flex flex-column align-items-start list-unstyled font-weight-bold py-5">
                    <li class="nav-link mb-2">
                        <a href="https://brainster.co/marketing/" class="text-light">Академија за маркетинг</a>
                    </li>
                    <li class="nav-link mb-2">
                        <a href="https://brainster.co/full-stack/" class="text-light">Академија за програмирање</a>
                    </li>
                    <li class="nav-link mb-2">
                        <a href="https://brainster.co/data-science/" class="text-light">Академија за data science</a>
                    </li>
                    <li class="nav-link mb-2">
                        <a href="https://brainster.co/graphic-design/" class="text-light">Академија за дизајн</a>
                    </li>
                    <li class="nav-link mb-2">
                        <a href="./form" class="btn btn-danger font-weight-bold">Вработи наш студент</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Banner initialization -->
        <div class="container-fluid">
            <div class="banner d-flex justify-content-center align-items-center py-5">
                <p class="display-3 text-capitalize text-dark font-weight-bold mb-0 py-5">Вработи студенти</p>
            </div>

            <!-- Form initialization -->
            <div class="container custom-b-padding">
                <form action="./source/process.php" method="POST" class="py-4">
                    <div class="form-row">
                        <div class="col-12 col-md">
                            <label class="font-weight-bold" for="full_name">Име и Презиме</label>
                            <input type="text" class="form-control p-4" id="full_name" name="full_name" placeholder="Вашето име и презиме" required>
                        </div>
                        <div class="col-12 col-md">
                            <label class="font-weight-bold" for="company_name">Име на компанија</label>
                            <input type="text" class="form-control p-4" id="company_name" name="company_name" placeholder="Име на вашата компанија" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-12 col-md">
                            <label class="font-weight-bold" for="company_email">Контакт имејл</label>
                            <input type="email" class="form-control p-4" id="company_email" name="company_email" placeholder="Контакт имејл на вашата компанија" required>
                        </div>
                        <div class="col-12 col-md">
                            <label class="font-weight-bold" for="company_mobile">Контакт телефон</label>
                            <input type="text" class="form-control p-4" id="company_mobile" name="company_mobile" placeholder="Контакт телефон на вашата компанија" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-12 col-md">
                            <label class="font-weight-bold" for="dropdownMenuButton">Тип на студент</label>
                            <select class="custom-select custom-select-lg font-weight-bold" id="type_of_student" name="type_of_student" required>
                                <option selected disabled>Изберете тип на студент</option>
                                <?php 
                                    $fetch = mysqli_query($SQL, "SELECT * FROM courses");

                                    if (mysqli_num_rows($fetch) > 0) {
                                        while ($courses = mysqli_fetch_assoc($fetch)) { ?>
                                            <option value="<?php echo $courses["id"]; ?>"><?php echo $courses["course"]; ?></option>
                                       <?php }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-md">
                            <label class="invisible">испрати форма</label>
                            <button id="btn_submit" name="hire_student" type="submit" class="btn btn-danger font-weight-bold text-uppercase btn-block p-3">испрати</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Footer initialization -->
        <footer class="bg-dark text-light text-center mt-5">
            <p class="font-weight-bold p-3 mb-0">Изработено со <span class="text-danger">&hearts;</span> од студентите на Brainster</p>
        </footer>

        <!-- jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- custom JavaScript intalize -->
        <script src="./assets/js/main.js"></script>
        <!-- Latest Compiled Bootstrap 4.4.1 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    </body>
</html>