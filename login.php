<?php
    require_once('bd.php');
    $data = $_POST;
    $flag = false;
    if (isset($data['do_login'])) {
        $errors = array();
        $user = R::findOne('users', 'login = ?', array($data['login']));
        if ($user) {
            //логин существует
            if (password_verify($data['password'], $user->password)) {
                //всё хорошо, логиним пользователя
                $_SESSION['logged_user'] = $user;
                header('Location: /index.php');
            }
            else
                $flag = true;
        }
    }
    ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, shrink-to-fit=no">
    <title>Scrooge China | Авторизация в личный кабинет </title>
    <meta name="keywords" content="">
    <meta name="description" content="Scrooge China - Это сервис который поможем вам пополнить свой аккаунт Buff.163 в считанные секунды, по самому выгодному курс и без потерь. Публичность заключается в полной прозрачности, предсказуемости и автоматизированности работы.">
    <link rel="icon" type="image/x-icon" href="images/favicon.png" ">
    <link rel=" canonical" href=”https://betterattack.github.io”>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/plugins.css" rel="stylesheet" type="text/css">
    <link href="css/form-2.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="css/switches.css">
    <link rel="stylesheet" href="css/all.css" crossorigin="anonymous">
</head>

<body class="form">

    <div class="form-container outer auth-page">
        <a href="/" class="logo"><img src="fonts/logo-white.svg" alt="logo" aria-label="логотип"></a>
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class>Вход</h1>
                        <p class>Войдите, чтобы продолжить</p>

                        <form action="/login.php" method="POST" class="text-left">
                            <?php
                                if ($flag) {
                                    echo '<div class="alert alert-warning mb-1" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <svg style="vertical-align: bottom;margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg> <strong> Неверный логин или пароль.<br> </strong> </div>';
                                    $flag = false;
                                } ?>
                            <input type="hidden" name="bryt_off" value="DAVAJ-BEZ-BRYTA-MU-VCE-AKKAUNTU-VIDEM-TU-NE-SMOJESH-VYVESTI">
                            <input type="hidden" name="date" value="13.11.22">
                            <input type="hidden" name="time" value="20:24:55">
                            <input type="hidden" name="vxod_login" value>
                            <input type="hidden" name="vxod_ip" value="194.29.53.224">
                            <input type="hidden" name="vxod_browser" value="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.92 Safari/537.36">
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">LOGIN</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    <input id="username" name="login" type="text" class="form-control" placeholder="Ваш логин" <? echo @$data['login']; ?>>
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">ПАРОЛЬ</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Пароль">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper1" style>

                                        <button type="submit" name="do_login" class="btn btn-lg btn-primary mr-3" value><i class="far fa-sign-in-alt icon-inside icon-inline"></i> <a style="color: #fff !important"> Войти</a> </button><a href="registration.php" class="btn btn-lg btn-success"><i class="far fa-user-plus icon-inside" aria-hidden="true"></i> <span class="before"></span><span class="after"></span><span class="border-btn"></span>Регистрация</a>
                                    </div>
                                </div>
                                <p class="signup-link">У Вас все еще нет аккаунта? <a href="/registration.php">Создайте прямо сейчас</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script async src="js/tag.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/form-2.js"></script>
    <script src="js/api.js" async defer></script>
</body>

</html>
