<?php
    require_once('bd.php');
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="Content-Type" content="text/html;"> -->
    <meta name="format-detection" content="telephone=no">
    <!-- <meta http-equiv="x-rim-auto-match" content="none"> -->
    <meta name="viewport" content="user-scalable=yes, width=device-width">
    <title>Scrooge China | Пополни свой аккаунт buff163 через нас.</title>
    <meta name="keywords" content="">
    <meta name="description" content="Scrooge China - Это сервис который поможем вам пополнить свой аккаунт Buff.163 в считанные секунды, по самому выгодному курс и без потерь. Публичность заключается в полной прозрачности, предсказуемости и автоматизированности работы.">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="images/favicon.png">
    <!-- <link rel="canonical" href=”link”> -->
    <script defer src="js/tag.js"></script>
    <script type="text/javascript" async src="js/insert.js"></script>
    <script src="js/html5shiv.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/all.css" crossorigin="anonymous">
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/slick.css" rel="stylesheet" type="text/css">
    <link href="css/slick-theme.css" rel="stylesheet" type="text/css">
    <link href="css/jquery.fancybox.css" rel="stylesheet" type="text/css">
    <link href="css/nouislider.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link href="css/mobile.css" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="css/hyper.css"> -->
    <script type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>
    <!-- <script defer type="text/javascript" src="js/embed.js" ></script> -->
</head>

