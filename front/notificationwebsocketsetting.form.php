<?php
/*
 -------------------------------------------------------------------------
 TelegramBot plugin for GLPI
 Copyright (C) 2017 by the TelegramBot Development Team.

 https://github.com/pluginsGLPI/telegrambot
 -------------------------------------------------------------------------

 LICENSE

 This file is part of TelegramBot.

 TelegramBot is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 TelegramBot is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with TelegramBot. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

include ('../../../inc/includes.php');

Session::checkRight('config', UPDATE);
$notification_websocket = new PluginTelegrambotNotificationWebsocketSetting();

// TODO
if (!empty($_POST['test_webhook_send'])) {
    PluginTelegrambotNotificationWebsocket::testNotification();
    Html::back();
} else if (!empty($_POST['update'])) {
    PluginTelegrambotBot::setConfig('token', $_POST['token']);
    PluginTelegrambotBot::setConfig('bot_username', $_POST['bot_username']);
    Html::back();
}

Html::header(
        Notification::getTypeName(Session::getPluralNumber()),
        $_SERVER['PHP_SELF'], 
        'config', 
        'notification', 
        'config'
);

$notification_websocket->display(['id' => 1]);

Html::footer();