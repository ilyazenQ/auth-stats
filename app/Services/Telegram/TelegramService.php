<?php

namespace App\Services\Telegram;

use Telegram\Bot\Api;

class TelegramService
{
    public static function sendMessage($message)
    {
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $chatId = env('TELEGRAM_CHAT_ID');
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message
         ]);
    }
}
