<?php

namespace zoparga\SimpleTelegram;

use Illuminate\Support\Facades\Http;

class SimpleTelegram
{
    public $text;
    public $video;
    public $choosenBot;
    public $chatId;

    public static function prepare()
    {
        return new static;
    }


    public function text($text)
    {
        $appName = config('app.name'). "\n";

        $this->text = $appName . $text;
        return $this;
    }



    public function video($video)
    {
        $this->video = $video;
        return $this;
    }

    public function chatId($chatId)
    {
        $this->chatId = $chatId;
        return $this;
    }

    public function choosenBot($choosenBot)
    {
        $this->choosenBot = $choosenBot;
        return $this;
    }


    public function send()
    {
        if (!$this->chatId) {
            $this->chatId = config('simpletelegram.basic');
        }
        if (!$this->choosenBot) {
            $this->choosenBot = config('simpletelegram.bot_id');
        }


        if ($this->video) {
            $messageType = "sendVideo";
        } else {
            $messageType = "sendMessage";
        }

        $telegramUrl = "https://api.telegram.org/bot".$this->choosenBot ."/". $messageType;





        $response = Http::post($telegramUrl, [
            'chat_id' => $this->chatId,
            'text' => $this->text,
            'video' => $this->video,
            'caption' => $this->text,
        ]);

        return $response;
    }
}