<body>
    <!-- <div id="preloader">
        <div class="inner">
        </div>
    </div> -->
    <div class="main" id="main">
        <header>
            <div class="container">
                <div class="header-blocks">
                    <a href="/" class="logo" aria-label="На главную">
                        <img src="fonts/logo.svg" style="width: 218px;" alt="scroogechina"></a>

                    <div class="header-right">

                        <nav class="main-menu">
                            <div class="top-block">
                                <div class="logo">
                                    <img src="fonts/logo-white.svg" alt="Scrooge" style="width: 218px;">

                                </div>
                                <button class="mob-nav-close"></button>
                            </div>


                            <div class="btn-login-group">
                                <?php
                                if (isset($_SESSION['logged_user'])) :
                                    $_SESSION['go'] = false;
                                    $max_mum = max(R::getCol('SELECT chat FROM users'));
                                    $_SESSION['num'] = $max_mum;
                                    $id = $_SESSION['logged_user']['id'];
                                    $user_priv = $_SESSION['logged_user']['privelegies'];
                                    $user = R::findOne('users', 'id = ?', [$id]);
                                    $user = $user_priv !== '1' ? $user->chat : '1';
                                    ?>
                                    <a <?=$user !== '0' ? "href='/chat.php'" : 'onclick="transaction()"'?> data-toggle="modal" class="btn btn-login">
                                        <i class="far fa-user-circle"></i>
                                        Чат
                                    </a>

                                </br>
                                <a href="/logout.php" class="btn btn-login">
                                &nbsp;&nbsp;&nbsp;  <i class="far fa-sign-in-alt"></i>
                                        &nbsp; 
                                    </a>
                                <?php else :?>
                                    <a href="/login.php" class="btn btn-login">
                                        <i class="far fa-sign-in-alt"></i>
                                        Вход
                                    </a>
                                    <a href="/registration.php" class="btn btn-login">
                                        <i class="far fa-user-plus"></i>
                                        Регистрация
                                    </a>
                                <?php endif; ?>
                            </div>
                            <ul class="menu-items">
                                <li class="ico-home"><a href="/" class="ico-home">Главная</a></li>
                                <li class="nav-open"><a href="#how" class="ico-flag nav-open-fix">О нашей работе</a>
                                    <ul>
                                        <li><a href="#how" class="smoothScroll">Как мы работаем?</a></li>
                                        <li><a href="#steps" class="smoothScroll">Как пополнить Buff.163?</a></li>
                                        <li><a href="#calc"  class="smoothScroll">Калькулятор
                                                пополнения</a></li>
                                        <li><a href="#features" class="smoothScroll">Преимущества работы с нами</a></li>
                                    </ul>
                                </li>

                                <li><a href="/reviews.php" class="ico-testimonials">Отзывы</a></li>
                                <li><a href="#faqq" class="ico-faq">FAQ</a></li>
                                <li><a href="#contacts" class="ico-contacts smoothScroll">Контакты</a></li>
                            </ul>

                            <div class="contacts">
                                <div class="item">
                                    <i class="ico-email"></i>
                                    <a href="mailto:support@scrooge-china.com">support@scrooge-china.com</a>
                                </div>
                            </div>
                        </nav>

                        <button class="btn btn-login">
                        <?php if (isset($_SESSION['logged_user'])) : ?>
                                     <a <?=$user !== '0' ? "href='/chat.php'" : 'onclick="transaction()"'?>>
                                        <i class="far fa-user-circle"></i>
                                        Чат&nbsp;
                                    </a>
                                    </br>
                                <?php else : ?>
                                    <a href="/login.php" class="btn btn-login">
                                        <i class="far fa-sign-in-alt"></i>
                                        Вход
                                    </a>
                                    <a href="/registration.php" class="btn btn-login">
                                        <i class="far fa-user-plus"></i>
                                        Регистрация
                                    </a>
                                <?php endif; ?>
                        </button>
                        <a href="#" class="mob-nav">
                            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1C0 0.447715 0.447715 0 1 0H19C19.5523 0 20 0.447715 20 1C20 1.55228 19.5523 2 19 2H1C0.447715 2 0 1.55228 0 1ZM0 7C0 6.44772 0.447715 6 1 6H19C19.5523 6 20 6.44772 20 7C20 7.55228 19.5523 8 19 8H1C0.447715 8 0 7.55228 0 7ZM1 12C0.447715 12 0 12.4477 0 13C0 13.5523 0.447715 14 1 14H19C19.5523 14 20 13.5523 20 13C20 12.4477 19.5523 12 19 12H1Z" fill="black" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <div class="header-fix">
            <div class="container">
                <div class="header-blocks">
                    <a href="/" class="logo"><img src="fonts/logo-white.svg" style="width: 218px;" alt="scrooge"></a>
                    <div class="header-right">
                        <nav>
                            <ul>
                                <li class="ico-home"><a href="/" class="ico-home">Главная</a></li>
                                <li class="nav-open"><a href="#how" class="ico-flag nav-open-fix">О нашей работе</a>
                                    <ul>
                                        <li><a href="#how" class="smoothScroll">Как мы работаем?</a></li>
                                        <li><a href="#steps" class="smoothScroll">Как пополнить Buff.163?</a></li>
                                        <li><a href="#calc" class="smoothScroll">Калькулятор пополнения</a></li>
                                        <li><a href="#features" class="smoothScroll">Преимущества работы с нами</a></li>
                                    </ul>

                                </li>

                                <li><a href="reviews.php" class="ico-testimonials">Отзывы</a></li>
                                <li><a href="#faqq" class="ico-faq">FAQ</a></li>
                                <li><a href="#contacts" class="ico-contacts smoothScroll">Контакты</a></li>
                            </ul>
                        </nav>
                        <button class="btn btn-login">
                        <?php if (isset($_SESSION['logged_user'])) : ?>
                                    <a <?=$user !== '0' ? "href='/chat.php'" : 'onclick="transaction()"'?> >
                                        <i class="far fa-user-circle"></i>
                                        Чат
                                    </a>
                                    </br>
                                <?php else : ?>
                                    <a href="/login.php" class="btn btn-login">
                                        <i class="far fa-sign-in-alt"></i>
                                        Вход
                                    </a>
                                    <a href="/registration.php" class="btn btn-login">
                                        <i class="far fa-user-plus"></i>
                                        Регистрация
                                    </a>
                                <?php endif; ?>
                        </button>
                        <a href="#" class="mob-nav" aria-label="menu">
                            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1C0 0.447715 0.447715 0 1 0H19C19.5523 0 20 0.447715 20 1C20 1.55228 19.5523 2 19 2H1C0.447715 2 0 1.55228 0 1ZM0 7C0 6.44772 0.447715 6 1 6H19C19.5523 6 20 6.44772 20 7C20 7.55228 19.5523 8 19 8H1C0.447715 8 0 7.55228 0 7ZM1 12C0.447715 12 0 12.4477 0 13C0 13.5523 0.447715 14 1 14H19C19.5523 14 20 13.5523 20 13C20 12.4477 19.5523 12 19 12H1Z" fill="black" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider">
            <div id="slider">
                <div>
                    <div class="slider-item">
                        <div class="container">
                            <div class="inner">
                                <div class="slider-item-image"><img src="images/yuan.webp" alt="валюта"></div>
                                <div class="slider-item-content">
                                    <div class="slider-item-title">Пополни свой аккаунт Buff.163. </div>
                                    <div class="slider-item-text">Быстро и выгодно!</div>
                                    <div class="slider-btns">
                                        <a href="#how" class="btn2 smoothScroll">Подробнее
                                            <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.9124 6.55604C13.8569 6.41294 13.7736 6.28222 13.6673 6.17135L7.83159 0.342824C7.72276 0.234136 7.59357 0.147919 7.45139 0.0890975C7.3092 0.0302756 7.15681 0 7.00291 0C6.6921 0 6.39401 0.123318 6.17423 0.342824C6.06541 0.451513 5.97908 0.580545 5.92019 0.722554C5.8613 0.864563 5.83098 1.01677 5.83098 1.17048C5.83098 1.48091 5.95445 1.77862 6.17423 1.99813L10.0258 5.8333H1.16715C0.857604 5.8333 0.560734 5.95611 0.341851 6.17473C0.122968 6.39334 0 6.68984 0 6.99901C0 7.30817 0.122968 7.60467 0.341851 7.82328C0.560734 8.0419 0.857604 8.16471 1.16715 8.16471H10.0258L6.17423 11.9999C6.06484 12.1083 5.97801 12.2372 5.91875 12.3792C5.8595 12.5213 5.82899 12.6736 5.82899 12.8275C5.82899 12.9814 5.8595 13.1338 5.91875 13.2758C5.97801 13.4179 6.06484 13.5468 6.17423 13.6552C6.28273 13.7644 6.41182 13.8512 6.55405 13.9103C6.69628 13.9695 6.84883 14 7.00291 14C7.15699 14 7.30954 13.9695 7.45177 13.9103C7.594 13.8512 7.72309 13.7644 7.83159 13.6552L13.6673 7.82666C13.7736 7.71579 13.8569 7.58507 13.9124 7.44197C14.0292 7.15817 14.0292 6.83984 13.9124 6.55604Z" />
                                            </svg>
                                        </a>
                                        <form action="#calc">
                                        <button class="btn">
                                            Рассчитать баланс
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="slider-item">
                        <div class="container">
                            <div class="inner">
                                <div class="slider-item-image"><img src="images/yuan-trading.webp" alt="обмен"></div>
                                <div class="slider-item-content">
                                    <div class="slider-item-title">Без потерь на комиссию!</div>
                                    <h2 class="slider-item-text">Вы не теряете свои деньги на внутреннею комиссию BUFF!
                                    </h2>
                                    <div class="slider-btns">
                                        <a href="#steps" class="btn2 smoothScroll">Подробнее
                                            <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.9124 6.55604C13.8569 6.41294 13.7736 6.28222 13.6673 6.17135L7.83159 0.342824C7.72276 0.234136 7.59357 0.147919 7.45139 0.0890975C7.3092 0.0302756 7.15681 0 7.00291 0C6.6921 0 6.39401 0.123318 6.17423 0.342824C6.06541 0.451513 5.97908 0.580545 5.92019 0.722554C5.8613 0.864563 5.83098 1.01677 5.83098 1.17048C5.83098 1.48091 5.95445 1.77862 6.17423 1.99813L10.0258 5.8333H1.16715C0.857604 5.8333 0.560734 5.95611 0.341851 6.17473C0.122968 6.39334 0 6.68984 0 6.99901C0 7.30817 0.122968 7.60467 0.341851 7.82328C0.560734 8.0419 0.857604 8.16471 1.16715 8.16471H10.0258L6.17423 11.9999C6.06484 12.1083 5.97801 12.2372 5.91875 12.3792C5.8595 12.5213 5.82899 12.6736 5.82899 12.8275C5.82899 12.9814 5.8595 13.1338 5.91875 13.2758C5.97801 13.4179 6.06484 13.5468 6.17423 13.6552C6.28273 13.7644 6.41182 13.8512 6.55405 13.9103C6.69628 13.9695 6.84883 14 7.00291 14C7.15699 14 7.30954 13.9695 7.45177 13.9103C7.594 13.8512 7.72309 13.7644 7.83159 13.6552L13.6673 7.82666C13.7736 7.71579 13.8569 7.58507 13.9124 7.44197C14.0292 7.15817 14.0292 6.83984 13.9124 6.55604Z" />
                                            </svg>
                                        </a>
                                        <form action="#calc">
                                            <button class="btn">
                                                Пополнить Buff163
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="slider-item">
                        <div class="container">
                            <div class="inner">
                                <div class="slider-item-image"><img src="images/giving-yuan-coin.webp" alt="руки с монетой"></div>
                                <div class="slider-item-content">
                                    <h1 class="slider-item-title">Весь процесс пополнения занимает максимум 5 минут при условии</h1>
                                    <div class="slider-item-text">если ты работаешь с нами!</div>
                                    <div class="slider-btns">
                                        <a href="#tarifs" class="btn2 smoothScroll">Рассчитать
                                            <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.9124 6.55604C13.8569 6.41294 13.7736 6.28222 13.6673 6.17135L7.83159 0.342824C7.72276 0.234136 7.59357 0.147919 7.45139 0.0890975C7.3092 0.0302756 7.15681 0 7.00291 0C6.6921 0 6.39401 0.123318 6.17423 0.342824C6.06541 0.451513 5.97908 0.580545 5.92019 0.722554C5.8613 0.864563 5.83098 1.01677 5.83098 1.17048C5.83098 1.48091 5.95445 1.77862 6.17423 1.99813L10.0258 5.8333H1.16715C0.857604 5.8333 0.560734 5.95611 0.341851 6.17473C0.122968 6.39334 0 6.68984 0 6.99901C0 7.30817 0.122968 7.60467 0.341851 7.82328C0.560734 8.0419 0.857604 8.16471 1.16715 8.16471H10.0258L6.17423 11.9999C6.06484 12.1083 5.97801 12.2372 5.91875 12.3792C5.8595 12.5213 5.82899 12.6736 5.82899 12.8275C5.82899 12.9814 5.8595 13.1338 5.91875 13.2758C5.97801 13.4179 6.06484 13.5468 6.17423 13.6552C6.28273 13.7644 6.41182 13.8512 6.55405 13.9103C6.69628 13.9695 6.84883 14 7.00291 14C7.15699 14 7.30954 13.9695 7.45177 13.9103C7.594 13.8512 7.72309 13.7644 7.83159 13.6552L13.6673 7.82666C13.7736 7.71579 13.8569 7.58507 13.9124 7.44197C14.0292 7.15817 14.0292 6.83984 13.9124 6.55604Z" />
                                            </svg>
                                        </a>
                                        <form action="/login.php">
                                        <button class="btn">
                                            Присоединиться
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- <div class="nav-buttons">
            <div class="container">
                <button type="button" class="slick-prev slider-prev"><svg width="27" height="48" viewBox="0 0 27 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22.1817 0.753154C23.1859 -0.251051 24.8141 -0.251051 25.8183 0.753154C26.8225 1.75736 26.8225 3.3855 25.8183 4.3897L6.91508 23.2929C6.52456 23.6834 6.52456 24.3166 6.91508 24.7071L25.8183 43.6103C26.8225 44.6145 26.8225 46.2426 25.8183 47.2468C24.8141 48.2511 23.1859 48.2511 22.1817 47.2468L0.753154 25.8183C-0.251051 24.8141 -0.251051 23.1859 0.753154 22.1817L22.1817 0.753154Z" fill="black"/></svg></button>
                <button type="button" class="slick-next slider-next"><svg width="27" height="48" viewBox="0 0 27 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M4.38956 0.753154C3.38536 -0.251051 1.75722 -0.251051 0.753016 0.753154C-0.25119 1.75736 -0.25119 3.3855 0.753016 4.3897L19.6562 23.2929C20.0467 23.6834 20.0467 24.3166 19.6562 24.7071L0.753016 43.6103C-0.25119 44.6145 -0.25119 46.2426 0.753016 47.2468C1.75722 48.2511 3.38536 48.2511 4.38956 47.2468L25.8181 25.8183C26.8223 24.8141 26.8223 23.1859 25.8181 22.1817L4.38956 0.753154Z" fill="black"/></svg></button>
            </div>
        </div> -->
        </div>

        <div class="cnt">
            <a href="#how" class="mouse-btn smoothScroll wow fadeInUp">
                <svg width="20" height="29" viewBox="0 0 20 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 5.71429C9.62112 5.71429 9.25776 5.8648 8.98985 6.13271C8.72194 6.40061 8.57143 6.76398 8.57143 7.14286V10C8.57143 10.3789 8.72194 10.7422 8.98985 11.0102C9.25776 11.2781 9.62112 11.4286 10 11.4286C10.3789 11.4286 10.7422 11.2781 11.0102 11.0102C11.2781 10.7422 11.4286 10.3789 11.4286 10V7.14286C11.4286 6.76398 11.2781 6.40061 11.0102 6.13271C10.7422 5.8648 10.3789 5.71429 10 5.71429ZM10 0C7.34784 0 4.8043 1.05357 2.92893 2.92893C1.05357 4.8043 0 7.34784 0 10V18.5714C3.95203e-08 21.2236 1.05357 23.7671 2.92893 25.6425C4.8043 27.5179 7.34784 28.5714 10 28.5714C12.6522 28.5714 15.1957 27.5179 17.0711 25.6425C18.9464 23.7671 20 21.2236 20 18.5714V10C20 7.34784 18.9464 4.8043 17.0711 2.92893C15.1957 1.05357 12.6522 0 10 0ZM17.1429 18.5714C17.1429 20.4658 16.3903 22.2826 15.0508 23.6222C13.7112 24.9617 11.8944 25.7143 10 25.7143C8.1056 25.7143 6.28878 24.9617 4.94924 23.6222C3.60969 22.2826 2.85714 20.4658 2.85714 18.5714V10C2.85714 8.1056 3.60969 6.28878 4.94924 4.94924C6.28878 3.60969 8.1056 2.85714 10 2.85714C11.8944 2.85714 13.7112 3.60969 15.0508 4.94924C16.3903 6.28878 17.1429 8.1056 17.1429 10V18.5714Z" fill="white" />
                </svg>
            </a>
        </div>
        <div class="how" id="how">
            <div class="container">
                <div class="how-blocks">
                    <div class="how-image wow fadeInLeft"><img src="images/how.webp" alt="как?"></div>
                    <div class="how-content wow fadeInRight">
                        <div class="how-title">Как работает сервис от Scrooge?</div>
                        <p>Наша онлайн-платформа – это сервис благодаря которому вы сможете пополнить свой аккаунт <a href="https://buff.163.com/" rel="nofollow">Buff.163.com</a> в считаные секунды.
                            Публичность заключается в полной прозрачности, предсказуемости и автоматизированности работы.<br>
                            Для этого наша команда создала онлайн-кабинеты для каждого клиента и поддержку 24/7.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="steps" id="steps">
            <div class="container">
                <div class="steps-blocks">
                    <div class="steps-content wow fadeInRight">
                        <div class="steps-title">Как пополнить Buff163?</div>
                        <div class="steps-item">
                            <div class="steps-number">1.</div>
                            <div class="steps-text">Регистрация на платформе</div>
                        </div>
                        <div class="steps-item">
                            <div class="steps-number">2.</div>
                            <div class="steps-text">Выбор cуммы пополнения и ее оплата<br></div>
                        </div>
                        <div class="steps-item">
                            <div class="steps-number">3.</div>
                            <div class="steps-text">Отправка QR-кода</div>
                        </div>
                        <div class="steps-item">
                            <div class="steps-number">4.</div>
                            <div class="steps-text">Ожидание в течении нескольких минут</div>
                        </div>
                        <div class="steps-item last">
                            <div class="steps-number">5.</div>
                            <div class="steps-text">Ваши деньги на балансе Buff163</div>
                        </div>
                        <?php if (isset($_SESSION['logged_user'])) : ?>
                        <a href="#calc" class="btn btn3">Пополнить прямо сейчас</a>
                        <?php else:?>
                            <a href="/login.php" class="btn btn3">Пополнить прямо сейчас</a>
                            <?php endif;?>
                    </div>
                    <div class="steps-image wow fadeInLeft"><img src="images/Money.webp" alt="деньги"></div>
                </div>

            </div>
        </div>
        <div class="indic">
            <div class="container">
                <div class="indic-title wow fadeInUp">Наши показатели</div>
                <div class="indic-blocks wow fadeInUp">
                    <div class="indic-item">
                        <div class="indic-item-image"><img src="images/user-invest1.webp" loading="lazy" alt="отзывы"></div>
                        <div class="indic-item-number"><span>50+</span></div>
                        <div class="indic-item-text">Отзывов</div>
                    </div>
                    <div class="indic-item">
                        <div class="indic-item-image"><img src="images/new-user11.webp" loading="lazy" alt="новых пользователей"></div>
                        <div class="indic-item-number">+<span>243</span></div>
                        <div class="indic-item-text">Новых пользователей за 24 часа</div>
                    </div>
                    <div class="indic-item">
                        <div class="indic-item-image"><img src="images/oborot1.webp" loading="lazy" alt="чек"></div>
                        <div class="indic-item-number"><span>500</span> ¥</div>
                        <div class="indic-item-text">Средний чек</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="calc" id="calc">
        <div class="container">
            <div class="calc-blocks">
                <div class="calc-content wow fadeInLeft">
                    <div class="calc-title">Калькулятор<br> пополнения</div>
                    <div class="calc-text">Посчитайте, сколько<br> вы хотите получить на баланс</div>
                    <?php if (isset($_SESSION['logged_user'] ) and $_SESSION['logged_user']['privelegies']==0) : ?>
                    <div class="present-btn"><a class="pay_now btn btn3">Оплатить</a></div>
                    <?php else : ?>
                        <div class="present-btn"><a href="/login.php" class="btn btn3">Оплатить</a></div>
                        <?php endif; ?>
                </div>
                <div class="calc-item wow fadeInRight">
                    <div class="calc-item-title1">Способ оплаты</div>
                    <div class="payment-method-inp-block">
                    <select id="payment-method" class="payment-method">
                        <option value="QIWI">QIWI</option>
                        <option value="СБП(Тинькофф)">Tinkoff(СБП)</option>
                        <option value="BTC">BTC</option>
                        <option value="ETH">ETH</option>
                        <option value="USDt">USDt</option>
                        <option value="Сбербанк">Сбербанк</option>
                       </select>
                    </div>
                    <script async type="text/javascript" src="js/calculator.js"></script>
                    <div class="calc-item-title">Сумма пополнения</div>
                    <div class="calc-item-inp-block">
                        <input id='money' type="text" onchange="calculator(this.value)" class="calc-item-inp" value="100">
                        <div class="calc-item-inp-text" >¥</div>
                    </div>
                    <div class="calc-item-slider">
                        <div id="calc_slider"></div>
                    </div>
                    <div class="calc-item-info-blocks">
                        <div class="calc-item-info">
                            <div class="calc-item-info-block green">
                                <div class="calc-item-info-block-title">Курс</div>
                                <div class="calc-item-info-block-text">
                                    <?php
                                    $kurs = R::findOne('kurs', 'id = ?', ['1'])->kurs;
                                    ?>
                                    <span id="kurs"><?=$kurs?></span>₽
                                    <span class="sum2">=</span> 1¥
                                </div>
                            </div>
                            <div class="calc-item-info-block">
                                <div class="calc-item-info-block-title">Вы получите</div>
                                <div class="calc-item-info-block-text"><span id="get_calculator" class="sum1">0</span><i>₽</i></div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="present-btn"><a class="<?=isset($_SESSION['logged_user'] ) ? 'pay_now' : 'pay_no'?> btn btn3">Оплатить</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="steps features" id="features">
            <div class="container">
                <div class="steps-blocks">
                    <div class="steps-image wow fadeInLeft"><img src="images/Rocket.webp" loading="lazy" alt="ракета"></div>
                    <div class="steps-content wow fadeInRight">
                        <div class="steps-title">Преимущества работы с Scrooge China</div>
                        <div class="steps-item">
                            <div class="steps-number">1.</div>
                            <div class="steps-text">Быстрое пополнения баланса</div>
                        </div>
                        <div class="steps-item">
                            <div class="steps-number">2.</div>
                            <div class="steps-text">Не каких дополнительный комиссий</div>
                        </div>
                        <div class="steps-item">
                            <div class="steps-number">3.</div>
                            <div class="steps-text">Выбор способов пополнения</div>
                        </div>
                        <div class="steps-item">
                            <div class="steps-number">4.</div>
                            <div class="steps-text">Самый выгодный курс</div>
                        </div>
                        <div class="steps-item last">
                            <div class="steps-number">5.</div>
                            <div class="steps-text">Отзывчивая тех поддержка</div>
                        </div>
                        <?php if (isset($_SESSION['logged_user'])) : ?>
                        <a href="#calc" class="btn btn3">Пополнить прямо сейчас</a>
                        <?php else:?>
                            <a href="/login.php" class="btn btn3">Присоединяйся прямо сейчас</a>
                            <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <div class="present" id="present">
                <div class="container">
                    <div class="present-block">
                        <div class="present-content wow fadeInLeft">
                            <div class="present-title">Видео-инструкция<br> </div>
                            <div class="present-btn"><a href="https://youtu.be/aByt9l6RAG0" data-fancybox class="btn btn3">Смотреть сейчас</a></div>
                        </div>
                        <div class="present-video wow fadeInRight"><a href="https://youtu.be/aByt9l6RAG0" data-fancybox></a></div>
                    </div>
                </div>
            </div>
        <div class="faq">
            <div class="container">
                <div class="faq-blocks" id="faqq">
                    <div class="steps-image wow fadeInRight"><img src="images/question.webp" loading="lazy" alt="вопросы"></div>
                    <div class="faq-content wow fadeInLeft">
                        <div class="faq-title">Частые вопросы и ответы</div>
                        <div class="faq-item">
                            <div class="faq-item-title">
                                <p>Что такое Buff.163? Там можно заработать?</p>
                                <span class="faq-item-open"><svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.77701 7.53001L0.450621 0.500689C0.276869 0.307633 0.413877 0 0.673609 0H13.3264C13.5861 0 13.7231 0.307633 13.5494 0.50069L7.22299 7.53001C7.10382 7.66243 6.89618 7.66243 6.77701 7.53001Z" fill="black" />
                                    </svg></span>
                                <span class="faq-item-close"><svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.77701 0.247331L0.450621 7.27665C0.276869 7.46971 0.413877 7.77734 0.673609 7.77734H13.3264C13.5861 7.77734 13.7231 7.46971 13.5494 7.27665L7.22299 0.247331C7.10382 0.114917 6.89618 0.114917 6.77701 0.247331Z" fill="black" />
                                    </svg></span>
                            </div>
                            <div class="faq-item-content">
                                <p>Buff.163.com - это торговая площадка скинов CSGO/Dota/Tf2/Rust, является самой дешевой площадкой, которую вы только сможете найти в интернете.<br>
                                    Именно тут продаются популярные вещи из игр, например: Katowice 2014 Stickers | AWP - История о драконе | M4A4 - Вой.<br>
                                    Основная валюта сайта - Юани (¥RMB) и всё на этом сайте продаётся за RMB.<br>
                                    Цены на Market CSGO в отличии от Buff больше на 10%-40%.<br>
                                    Хотите заработать?
                                    Покупаете на Buff163, продаете на CsgoMarket и уходите в плюс <br>
                                    Пополняете при помощи нашего сайта деньги и опять на Buff163, повторяете это действие сколько вам угодно.
                                    <br>
                                    Чтобы не терять 5-10% прибыли изначально выводите деньги с Market CSGO на наш кошелёк USDT ( TRC20 ) чтобы не терять 3-5% на p2p. <br>
                                    И так и так, комиссия будет 5%, что на Киви/Карту/USDT.
                                </p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-item-title">
                                <p>Какие методы оплаты вы принимаете?</p>
                                <span class="faq-item-open"><svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.77701 7.53001L0.450621 0.500689C0.276869 0.307633 0.413877 0 0.673609 0H13.3264C13.5861 0 13.7231 0.307633 13.5494 0.50069L7.22299 7.53001C7.10382 7.66243 6.89618 7.66243 6.77701 7.53001Z" fill="black" />
                                    </svg></span>
                                <span class="faq-item-close"><svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.77701 0.247331L0.450621 7.27665C0.276869 7.46971 0.413877 7.77734 0.673609 7.77734H13.3264C13.5861 7.77734 13.7231 7.46971 13.5494 7.27665L7.22299 0.247331C7.10382 0.114917 6.89618 0.114917 6.77701 0.247331Z" fill="black" />
                                    </svg></span>
                            </div>
                            <div class="faq-item-content">
                                <p>Наш сервис принимает такие методы оплаты как QIWI , Tinkoff(Они могут быть пополнены с другими банками при помощи
                                    СБП) и криптовалюту: Bitcoin , Ethereum , Litecoin , Dogecoin , Monero , USDt TRC20 ,
                                    USDt ERC20</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-item-title">
                                <p>Какая минимальная и максимальная сумма?</p>
                                <span class="faq-item-open"><svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.77701 7.53001L0.450621 0.500689C0.276869 0.307633 0.413877 0 0.673609 0H13.3264C13.5861 0 13.7231 0.307633 13.5494 0.50069L7.22299 7.53001C7.10382 7.66243 6.89618 7.66243 6.77701 7.53001Z" fill="black" />
                                    </svg></span>
                                <span class="faq-item-close"><svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.77701 0.247331L0.450621 7.27665C0.276869 7.46971 0.413877 7.77734 0.673609 7.77734H13.3264C13.5861 7.77734 13.7231 7.46971 13.5494 7.27665L7.22299 0.247331C7.10382 0.114917 6.89618 0.114917 6.77701 0.247331Z" fill="black" />
                                    </svg></span>
                            </div>
                            <div class="faq-item-content">
                                <p> Минимальный размер – 50 ¥ <br>
                                    Максимальный размер – 10.000 ¥ за одну транзакцию</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-item-title">
                                <p>Существуют ли риски? Это безопасно? Я должен давать доступ к аккаунту?</p>
                                <span class="faq-item-open"><svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.77701 7.53001L0.450621 0.500689C0.276869 0.307633 0.413877 0 0.673609 0H13.3264C13.5861 0 13.7231 0.307633 13.5494 0.50069L7.22299 7.53001C7.10382 7.66243 6.89618 7.66243 6.77701 7.53001Z" fill="black" />
                                    </svg></span>
                                <span class="faq-item-close"><svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.77701 0.247331L0.450621 7.27665C0.276869 7.46971 0.413877 7.77734 0.673609 7.77734H13.3264C13.5861 7.77734 13.7231 7.46971 13.5494 7.27665L7.22299 0.247331C7.10382 0.114917 6.89618 0.114917 6.77701 0.247331Z" fill="black" />
                                    </svg></span>
                            </div>
                            <div class="faq-item-content">
                                <div>Рисков - нет, поэтому мы работает полностью прозрачно и доступ к аккаунту нам не нужен и ничего выставлять на площадке не надо.</h1> Пополнение будет происходить только по QR-коду через китайский банк, поэтому все безопастно и чисто.<br>
                                </div>
                            </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-item-title">
                                    <p>Сколько занимает процесс обмена ₽ на ¥?</p>
                                    <span class="faq-item-open"><svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.77701 7.53001L0.450621 0.500689C0.276869 0.307633 0.413877 0 0.673609 0H13.3264C13.5861 0 13.7231 0.307633 13.5494 0.50069L7.22299 7.53001C7.10382 7.66243 6.89618 7.66243 6.77701 7.53001Z" fill="black" />
                                        </svg></span>
                                    <span class="faq-item-close"><svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.77701 0.247331L0.450621 7.27665C0.276869 7.46971 0.413877 7.77734 0.673609 7.77734H13.3264C13.5861 7.77734 13.7231 7.46971 13.5494 7.27665L7.22299 0.247331C7.10382 0.114917 6.89618 0.114917 6.77701 0.247331Z" fill="black" />
                                        </svg></span>
                                </div>
                                <div class="faq-item-content">
                                    <div>С момента вашей оплаты перевод денег на Buff будет занимать не больше нескольких минут.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contacts" id="contacts">
                <div class="container">
                    <div class="contacts-block">
                        <div class="steps-image wow fadeInLeft"><img src="images/contacts.webp" loading="lazy" alt="контакты"></div>
                        <div class="contacts-content wow fadeInRight">
                            <div class="contacts-title">Контакты</div>
                            <div class="contacts-item">
                                <div class="contacts-item-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
                                        <g id="surface152986378">
                                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(31.37255%,40.784314%,83.137256%);fill-opacity:1;" d="M 15 3 C 8.371094 3 3 8.371094 3 15 C 3 21.628906 8.371094 27 15 27 C 21.628906 27 27 21.628906 27 15 C 27 8.371094 21.628906 3 15 3 Z M 21.359375 18.96875 L 19.492188 18.992188 C 19.492188 18.992188 19.089844 19.070312 18.5625 18.707031 C 17.863281 18.226562 17.203125 16.980469 16.691406 17.140625 C 16.171875 17.308594 16.1875 18.429688 16.1875 18.429688 C 16.1875 18.429688 16.191406 18.628906 16.070312 18.757812 C 15.941406 18.898438 15.6875 18.882812 15.6875 18.882812 L 14.851562 18.882812 C 14.851562 18.882812 13.007812 19.035156 11.378906 17.339844 C 9.605469 15.492188 8.039062 11.84375 8.039062 11.84375 C 8.039062 11.84375 7.949219 11.613281 8.046875 11.492188 C 8.15625 11.363281 8.457031 11.359375 8.457031 11.359375 L 10.457031 11.351562 C 10.457031 11.351562 10.644531 11.382812 10.78125 11.484375 C 10.890625 11.566406 10.953125 11.71875 10.953125 11.71875 C 10.953125 11.71875 11.277344 12.539062 11.707031 13.28125 C 12.542969 14.726562 12.929688 15.042969 13.214844 14.886719 C 13.628906 14.660156 13.503906 12.84375 13.503906 12.84375 C 13.503906 12.84375 13.511719 12.183594 13.296875 11.890625 C 13.128906 11.660156 12.8125 11.59375 12.675781 11.574219 C 12.5625 11.5625 12.746094 11.300781 12.984375 11.179688 C 13.347656 11.003906 13.980469 10.996094 14.734375 11.003906 C 15.316406 11.007812 15.488281 11.042969 15.714844 11.101562 C 16.40625 11.265625 16.171875 11.910156 16.171875 13.457031 C 16.171875 13.949219 16.082031 14.648438 16.4375 14.875 C 16.59375 14.976562 16.96875 14.890625 17.902344 13.296875 C 18.347656 12.539062 18.679688 11.652344 18.679688 11.652344 C 18.679688 11.652344 18.753906 11.496094 18.867188 11.425781 C 18.980469 11.355469 19.136719 11.378906 19.136719 11.378906 L 21.242188 11.367188 C 21.242188 11.367188 21.875 11.289062 21.976562 11.578125 C 22.085938 11.878906 21.742188 12.578125 20.882812 13.726562 C 19.46875 15.609375 19.3125 15.433594 20.484375 16.523438 C 21.605469 17.566406 21.835938 18.070312 21.875 18.136719 C 22.339844 18.90625 21.359375 18.96875 21.359375 18.96875 Z M 21.359375 18.96875 " />
                                        </g>
                                    </svg>
                                </div>
                                <div class="contacts-item-text"><a href="https://vk.com/scrooge_china" rel="nofollow" target="_blank">Скрудж</a></div>
                            </div>
                            <div class="contacts-item">
                                <div class="contacts-item-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" width="32px" height="32px">
                                        <g id="surface152981514">
                                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(31.37255%,40.784314%,83.137256%);fill-opacity:1;" d="M 26.070312 3.996094 C 25.734375 4.011719 25.417969 4.109375 25.136719 4.21875 L 25.132812 4.21875 C 24.847656 4.332031 23.492188 4.902344 21.433594 5.765625 C 19.375 6.632812 16.703125 7.757812 14.050781 8.875 C 8.753906 11.105469 3.546875 13.300781 3.546875 13.300781 L 3.609375 13.277344 C 3.609375 13.277344 3.25 13.394531 2.875 13.652344 C 2.683594 13.777344 2.472656 13.949219 2.289062 14.21875 C 2.105469 14.488281 1.957031 14.902344 2.011719 15.328125 C 2.101562 16.050781 2.570312 16.484375 2.90625 16.722656 C 3.246094 16.964844 3.570312 17.078125 3.570312 17.078125 L 3.578125 17.078125 L 8.460938 18.722656 C 8.679688 19.425781 9.949219 23.597656 10.253906 24.558594 C 10.433594 25.132812 10.609375 25.492188 10.828125 25.765625 C 10.933594 25.90625 11.058594 26.023438 11.207031 26.117188 C 11.265625 26.152344 11.328125 26.179688 11.390625 26.203125 C 11.410156 26.214844 11.429688 26.21875 11.453125 26.222656 L 11.402344 26.210938 C 11.417969 26.214844 11.429688 26.226562 11.441406 26.230469 C 11.480469 26.242188 11.507812 26.246094 11.558594 26.253906 C 12.332031 26.488281 12.953125 26.007812 12.953125 26.007812 L 12.988281 25.980469 L 15.871094 23.355469 L 20.703125 27.0625 L 20.8125 27.109375 C 21.820312 27.550781 22.839844 27.304688 23.378906 26.871094 C 23.921875 26.433594 24.132812 25.875 24.132812 25.875 L 24.167969 25.785156 L 27.902344 6.65625 C 28.007812 6.183594 28.035156 5.742188 27.917969 5.3125 C 27.800781 4.882812 27.5 4.480469 27.136719 4.265625 C 26.769531 4.046875 26.40625 3.980469 26.070312 3.996094 Z M 25.96875 6.046875 C 25.964844 6.109375 25.976562 6.101562 25.949219 6.222656 L 25.949219 6.234375 L 22.25 25.164062 C 22.234375 25.191406 22.207031 25.25 22.132812 25.308594 C 22.054688 25.371094 21.992188 25.410156 21.667969 25.28125 L 15.757812 20.75 L 12.1875 24.003906 L 12.9375 19.214844 C 12.9375 19.214844 22.195312 10.585938 22.59375 10.214844 C 22.992188 9.84375 22.859375 9.765625 22.859375 9.765625 C 22.886719 9.3125 22.257812 9.632812 22.257812 9.632812 L 10.082031 17.175781 L 10.078125 17.15625 L 4.242188 15.191406 L 4.242188 15.1875 C 4.238281 15.1875 4.230469 15.183594 4.226562 15.183594 C 4.230469 15.183594 4.257812 15.171875 4.257812 15.171875 L 4.289062 15.15625 L 4.320312 15.144531 C 4.320312 15.144531 9.53125 12.949219 14.828125 10.71875 C 17.480469 9.601562 20.152344 8.476562 22.207031 7.609375 C 24.261719 6.746094 25.78125 6.113281 25.867188 6.078125 C 25.949219 6.046875 25.910156 6.046875 25.96875 6.046875 Z M 25.96875 6.046875 " />
                                        </g>
                                    </svg></div>
                                <div class="contacts-item-text"><a href="https://t.me/scrooge_china" rel="nofollow" target="_blank">@scrooge_china</a></div>
                            </div>
                            <div class="contacts-item">
                                <div class="contacts-item-icon">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.3636 2.90907C3.56693 2.90907 2.90907 3.56693 2.90907 4.3636V21.818C2.90907 22.6147 3.56693 23.2725 4.3636 23.2725H27.6361C28.4328 23.2725 29.0907 22.6147 29.0907 21.818V4.3636C29.0907 3.56693 28.4328 2.90907 27.6361 2.90907H4.3636ZM0 4.3636C0 1.9603 1.9603 0 4.3636 0H27.6361C30.0395 0 31.9997 1.9603 31.9997 4.3636V21.818C31.9997 24.2213 30.0395 26.1816 27.6361 26.1816H4.3636C1.9603 26.1816 0 24.2213 0 21.818V4.3636Z" fill="#5068D4" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.263058 3.52972C0.72373 2.87162 1.63068 2.71157 2.28878 3.17224L16 12.7701L29.7112 3.17224C30.3693 2.71157 31.2763 2.87162 31.7369 3.52972C32.1976 4.18782 32.0376 5.09477 31.3795 5.55544L16.8341 15.7372C16.3333 16.0878 15.6667 16.0878 15.1659 15.7372L0.620538 5.55544C-0.0375645 5.09477 -0.197614 4.18782 0.263058 3.52972Z" fill="#5068D4" />
                                    </svg>
                                </div>
                                <div class="contacts-item-text"><a href="mailto:support@scrooge-china.com" target="_blank">support@scrooge-china.com</a><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
        <div class="container">
        <div class="footer-blocks">
            <div class="footer-block">
                <div class="footer-title">Контакты</div>
                <p>Telegram: <a href="https://t.me/mcduck12">@mcduck12</a></p>
                <p>E-mail: <a href="mailto:support@scrooge-china.com" class="font-fix">support@scrooge-china.com</a></p>

            </div>
            <div class="footer-nav">
                <div class="footer-title">О нашей работе
                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.77701 5.30779L0.450621 0.500689C0.276869 0.307633 0.413877 0 0.673609 0H9.32639C9.58612 0 9.72313 0.307633 9.54938 0.50069L5.22299 5.30779C5.10382 5.4402 4.89618 5.4402 4.77701 5.30779Z"
                              fill="white"/>
                    </svg>
                </div>
                <ul>
                    <li><a href="#how" class="smoothScroll">Как мы работаем?</a></li>
                    <li><a href="#steps" class="smoothScroll">Как пополнить Buff.163?</a></li>
                    <li><a href="#calc" class="smoothScroll">Калькулятор пополнения</a></li>
                    <li><a href="#features" class="smoothScroll">Преимущества работы с нами</a></li>
                </ul>
            </div>
            <div class="footer-nav">
                        <div class="footer-title">Помощь
                            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.77701 5.30779L0.450621 0.500689C0.276869 0.307633 0.413877 0 0.673609 0H9.32639C9.58612 0 9.72313 0.307633 9.54938 0.50069L5.22299 5.30779C5.10382 5.4402 4.89618 5.4402 4.77701 5.30779Z" fill="white" />
                            </svg>
                        </div>
                        <ul>
                            <li><a href="#calc" class="smoothScroll">Рассчитать</a></li>
                            <li><a href="reviews.php">Отзывы</a></li>
                            <li><a href="#faqq">FAQ</a></li>
                            <li><a href="#contacts" class="smoothScroll">Контакты</a></li>
                        </ul>
                    </div>
                    <div class="footer-nav">
                        <div class="footer-title">Дополнительно
                            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.77701 5.30779L0.450621 0.500689C0.276869 0.307633 0.413877 0 0.673609 0H9.32639C9.58612 0 9.72313 0.307633 9.54938 0.50069L5.22299 5.30779C5.10382 5.4402 4.89618 5.4402 4.77701 5.30779Z" fill="white" />
                            </svg>
                        </div>
                        <ul>
                            <li><a href="/logout.php">Выйти из аккаунта</a></li>
                        </ul>
                    </div>


        </div>
            </div>
        </footer>


        <a href="#main" class="totop smoothScroll">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 1C8.55228 1 9 1.44772 9 2V15C9 15.5523 8.55228 16 8 16C7.44772 16 7 15.5523 7 15V2C7 1.44772 7.44772 1 8 1Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29289 0.292893C7.68342 -0.0976311 8.31658 -0.0976311 8.70711 0.292893L15.7071 7.29289C16.0976 7.68342 16.0976 8.31658 15.7071 8.70711C15.3166 9.09763 14.6834 9.09763 14.2929 8.70711L8 2.41421L1.70711 8.70711C1.31658 9.09763 0.683417 9.09763 0.292893 8.70711C-0.0976311 8.31658 -0.0976311 7.68342 0.292893 7.29289L7.29289 0.292893Z" fill="white" />
            </svg>
            <p>Вверх</p>
        </a>

    <script defer type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>
    <div id="vk_community_messages"></div>
    <script type="text/javascript">
        VK.Widgets.CommunityMessages("vk_community_messages", 174222932, {tooltipButtonText: "Есть вопрос?", expanded: 1});
    </script>

        <script src="js/jquery.min.js"></script>
        <script src="js/maskinput.js"></script>
        <script src="js/slick.min.js"></script>
        <script defer src="js/jquery.fancybox.js"></script>
        <script src="js/jquery.spincrement.min.js"></script>
        <script src="js/nouislider.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/scripts.js"></script>
        <script type="text/javascript" src="js/calculator.js"></script>
        <script src="js/index.js"></script>
</body>

</html>