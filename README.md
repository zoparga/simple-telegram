# About the package

This is a simple wrapper to Telegram.
You can easily send text messages to the desired channel in case you have the webhook.

# Installation
You can install the package via composer:

```composer require zoparga/simple-telegram```

Publish config file

```php artisan vendor:publish --provider="zoparga\SimpleTelegram\SimpleTelegramServiceProvider" --tag="config"```

Add the following 2 lines to your .env file:
```json
TELEGRAM_BOT_ID=""
TELEGRAM_BASIC_ROOM=""
``` 

You can call it with the following:

```
$text = 'Your text';
SimpleTelegram::prepare()->text($text)->send();
```
