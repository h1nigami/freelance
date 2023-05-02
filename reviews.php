<?php
    require_once('bd.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-rim-auto-match" content="none">
    <meta name="viewport" content="user-scalable=yes, width=device-width">
    <meta name="yandex-verification" content="644b2fe5149b7509">
    <title>Scrooge China: Отзывы</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="images/favicon.png">
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
    <link rel="stylesheet" href="css/hyper.css">
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
                                <?php if (isset($_SESSION['logged_user'])) :
                                    $id = $_SESSION['logged_user']['id'];
                                    $user_priv = $_SESSION['logged_user']['privelegies'];
                                    $user = R::findOne('users', 'id = ?', [$id]);
                                    $user = $user_priv !== '1' ? $user->chat : '1';
                                    ?>
                                    <a <?=$user !== '0' ? "href='../chat.php'" : 'onclick="transaction()"'?> data-toggle="modal" class="btn btn-login">
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
                            </div>
                            <ul class="menu-items">
                                <li class="ico-home"><a href="/index.php" class="ico-home">Главная</a></li>
                                <li class="nav-open"><a href="/index.php#how" class="ico-flag nav-open-fix">О нашей работе</a>
                                    <ul>
                                        <li><a href="/index.php#how" class="smoothScroll">Как мы работаем?</a></li>
                                        <li><a href="/index.php#steps" class="smoothScroll">Как пополнить Buff.163?</a></li>
                                        <li><a href="/index.php#calc">Калькулятор
                                                пополнения</a></li>
                                        <li><a href="/index.php#features" class="smoothScroll">Преимущества работы с нами</a></li>
                                    </ul>
                                </li>

                                <li><a href="/reviews.php" class="ico-testimonials">Отзывы</a></li>
                                <li><a href="/index.php#faq" class="ico-faq">FAQ</a></li>
                                <li><a href="/index.php#contacts" class="ico-contacts smoothScroll">Контакты</a></li>
                                <?php if (isset($_SESSION['logged_user'])) : ?>
                                <li><a href="/index.php#calc">Пополнить Buff</a></li>
                                <?php else : ?>
                                    <li><a href="/login.php">Пополнить Buff</a></li>
                                    <?php endif;?>

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
                                    <a <?=$user !== '0' ? "href='../chat.php'" : 'onclick="transaction()"'?> data-toggle="modal" data-target="#settingmodal">
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
                                <li><a href="/index.php#faq" class="ico-faq">FAQ</a></li>
                                <li><a href="/index.php#contacts" class="ico-contacts smoothScroll">Контакты</a></li>
                                <?php if (isset($_SESSION['logged_user'])) : ?>
                                <li><a href="/index.php#calc">Пополнить Buff</a></li>
                                <?php else : ?>
                                    <li><a href="/login.php">Пополнить Buff</a></li>
                                    <?php endif;?>

                            </ul>
                        </nav>
                        <button class="btn btn-login">
                        <?php if (isset($_SESSION['logged_user'])) : ?>
                                    <a <?=$user !== '0' ? "href='../chat.php'" : 'onclick="transaction()"'?> data-toggle="modal" data-target="#settingmodal">
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
        <div class="inner-block">
            <div class="container">
                <div class="inner-blocks">
                    <div class="inner-left">
                        <div class="content">
                            <h1>Отзывы пользователей</h1>
                            <div class="content-date">Воспользовались нашим сервисом? Оставьте свой отзыв</div>
<div id="anycomment-app"></div>
<script>
AnyComment = window.AnyComment || []; AnyComment.Comments = [];
AnyComment.Comments.push({
    "root": "anycomment-app",
    "app_id": 4761,
    "language": "ru"
})
var s = document.createElement("script"); s.type = "text/javascript"; s.async = true;
s.src = "https://widget.anycomment.io/comment/embed.js";
var sa = document.getElementsByTagName("script")[0];
sa.parentNode.insertBefore(s, s.nextSibling);
</script>
                            <div class="action-buttons">

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
                            <path d="M4.77701 5.30779L0.450621 0.500689C0.276869 0.307633 0.413877 0 0.673609 0H9.32639C9.58612 0 9.72313 0.307633 9.54938 0.50069L5.22299 5.30779C5.10382 5.4402 4.89618 5.4402 4.77701 5.30779Z" fill="white" />
                        </svg>
                    </div>
                    <ul>
                        <li><a href="/index.php#how" class="smoothScroll">Как мы работаем?</a></li>
                        <li><a href="/index.php#steps" class="smoothScroll">Как пополнить Buff.163?</a></li>
                        <li><a href="/index.php#calc" class="smoothScroll">Калькулятор пополнения</a></li>
                        <li><a href="/index.php#features" class="smoothScroll">Преимущества работы с нами</a></li>
                    </ul>
                </div>
                <div class="footer-nav">
                        <div class="footer-title">Помощь
                            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.77701 5.30779L0.450621 0.500689C0.276869 0.307633 0.413877 0 0.673609 0H9.32639C9.58612 0 9.72313 0.307633 9.54938 0.50069L5.22299 5.30779C5.10382 5.4402 4.89618 5.4402 4.77701 5.30779Z" fill="white" />
                            </svg>
                        </div>
                        <ul>
                            <li><a href="/index.php#calc" class="smoothScroll">Рассчитать</a></li>
                            <li><a href="reviews.php">Отзывы</a></li>
                            <li><a href="/index.php#faqq">FAQ</a></li>
                            <li><a href="/index.php#contacts" class="smoothScroll">Контакты</a></li>
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
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/maskinput.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/jquery.spincrement.min.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/index.js"></script>








    <noscript>
        <div><img src="https://mc.yandex.ru/watch/64370971" style="position:absolute; left:-9999px;" alt></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->


    <script id="dsq-count-scr" src="//ice-14.disqus.com/count.js" async></script>

</body>

</html>