<?php
require_once('bd.php');
if (! isset($_SESSION['logged_user'])) {
    echo 'Доступ запрещён!';
    return;
}
//else {
//    $id = $_SESSION['logged_user']['id'];
//    $user_priv = $_SESSION['logged_user']['privelegies'];
//    $user = R::findOne('users', 'id = ?', [$id]);
//    if (($user_priv === '0' && isset($_SESSION['go']) && !$_SESSION['go']) || $user->chat !== '0') {
//        echo 'У вас нет транзакций! Пополните счёт';
//        return;
//    }
//}
?>
<!DOCTYPE html>
<div class="main-chat-container" lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>
    <title>Scrooge China | Чат</title>
    <meta name="keywords" content="">
    <meta name="description"
          content="Scrooge China - Это сервис который поможем вам пополнить свой аккаунт Buff.163 в считанные секунды, по самому выгодному курс и без потерь. Публичность заключается в полной прозрачности, предсказуемости и автоматизированности работы.">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="images/favicon.png">
    <link href="css/chat.css" rel="stylesheet" type="text/css">
    <script defer src="js/chat.js"></script>
</head>
<div>
<?php
    $user_id = $_SESSION['logged_user']['id'];
    $user_priv = $_SESSION['logged_user']['privelegies'];
    $user_login = $_SESSION['logged_user']['login'];
    $user = R::findOne('users', 'id = ?', [$user_id]);
    $num = $user->chat;
    $block = $user->block;
    $pay_status = (int) $user->pay_status;
    $admins_pre = R::findAll('users', 'privelegies = ?', ['1']);
    $admins = [];
    foreach ($admins_pre as $admin)
        array_push($admins, $admin->id);
    if ($user_priv == 1) { ?>
        <div class="container-pay" id="transaction_status_container-pay">
            <div class="not_paid_window frame-browser">
                <div style="display: flex; justify-content: center;" class="frame-browser-image">
                    <a href="index.php" class="logo" aria-label="На главную"><img src="fonts/logo.svg"
                                                                                  style="width: 218px; margin-bottom: 20px" alt="scroogechina"></a>
                </div>
                <div style="display: flex; justify-content: center;" class="ice">
                    <button id="kurs">Изменить курс</button>
                </div>
                <form id="kurs_form" style="display: none; flex-direction: column">
                    <label>
                        Введите курс: <input id="myInput" oninput="myFunction()" name="kurs" placeholder="10"
                                             value="10">
                    </label>
                    <button type="submit">Применить</button>
                </form>
                <div style="display: flex; justify-content: center;" class="details">
                    <button id="dbut">Изменить реквизиты</button>
                </div>
                <form id="details" style="display: none; flex-direction: column">
                    <h3>Сбербанк</h3>
                    <label>
                        Номер карты: <input name="dcard_sber" type="number" placeholder="1234567890123456">
                    </label>
                    <label>
                        Имя Фамилия: <input name="dname_sber" placeholder="Вася Пупкин">
                    </label>

                    <h3>Тинькофф</h3>
                    <label>
                        Номер карты: <input name="dcard_tinkoff" type="number" placeholder="1234567890123456">
                    </label>
                    <label>
                        Имя Фамилия: <input name="dname_tinkoff" placeholder="Вася Пупкин">
                    </label>

                    <h3>QIWI</h3>
                    <label>
                        Ник: <input name="qiwi" placeholder="NICK">
                    </label>

                    <h3>BTC</h3>
                    <label>
                        Адрес кошелька: <input name="btc" placeholder="3F1tAaz5x1HUXrCNLbtMDqcw6o12Nn4xqX">
                    </label>

                    <h3>ETH</h3>
                    <label>
                        Адрес кошелька: <input name="eth" placeholder="0x89205A3A3b2A69De6Dbf7f01ED13B2108B2c43e7">
                    </label>

                    <h3>USD-T</h3>
                    <label>
                        Адрес кошелька: <input name="usdt" placeholder="0x89205A3A3b2A69De6Dbf7f01ED13B2108B2c43e7">
                    </label>

                    <button type="submit">Применить</button>
                </form>
            </div>
        </div> <?php } ?>
