<?php

namespace zoparga\SimpleTelegram;

use Illuminate\Support\Facades\Http;

class SimpleTelegram
{
    public $text;
    public $video;
    public $choosenBot;
    public $chatId;
    public $documentUrl;

    public $messageType = self::MESSAGE;

    const MESSAGE = 'message';
    const VIDEO = 'video';
    const DOCUMENT = 'document';

    const MESSAGE_TYPE = [
        self::VIDEO => 'sendVideo',
        self::DOCUMENT => 'sendDocument',
        self::MESSAGE => 'sendMessage'
    ];

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
        $this->messageType = self::VIDEO;
        return $this;
    }

    public function documentUrl($documentUrl)
    {
        $this->documentUrl = $documentUrl;
        $this->messageType = self::DOCUMENT;
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

        $telegramUrl = "https://api.telegram.org/bot".$this->choosenBot ."/". self::MESSAGE_TYPE[$this->messageType];

        $response = Http::post($telegramUrl, [
            'chat_id' => $this->chatId,
            'text' => $this->text,
            'video' => $this->video,
            'document' => $this->documentUrl,
            'caption' => $this->text,
        ]);

        return $response;
    }
}
