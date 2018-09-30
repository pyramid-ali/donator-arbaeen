<?php 

    return [

        'defaults' => [
            'token_bot' => env("TELEGRAM_TOKEN"),
            'webhook' => env("TELEGRAM_WEBHOOK"),
        ],

        'commands' => [
            'active' => true,
            'list' => [
                'start' => \App\Arbaeen\Commands\StartCommand::class
            ]
        ],


        'handlers' => [
            'CallbackQuery'      => \App\Arbaeen\Handlers\CallbackQuery::class,
            'ChannelPost'        => \App\Arbaeen\Handlers\ChannelPost::class,
            'ChosenInlineResult' => \App\Arbaeen\Handlers\ChosenInlineResult::class,
            'EditedChannelPost'  => \App\Arbaeen\Handlers\EditedChannelPost::class,
            'EditedMessage'      => \App\Arbaeen\Handlers\EditedMessage::class,
            'InlineQuery'        => \App\Arbaeen\Handlers\InlineQuery::class,
            'Message'            => \App\Arbaeen\Handlers\Message::class,
            'ShippingQuery'      => \App\Arbaeen\Handlers\ShippingQuery::class,
            'PreCheckoutQuery'   => \App\Arbaeen\Handlers\PreCheckoutQuery::class
        ],

        /*
         * define ExceptionHandler if you want to handle any error occurred during telegram response parser process
         * if you don't define any, TelegramException will throw
         * you should handle this error if you don't want to telegram send the response again
         */
        'ExceptionHandler' => \App\Arbaeen\Exception\TelegramException::class,

        'loaders' => [
            \App\Arbaeen\Loaders\ClientLoader::class,
            \App\Arbaeen\Loaders\LoginUser::class,
            \App\Arbaeen\Loaders\Kernel::class
        ]
    ];
