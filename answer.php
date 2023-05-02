<?php
    require_once("bd.php");
    $user_id = $_SESSION['logged_user']['id'];
    $user_login = $_SESSION['logged_user']['login'];
    $admins_pre = R::findAll('users', 'privelegies = ?', ['1']);
    $admins = [];
    foreach ($admins_pre as $admin)
        array_push($admins, $admin->id);
    $data = json_decode(file_get_contents('php://input'), true);
    function update($to_user, $end_message) {
        global $user_id, $admins;
        if (in_array($user_id, $admins))
            $messages = R::findAll('chat', 'to_user = ? AND from_user = ? OR to_user = ? AND from_user = ?', [(string)$to_user, '0', '0', (string)$to_user]);
        else
            $messages = R::findAll('chat', 'to_user = ? AND from_user = ? OR to_user = ? AND from_user = ?', [(string) $user_id, '0', '0', (string) $user_id]);
//        $end_message = min($_SESSION['end_message'], $end_message);
        $messages = array_filter($messages, fn($message) => (int) $message['id'] > (int) $end_message);
        $result = [];
        if (in_array($user_id, $admins))
            $user = R::findOne('users', 'id = ?', [$to_user]);
        else
            $user = R::findOne('users', 'id = ?', [$user_id]);
        $login = $user->login;
        $block = $user->block;
        foreach ($messages as $message) {
            $result[] = [$message->from_user == $user_id || $message->from_user == '0' && in_array($user_id, $admins) ? 'containerchat darker' : 'containerchat',
                $message->from_user == '0'  ? 'Admin' : $login,
                $message->photo,
                $message->message,
                join(':', array_slice(explode(':', $message->time), 0, 2)),
                $block,
                $message->id];
            $end_message = $message->id;
        }
//        $_SESSION['end_message'] = $end_message;
        echo json_encode($result);
    }
    if (isset($data['message-input'])) {
        $chat = R::dispense('chat');
        $chat->from_user = in_array($user_id, $admins) ? '0' : $user_id;
        $chat->to_user = (string) $data['to_user'];
        $chat->message = $data['message-input'];
        $chat->photo = $data['photo'];
        $chat->time = date("H:i");
        R::store($chat);


        $user = R::findOne('users', 'id = ?', [$user_id]);
//        $user->chat = (string) $_SESSION['num'];
        $user->wait = in_array($user_id, $admins) ? '0' : '1';
        R::store($user);

//        if (in_array($user_id, $admins)) {
//            $fuser = R::findOne('users', 'id = ?', [(string) $data['to_user']]);
//            $fuser->wait = '0';
//            R::store($fuser);
//        }

        update((string) $data['to_user'], (string) $data['end_message']);
    }
    else if (isset($data['waiters'])) {
        $waiters = R::findAll('users', 'wait = ?', [1]);
//        $end_wait = explode(',', $data['waiters']);
//        error_log($data['waiters']);
//        $waiters = array_filter($waiters, fn($wait) => ! in_array($wait->id, $end_wait));
        $result_wait = [];
        foreach ($waiters as $wait) {
            $data_wait = [$wait->id];
            $log = R::findOne('log', 'chat = ?', [$wait->chat]);
            if ($log === null)
                continue;
            $user = R::findOne('users', 'id = ?', [$wait->id]);
            $login = $user->login;
            $block = $user->block;
            $end_message = 0;
            $messages = R::findAll('chat', 'to_user = ? AND from_user = ? OR to_user = ? AND from_user = ?', [(string) $wait->id, '0', '0', (string) $wait->id]);
            $messages = array_filter($messages, fn($message) => $message->id > $end_message);
            $result = [];
            foreach ($messages as $message) {
                $mes = [];
                $mes[] = $message->from_user == $user_id || $message->from_user == '0' && in_array($user_id, $admins) ? 'containerchat darker' : 'containerchat';
                $mes[] = $message->from_user == '0' ? 'Admin' : $login;
                $mes[] = $message->photo;
                $mes[] = $message->message;
                $mes[] = join(':', array_slice(explode(':', $message->time), 0, 2));
                $mes[] = $block;
                $mes[] = $message->id;
                $result[] = $mes;
                $end_message = $message->id;
            }
            $_SESSION['end_message'] = $end_message;
            $data_wait[] = $result;
            $data_wait[] = $login;
            $log_arr = [$wait->chat, $log->login, $log->date, $log->sum_get, $log->method];
            $data_wait[] = $log_arr;
            $result_wait[] = $data_wait;
        }
        echo json_encode($result_wait);
    }
    else if (isset($data['pay'])) {
        $log = R::findOne('log', 'login = ?', [$user_login]);
        if ($log === null) {
            $max_mum = max(R::getCol('SELECT chat FROM users'));
            $num = $max_mum + 1;
            $_SESSION['num'] = $num;
            $_SESSION['sum_get'] = $data['sum'];
            $_SESSION['sum'] = $data['get_sum'];
            $_SESSION['method'] = $data['pay'];
            $_SESSION['cur_kurs'] = $data['kurs'];
            $_SESSION['date'] = date("Y-m-d H:i:s");
            $_SESSION['login'] = $user_login;
        }
        else
            $num = R::findOne('users', 'id = ?', [$user_id])->chat;

        $user = R::findOne('users', 'id = ?', [$user_id]);
        $_SESSION['go'] = true;
        $user->pay_status = '0';
        $user->block = '0';
        R::store($user);

    }
    else if (isset($data['pay_status'])) {
        $log = R::dispense('log');
        $log->chat = (string) $_SESSION['num'];
        $log->login = (string) $_SESSION['login'];
        $log->date = date("Y-m-d H:i:s");
        $log->sum_get = (string) $_SESSION['sum_get'];
        $log->sum = (string)  $_SESSION['sum'];
        $log->method = (string) $_SESSION['method'];
        $log->kurs = (string) $_SESSION['cur_kurs'];
        R::store($log);

        $chat = R::dispense('chat');
        $chat->from_user = in_array($user_id, $admins) ? '0' : $user_id;
        $chat->to_user = '0';
        $chat->message = $data['text'];
        $chat->photo = 'data:';
        $chat->time = date("H:i");
        R::store($chat);

        $user = R::findOne('users', 'id = ?', [$user_id]);
        $user->chat = $_SESSION['num'];
        $user->pay_status = '1';
        $user->wait = '1';
        R::store($user);

    }
    else if (isset($data['end'])) {
        $to_user = $data['to_user'];
        $chat_num = $data['chat'];

        $chat = R::dispense('chat');
        $chat->from_user = '0';
        $chat->to_user = (string) $to_user;
        $chat->message = "Сделка завершена, если возникли вопросы или произошла ошибка обратитесь по контактам.<br>".
            "Если вам все понравилось, оставьте <a href='../reviews.php'>отзыв</a> <br> Хочешь вернуться на главную <br> <a href='../reviews.php'>Нажми на меня</a>";
        $chat->photo = 'data:';
        $chat->time = date("H:i");
        R::store($chat);

        $user = R::findOne('users', 'id = ?', [$to_user]);
        $user->wait = '0';
        $user->block = '1';
        R::store($user);

        R::exec('DELETE FROM log WHERE chat = ?', [$chat_num]);

    }
    else if (isset($data['timer'])) {
        $user = R::findOne('users', 'id = ?', [$user_id]);
        $user->wait = '0';
        $user->block = '1';
        $user->pay_status = '0';
        R::store($user);

    }
    else if (isset($data['kurs'])) {
        $kurs = R::findOne('kurs', 'id = ?', ['1']);
        $kurs->kurs = $data['kurs'];
        R::store($kurs);
    }
    else if (isset($data['details'])) {
        $sber = R::findOne('details', 'pay = ?', ['sber']);
        if (strlen($data['dcard_sber']) > 0) $sber->val1 = $data['dcard_sber'];
        if (strlen($data['dname_sber']) > 0) $sber->val2 = $data['dname_sber'];
        R::store($sber);

        $tinkoff = R::findOne('details', 'pay = ?', ['tinkoff']);
        if (strlen($data['dcard_tinkoff']) > 0) $tinkoff->val1 = $data['dcard_tinkoff'];
        if (strlen($data['dname_tinkoff']) > 0) $tinkoff->val2 = $data['dname_tinkoff'];
        R::store($tinkoff);

        $qiwi = R::findOne('details', 'pay = ?', ['qiwi']);
        if (strlen($data['qiwi']) > 0) $qiwi->val1 = $data['qiwi'];
        R::store($qiwi);

        $btc = R::findOne('details', 'pay = ?', ['btc']);
        if (strlen($data['btc']) > 0) $btc->val1 = $data['btc'];
        R::store($btc);

        $eth = R::findOne('details', 'pay = ?', ['eth']);
        if (strlen($data['eth']) > 0) $eth->val1 = $data['eth'];
        R::store($eth);
        
        $usdt = R::findOne('details', 'pay = ?', ['usdt']);
        if (strlen($data['usdt']) > 0) $usdt->val1 = $data['usdt'];
        R::store($usdt);
    }
    else
        update((string) $data['to_user'], (string) $data['end_message']);
