<?php

namespace zoparga\SimpleTelegram\Facades;

use Illuminate\Support\Facades\Facade;

class SimpleTelegramFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'simpletelegram';
    }
}