<div <?=$user_priv == 1 ? 'style="display: none" ' : ''?>class="container-pay" id="transaction_status_container-pay">
    <div class="not_paid_window frame-browser">
        <?php
        if ($user_priv == 1) {
            $waiters = R::findAll('users', 'wait = ?', [1]);
            if (!empty($waiters)) { ?>
                <?php
                foreach ($waiters as $wait) {
                    $log = R::findOne('log', 'chat = ?', [$wait->chat]);
                    if ($log === null)
                        continue;
                    ?>
                    <div chat="<?= $wait->chat ?>" id="client_<?= $wait->id ?>" class="client <?= $wait->id ?>">
                        <button class="wait <?= $wait->id ?>"><?= $wait->login ?></button>
                        <div id="wid_client_form_<?= $wait->id ?>" style="display: none;">
                            <div id="client_form_<?= $wait->id ?>">
                                <?php
                                $messages = R::findAll('chat', 'to_user = ? AND from_user = ? OR to_user = ? AND from_user = ?', [(string)$wait->id, '0', '0', (string)$wait->id]);
                                $end_message = 0;
                                $login_user = R::findOne('users', 'id = ?', [$wait->id])->login;
                                if (!empty($messages))
                                    foreach ($messages as $message) {
                                        ?>
                                        <div data="<?= $message->id ?>"
                                             class="containerchat<?= $message->from_user == $user_id || $message->from_user == '0' && in_array($user_id, $admins) ? ' darker' : '' ?>">
                                            <h4><?= $message->from_user == '0' ? 'Admin' : $login_user ?></h4>
                                            <?php
                                            $img = $message->photo;
                                            $mes = $message->message;
                                            if ($img != 'data:') { ?>
                                                <img alt="" style="object-fit: contain; width: 300px" src=<?= $img ?>>
                                            <?php }
                                            if (strlen($mes) !== 0) { ?>
                                                <p><?= $message->message ?></p> <?php } ?>
                                            <span class="time-right"><?= join(':', array_slice(explode(':', $message->time), 0, 2)) ?></span>
                                        </div> <?php $end_message = $message->id;
                                    }
                                $_SESSION['end_message'] = $end_message; ?>
                            </div>
                            <form id="form_<?= $wait->id ?>" enctype="multipart/form-data" action="answer.php"
                                  method="post">
                                <input id="message-input_<?= $wait->id ?>" name="message-input" type="text" size="100"
                                       placeholder="Написать сообщение..."><br>
                                <label style="width: 115px" class="photo_input" for="photo_<?= $wait->id ?>"><p style="font-size: 10px; text-align: center">Загрузить QR-code</p></label>
                                <input type="submit" id="btn-submit_<?= $wait->id ?>">
                                <input class="photo_input_i" id='photo_<?= $wait->id ?>' type="file" name="photo"
                                       accept="image/*,image/jpeg">
                            </form>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
            </div>
            <?php foreach ($waiters as $wait) {
                $log = R::findOne('log', 'chat = ?', [$wait->chat]);
                if ($log === null)
                    continue;
                ?>
                    <button id='end_<?= $wait->id ?>' class="btn" style="display: none;">
                        Завершить сделку
                    </button>
            <?php }
            } else { ?>
    <h3 id="no_message" style="text-align: center">Нет сообщений!</h3> </div> </div>
            <?php } ?>
            <?php
            $logs = R::getAll('SELECT chat, login, date, sum_get, method FROM log');
            ?>
        <table id="table" class="simple-little-table">
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>Дата</th>
                <th>Сумма</th>
                <th>Метод</th>
            </tr>
            <?php
            foreach ($logs as $l) { ?>
                <tr id='tr_<?=$l['chat']?>'>
                    <td><?=$l['chat']?></td>
                    <td><?=$l['login']?></td>
                    <td><?=$l['date']?></td>
                    <td><?=$l['sum_get']?></td>
                    <td><?=$l['method']?></td>
                    <td><button class="more" chat="<?=$l['chat']?>">Подробнее</button></td>
                </tr>
            <?php } ?>

        </table> <?php
        }
        else { ?>
        <div class="frame-browser-image">
            <a href="index.php" class="logo" aria-label="На главную" style="display: flex; justify-content: center"><img
                        src="fonts/logo.svg" style="width: 218px; margin-bottom: 20px" alt="scroogechina"></a>
            <?php
                $log = R::findOne('log', 'login = ?', [$user_login]);
            if (! $pay_status && $log === null) {
                $num = $_SESSION['num'];
                $sum = $_SESSION['sum'];
                $sum_get = $_SESSION['sum_get'];
                $pay = $_SESSION['method'];
                $date = $_SESSION['date'];
                $login = $_SESSION['login'];
                $kurs = $_SESSION['cur_kurs'];
                $timer = '60:00';
            ?>
            <div class="frame-browser-image_body">
                <p class="status_header">

                    Заявка <span class="transaction_status_number">#<?= $num ?></span> на оплату QR кода успешно создана
                    и ожидает оплаты!
                </p>
                <div class="transaction_status_separator mt-30">
                    <div></div>
                </div>
                <p class="status-text">
                    Ниже расположена таблица с подробной информацией о заявке, для оплаты введите номер карты с которой
                    перевели деньги и имя владельца карты, после чего нажмите кнопку подтверждения. Заявка
                    незамедлительно поступит на обработку после подтверждения оплаты!
                </p>
                <div class="transaction_status_separator mb-30">
                    <div></div>
                </div>

                <div class="transaction_info_table" id="transaction_info_table"
                     data-exchange-currencies="sberbank::alipay" data-transaction-status="1"
                     data-transaction-expired="false" data-qr-code-request="true">
                    <table class="simple-little-table" cellspacing="0">
                        <tr>
                            <td class="table_method" colspan="2">Подробная информация о заявке</td>
                        </tr>
                        <?php
                        switch ($pay) {
                            case 'Сбербанк': ?>
                                <tr>
                                    <td class="f_row">Метод оплаты</td>
                                    <td class="l_row"><i class="icon-sberbank-1"></i> SBERBANK</td>
                                </tr>
                                <?php break;
                            case 'QIWI': ?>
                                <tr>
                                    <td class="f_row">Метод оплаты</td>
                                    <td class="l_row"><i class="icon-qiwi-1 qiwi"></i> QIWI</td>
                                </tr>
                                <?php break;
                            case 'BTC': ?>
                                <tr>
                                    <td class="f_row">Метод оплаты</td>
                                    <td class="l_row"><i class="icon-btc-1 btc"></i> BTC</td>
                                </tr>
                                <?php break;
                            case 'ETH': ?>
                                <tr>
                                    <td class="f_row">Метод оплаты</td>
                                    <td class="l_row"><img src="images/eth.png" style="width: 15px;" alt="eth"> ETH</td>
                                </tr>
                                <?php break;
                            case 'USDt': ?>
                                <tr>
                                    <td class="f_row">Метод оплаты</td>
                                    <td class="l_row"><img src="images/usdt.png" style="width: 15px;" alt="usdt"> USD-T</td>
                                </tr>
                                <?php break;
                            case 'СБП(Тинькофф)': ?>
                                <tr>
                                    <td class="f_row">Метод оплаты</td>
                                    <td class="l_row"><img src="images/tinkoff.png" style="width: 100px;" alt="tinkoff">
                                    </td>
                                </tr>
                                <?php break;
                        }
                        ?>
                        <tr>
                            <td class="f_row">Платежная система</td>
                            <td class="l_row"><img src="images/buff.png" style="width: 120px;" alt="scroogechina"></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="f_row">Сумма QR кода</td>
                            <td class="l_row" id="transaction_qr_code_amount"><span class><?= $sum ?>¥</span></td>
                        </tr>
                        <tr>
                            <td class="f_row">Сумма к оплате</td>
                            <td class="l_row" id="transaction_payd_amount">
                                <span class><?= $sum_get ?>₽</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="f_row">Курс</td>
                            <td class="l_row" id="transaction_exchange_rate">
                                <span class><?= $kurs ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="f_row">Дата создания</td>
                            <td class="l_row"><?= $date ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="countdown text-center transaction_expire_about">
                    <p>Курс транзакции останется фиксирован в течение <span id="timer"
                                                                            class="transaction_expire_timer"><?= $timer ?></span>
                        минут, после чего потребуется нажать кнопку для повторной фиксации. Не переводите деньги если на
                        таймере меньше минуты.</p>
                </div>

            <?php
                $sber = R::findOne('details', 'pay = ?', ['sber']);
                $tinkoff = R::findOne('details', 'pay = ?', ['tinkoff']);
                $qiwi = R::findOne('details', 'pay = ?', ['qiwi']);
                $btc = R::findOne('details', 'pay = ?', ['btc']);
                $usdt = R::findOne('details', 'pay = ?', ['usdt']);
                $eth = R::findOne('details', 'pay = ?', ['eth']);
                switch ($pay) {
            case 'Сбербанк': ?>
                <div class="panel panel-default payment_panel">
                    <div class="panel-heading">
                        Реквизиты карты для оплаты
                    </div>
                    <div class="panel-body">
                        <div class="bank_logo_wrap">
                            <i class="icon-sberbank-1 sberbank"></i>
                            <p class="payment_card_num actual_pay_data"><?=$sber->val1?></p>
                            <p class="payment_card_name actual_pay_data"><?=$sber->val2?></p>
                        </div>
                    </div>
                </div>
                <?php break;
            case 'QIWI': ?>
                <div class="panel panel-default payment_panel">
                    <div class="panel-heading">
                        Реквизиты карты для оплаты
                    </div>
                    <div class="panel-body">
                        <div class="bank_logo_wrap">
                            <i class="icon-qiwi-1 qiwi"></i>
                            <p class="payment_card_num actual_pay_data"><a href='https://qiwi.com/n/<?=$qiwi->val1?>'
                                                                           target='_blank'> <?=$qiwi->val1?> </a></p>
                            <p class="payment_card_name actual_pay_data">QIWI nickname.</p>
                        </div>
                    </div>
                </div>
                <?php break;
            case 'BTC': ?>
                <div class="panel panel-default payment_panel">
                    <div class="panel-heading">
                        Реквизиты карты для оплаты
                    </div>
                    <div class="panel-body">
                        <div class="bank_logo_wrap">
                            <i class="icon-btc-1 btc"></i>
                            <p class="payment_card_num actual_pay_data"><?=$btc->val1?></p>
                            <p class="payment_card_name actual_pay_data">Сеть BTC.</p>
                        </div>
                    </div>
                </div>
                <?php break;
            case 'ETH': ?>
                <div class="panel panel-default payment_panel">
                    <div class="panel-heading">
                        Реквизиты карты для оплаты
                    </div>
                    <div class="panel-body">
                        <div class="bank_logo_wrap">
                            <img src="images/eth.png" style="width: 118px;" alt="eth">
                            <p class="payment_card_num actual_pay_data"><?=$eth->val1?></p>
                            <p class="payment_card_name actual_pay_data">Сеть ERC20.</p>
                        </div>
                    </div>
                </div>
                <?php break;
                 case 'USDt': ?>
                    <div class="panel panel-default payment_panel">
                        <div class="panel-heading">
                            Реквизиты карты для оплаты
                        </div>
                        <div class="panel-body">
                            <div class="bank_logo_wrap">
                                <img src="images/usdt.png" style="width: 118px;" alt="usdt">
                                <p class="payment_card_num actual_pay_data"><?=$usdt->val1?></p>
                                <p class="payment_card_name actual_pay_data">Сеть USD-T.</p>
                            </div>
                        </div>
                    </div>
                    <?php break;
            case 'СБП(Тинькофф)': ?>
                <div class="panel panel-default payment_panel">
                    <div class="panel-heading">
                        Реквизиты карты для оплаты
                    </div>
                    <div class="panel-body">
                        <div class="bank_logo_wrap">
                            <img src="images/tinkoff.png" style="width: 218px;" alt="tinkoff">
                            <p class="payment_card_num actual_pay_data"><?=$tinkoff->val1?></p>
                            <p class="payment_card_name actual_pay_data"><?=$tinkoff->val2?></p>
                        </div>
                    </div>
                </div>
            <?php break;
            } ?>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#submit_sberbank').addClass('disabled')
                        $('#submit_sberbank').replaceTagName('div')
                        name = false
                        numb = false
                        $('#sberbank_name, #sberbank_num').bind('input', function () {
                            name = $('#sberbank_name').SberNameCheck('Укажите имя с карты в корректном формате <font color="black">IVANOV IVAN</font>')
                            numb = $('#sberbank_num').SberNumCheck('Номер карты должен состоять из <font color="black">13-18</font> цифр')
                            if (name == "true" && numb == true) {
                                $('#submit_sberbank').removeClass('disabled')
                                $('#submit_sberbank').replaceTagName('button')
                            } else {
                                $('#submit_sberbank').addClass('disabled')
                                $('#submit_sberbank').replaceTagName('div')
                            }
                        });
                    });
                </script>
                <!-- БАНКИ --> <!-- БАНКИ --> <!-- БАНКИ --> <!-- БАНКИ -->
            <?php switch ($pay) {
            case 'СБП(Тинькофф)':
            case 'Сбербанк': ?>
                <div class="panel panel-default payment_panel">
                    <div class="panel-heading">
                        Данные банковской карты с которой оплатили заявку
                    </div>
                    <div class="panel-body">
                        <form class="edit_transaction" id="edit_transaction_17118" data-toggle="validator"
                              data-id="change_wmz"
                              enctype="multipart/form-data"
                              accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden"
                                                                                             value="✓"><input
                                    type="hidden" name="authenticity_token"
                                    value="vohqTf7iQJDdMudvdW2BWSYpMAFcD3Ev7ecZuUnOlOaicrRVwV7q4IXr7Lab7dFBvk0t443yne/+pYxMOpEOUQ==">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="c_label">
                                        4 последние цифры карты
                                    </label>
                                    <input required class="span2 c_num value_num" id="<?=$pay?>_num" placeholder="1234" type="text"
                                           name="transaction[account_id]">
                                    <span class="label label-block label-danger hidden block mt-5"></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="c_label">
                                        Имя Ф.
                                    </label>
                                    <input required class="span2 c_num value_name" id="<?=$pay?>_name" placeholder="IVAN I." type="text"
                                           name="transaction[account_name]">
                                    <span class="label label-block label-danger hidden block mt-5"></span>
                                </div>
                            </div>
                            <div class="actions text-center form-group mt-20">
                                <button id='payed' name="button" type="submit"
                                        class="<?=$pay?>_form btn1 btn-success btn-labeled btn-lg" id="submit_sberbank"
                                        data-disable-with="<b><i class=" fa fa-money
                                ">
                                Заявка оплачена с этого аккаунта
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- БАНКИ --> <!-- БАНКИ --> <!-- БАНКИ --> <!-- БАНКИ -->
                <?php break;
            case 'QIWI': ?>
                <div class="panel panel-default payment_panel">
                    <div class="panel-heading">
                        Номер и Комментарий QIWI
                    </div>
                    <div class="panel-body">
                        <form class="edit_transaction" id="edit_transaction_17118" data-toggle="validator"
                              data-id="change_wmz"
                              enctype="multipart/form-data"
                              accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden"
                                                                                             value="✓"><input
                                    type="hidden" name="authenticity_token"
                                    value="vohqTf7iQJDdMudvdW2BWSYpMAFcD3Ev7ecZuUnOlOaicrRVwV7q4IXr7Lab7dFBvk0t443yne/+pYxMOpEOUQ==">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="c_label">
                                        Номер Телефона
                                    </label>
                                    <input required class="span2 c_num value_num" id="<?=$pay?>_num" placeholder="+712312312312" type="text"
                                           name="transaction[account_id]">
                                    <span class="label label-block label-danger hidden block mt-5"></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="c_label">
                                        Комментарий
                                    </label>
                                    <input required class="span2 c_num value_name" id="<?=$pay?>_name" placeholder="" type="text"
                                           name="transaction[account_name]">
                                    <span class="label label-block label-danger hidden block mt-5"></span>
                                </div>
                            </div>
                            <div class="actions text-center form-group mt-20">
                                <button id='payed' name="button" type="submit"
                                        class="<?=$pay?>_form btn1 btn-success btn-labeled btn-lg" id="submit_sberbank"
                                        data-disable-with="<b><i class=" fa fa-money
                                ">
                                Заявка оплачена с этого аккаунта
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
        </div>
                <?php break;
            case 'ETH': ?>
                <div class="panel panel-default payment_panel">
                    <div class="panel-heading">
                        Ссылка на транзакцию и 4 последние цифры кошелька
                    </div>
                    <div class="panel-body">
                        <form class="edit_transaction" id="edit_transaction_17118" data-toggle="validator"
                              data-id="change_wmz"
                              enctype="multipart/form-data"
                              accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden"
                                                                                             value="✓"><input
                                    type="hidden" name="authenticity_token"
                                    value="vohqTf7iQJDdMudvdW2BWSYpMAFcD3Ev7ecZuUnOlOaicrRVwV7q4IXr7Lab7dFBvk0t443yne/+pYxMOpEOUQ==">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="c_label">
                                        Ссылка на транзакцию
                                    </label>
                                    <input required class="span2 c_num value_num" id="<?=$pay?>_num"
                                           placeholder="https://www.blockchain.com/eth/tx/0x0587636be56b22cda4b4fd0cd08300b2b7b179a128b25d383333920df0e1e4fd"
                                           type="text" name="transaction[account_id]">
                                    <span class="label label-block label-danger hidden block mt-5"></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="c_label">
                                        4 последние цифры кошелька
                                    </label>
                                    <input required class="span2 c_num value_name" id="<?=$pay?>_name" placeholder="8a88" type="text"
                                           name="transaction[account_name]">
                                    <span class="label label-block label-danger hidden block mt-5"></span>
                                </div>
                            </div>
                            <div class="actions text-center form-group mt-20">
                                <button id='payed' name="button" type="submit"
                                        class="<?=$pay?>_form btn1 btn-success btn-labeled btn-lg" id="submit_sberbank"
                                        data-disable-with="<b><i class=" fa fa-money
                                ">
                                Заявка оплачена с этого аккаунта
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php break;
            case 'BTC': ?>
                <div class="panel panel-default payment_panel">
                    <div class="panel-heading">
                        Ссылка на транзакцию и 4 последние цифры кошелька
                    </div>
                    <div class="panel-body">
                        <form class="edit_transaction" id="edit_transaction_17118" data-toggle="validator"
                              data-id="change_wmz"
                              enctype="multipart/form-data"
                              accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden"
                                                                                             value="✓"><input
                                    type="hidden" name="authenticity_token"
                                    value="vohqTf7iQJDdMudvdW2BWSYpMAFcD3Ev7ecZuUnOlOaicrRVwV7q4IXr7Lab7dFBvk0t443yne/+pYxMOpEOUQ==">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="c_label">
                                        Ссылка на транзакцию
                                    </label>
                                    <input class="span2 c_num value_num" id="<?=$pay?>_num"
                                           placeholder="https://www.blockchain.com/btc/tx/5d881417cf5c5b045917dc678513813e19bbaca1bad9ddeddaee784214b456c6"
                                           type="text" name="transaction[account_id]">
                                    <span class="label label-block label-danger hidden block mt-5"></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="c_label">
                                        4 последние цифры кошелька
                                    </label>
                                    <input class="span2 c_num value_name" id="<?=$pay?>_name" placeholder="8b88" type="text"
                                           name="transaction[account_name]">
                                    <span class="label label-block label-danger hidden block mt-5"></span>
                                </div>
                            </div>
                            <div class="actions text-center form-group mt-20">
                                <button id='payed' name="button" type="submit"
                                        class="<?=$pay?>_form btn1 btn-success btn-labeled btn-lg" id="submit_sberbank"
                                        data-disable-with="<b><i class=" fa fa-money
                                ">
                                Заявка оплачена с этого аккаунта
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php break;
            case 'USDt': ?>
                <div class="panel panel-default payment_panel">
                    <div class="panel-heading">
                        Ссылка на транзакцию и 4 последние цифры кошелька
                    </div>
                    <div class="panel-body">
                        <form class="edit_transaction" id="edit_transaction_17118" data-toggle="validator"
                              data-id="change_wmz"
                              enctype="multipart/form-data"
                              accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden"
                                                                                             value="✓"><input
                                    type="hidden" name="authenticity_token"
                                    value="vohqTf7iQJDdMudvdW2BWSYpMAFcD3Ev7ecZuUnOlOaicrRVwV7q4IXr7Lab7dFBvk0t443yne/+pYxMOpEOUQ==">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="c_label">
                                        Ссылка на транзакцию
                                    </label>
                                    <input required class="span2 c_num value_num" id="<?=$pay?>_num"
                                           placeholder="https://blockchair.com/en/ethereum/erc-20/token/0xdac17f958d2ee523a2206206994597c13d831ec7"
                                           type="text" name="transaction[account_id]">
                                    <span class="label label-block label-danger hidden block mt-5"></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="c_label">
                                        4 последние цифры кошелька
                                    </label>
                                    <input required class="span2 c_num value_name" id="<?=$pay?>_name" placeholder="8a88" type="text"
                                           name="transaction[account_name]">
                                    <span class="label label-block label-danger hidden block mt-5"></span>
                                </div>
                            </div>
                            <div class="actions text-center form-group mt-20">
                                <button id='payed' name="button" type="submit"
                                        class="<?=$pay?>_form btn1 btn-success btn-labeled btn-lg" id="submit_sberbank"
                                        data-disable-with="<b><i class=" fa fa-money
                                ">
                                Заявка оплачена с этого аккаунта
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            <?php break;
            } ?>
                <button id='cancel' name="button" style="background: red; margin-left: 41%"
                        class="btn1 btn-success btn-labeled btn-lg" id="submit_sberbank"
                        data-disable-with="<b><i class=" fa fa-money
                ">
                Отменить заявку
                </button>
                <din class="text-center block mt-20 mb-20">
                    <div class="btn-group" role="group">
                    </div>
                </din> <?php } ?>
        </div>
    </div>
