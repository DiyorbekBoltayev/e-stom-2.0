<?php

namespace App\Http\Service;

class TelegramService
{


    public function call($method, $params = [])
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_API_TOKEN') . '/']);
        $response = $client->request('POST', $method, ['form_params' => $params]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public  function sendMessage($chat_id, $text, $reply_markup = null)
    {
        $params = compact('chat_id', 'text', 'reply_markup');
        return $this->call('sendMessage', $params);
    }
    public  function editMessage($chat_id, $text, $message_id, $reply_markup = null)
    {
        $params = compact('chat_id', 'text', 'message_id', 'reply_markup');
        return $this->call('editMessageText', $params);
    }
    //edit message for remove buttons
    public  function editMessageReplyMarkup($chat_id, $message_id, $reply_markup = null)
    {
        $params = compact('chat_id', 'message_id', 'reply_markup');
        return $this->call('editMessageReplyMarkup', $params);
    }



    public function respondToCallback($callbackId)
    {
        $params = [
            'callback_query_id' => $callbackId
        ];

        $this->call('answerCallbackQuery', $params);
    }
}
