<?php
    require_once('bd.php');
//    if (isset($_POST['do_registration']))
//        header('Location: /index.php');
    $data = $_POST;
    $flag = false;
    if (isset($data['do_registration'])) {
        $errors = array();
        if (R::count("users", "login = ? ", array($data['login'])) > 0) {
            $flag = true;
        }
    }
    if (empty($errors) && ! empty($data)) {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
    //                            $user->privelegies = $data['privelegies']; задаётся вручную через бд!!!
        R::store($user);

    //                            $chat = R::dispense('chat');
    //                            $id = R::findOne('users', 'login = ?', array($data['login']));
    //                            $chat->user_id = $id->id;
    //                            R::store($chat);
    }
    if (empty($errors)) {
        if (isset($data['do_registration'])) {
            $errors = array();
            $user = R::findOne('users', 'login = ?', array($data['login']));
            if ($user) {

                if (password_verify($data['password'], $user->password)) {

                    $_SESSION['logged_user'] = $user;
                    header('location:index.php');
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, shrink-to-fit=no">
    <title>Scrooge China | Регистрация на сайте</title>
    <meta name="keywords" content="">
    <meta name="description"
          content="Scrooge China - Это сервис который поможем вам пополнить свой аккаунт Buff.163 в считанные секунды, по самому выгодному курс и без потерь. Публичность заключается в полной прозрачности, предсказуемости и автоматизированности работы.">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel=" canonical" href=”https://betterattack.github.io”>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/plugins.css" rel="stylesheet" type="text/css">
    <link href="css/form-2.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="css/switches.css">
    <link href="css/infobox.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/all.css" crossorigin="anonymous">
</head>

<body class="form">

<div class="form-container outer auth-page">
    <a href="/" class="logo"><img src="fonts/logo-white.svg" alt="logo" aria-label="логотип"></a>
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class>Регистрация</h1>
                    <form action="/registration.php" method="POST" class="text-left">
                        <br>
                        <?php
                        if ($flag)
                            print $errors[] = '<div class="alert alert-warning mb-1" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">  <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <svg style="vertical-align: bottom;margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg> <strong>Этот логин занят<br> </strong> </div>';

                        ?>
                        <div class="form">
                            <div id="username-field" class="field-wrapper input">
                                <label for="username">LOGIN</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                                <input minlength="4" name="login" id="u_login" type="login" class="form-control"
                                       required placeholder="Ваш логин" value="<? echo @$data['login']; ?>">
                            </div>

                            <div id="password-field" class="field-wrapper input">
                                <div class="d-flex justify-content-between">
                                    <label for="password">ПАРОЛЬ</label>

                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-lock">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                                <input minlength="6" name="password" id="password" type="password" class="form-control"
                                       required placeholder="Ваш пароль" value="<? echo @$data['password']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </div>
                            <p class="signup-link register">Уже есть аккаунт? <a href="/login.php">Авторизироваться</a>
                            </p>
                            <input name="cnv_id" id="cnv_id" type="hidden" value>
                            <div class="field-wrapper terms_condition" style="margin-bottom: 0;">

                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" name="do_registration" class="btn btn-success" value
                                            data-brk-library="component__button"><i
                                                class="fa fa-check icon-inside icon-inline"></i>
                                        <a style="color: #fff !important">ЗАРЕГИСТРИРОВАТЬСЯ</a>
                                    </button>
                                </div>
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