</div>
    <div class="user">
        <h3 class="wait">Заказ № <?= $num ?></h3>
        <div class="userclient">
            <div id='chat' class="chat">
                <?php

                $messages = R::findAll('chat', 'to_user = ? AND from_user = ? OR to_user = ? AND from_user = ?', [(string)$user_id, '0', '0', (string)$user_id]);
                $end_message = 0;
                if (!empty($messages))
                    foreach ($messages as $message) { ?>
                        <div data="<?= $message->id ?>"
                             class="containerchat<?= $message->from_user == $user_id ? ' darker' : '' ?>">
                            <h4><?= $message->from_user != $user_id ? 'Admin' : $_SESSION['logged_user']['login'] ?></h4>
                            <?php
                            $img = $message->photo;
                            if ($img != 'data:') { ?>
                                <img style="object-fit: contain; width: 300px" src=<?= $img ?>>
                            <?php }
                            $mes = $message->message;
                            $flag = false;
                            if (strlen($mes) !== 0) { ?>
                                <p><?= $message->message ?></p> <?php }
                            ?>
                            <span class="time-right"><?= join(':', array_slice(explode(':', $message->time), 0, 2)) ?></span>
                        </div> <?php $end_message = $message->id;
                    }
                $_SESSION['end_message'] = $end_message;
                ?>
            </div>
        </div>
        <?php if ($block !== '1') { ?>
            <form id="form" enctype="multipart/form-data" action="answer.php" method="post">
                <input id="message-input" name="message-input" type="text" size="100"
                       placeholder="Написать сообщение..."><br>
                <label style="width: 115px" class="photo_input" for="photo"><p style="font-size: 10px; text-align: center">Загрузить QR-code</p></label>
                <input type="submit" id="btn-submit">
                <input class="photo_input_i" id='photo' type="file" name="photo" accept="image/*,image/jpeg">
            </form> </div><?php }
        } ?>
<!--    </div>-->
    <?php
    //    $user_pay = R::findOne('users', 'id = ?', [$user_id])->pay_status;
    //    if ($user_pay) { ?>
    <!--        <button id="pay" class="btn">Заявка оплачена</button>-->
    <?php //} ?>
</body>
</html>