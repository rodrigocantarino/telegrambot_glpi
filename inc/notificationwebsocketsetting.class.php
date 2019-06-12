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

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

/**
 *  This class manages the sms notifications settings
 */
class PluginTelegrambotNotificationWebsocketSetting extends NotificationSetting {

    static function getTypeName($nb = 0) {
        return __('Telegram followups configuration', 'telegrambot');
    }

    public function getEnableLabel() {
        return __('Enable followups via Telegram', 'telegrambot');
    }

    static public function getMode() {
        return Notification_NotificationTemplate::MODE_WEBSOCKET;
    }

    function showFormConfig($options = []) {
        global $CFG_GLPI;

        $bot_token = PluginTelegrambotBot::getConfig('token');
        $bot_username = PluginTelegrambotBot::getConfig('bot_username');

        $form_action = Toolbox::getItemTypeFormURL(__CLASS__);
        $pluralized_translation = _n('Telegram notification', 'Telegram notifications', Session::getPluralNumber());
        $bot_token_translation = __('Bot token');
        $bot_username_translation = __('Bot username');

        $out = <<<HTML
<form action='{$form_action}' method='post'>
<div>
<table class='tab_cadre_fixe'>
    <tr class='tab_bg_1'> <th colspan='4'> {$pluralized_translation} </th> </tr>
    
    <tr class='tab_bg_2'>
        <td> {$bot_token_translation} </td>
        <td>
            <input type='text' name='token' value='{$bot_token}' style='width: 100%'>
        </td>
        <td colspan='2'>&nbsp;</td>
    </tr>
            
    <tr class='tab_bg_2'>
        <td> {$bot_username_translation} </td>
        <td>
            <input type='text' name='bot_username' value='{$bot_username}' style='width: 100%'>
        </td>
        <td colspan='2'>&nbsp;</td>
    </tr>
HTML;

        echo $out;
        $this->showFormButtons($options); // Put the buttons line and close the tags </table></div></form>
    }
}