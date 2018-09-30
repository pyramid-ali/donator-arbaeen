<?php

return [

    'message' => [
        'header' => '*کاربر جدیدی در سیستم ثبت شد.*'
    ],

    'telegram' => [
        'header' => 'اطلاعات کاربری تلگرام:',
        'first_name' => 'نام: _:first_name_',
        'last_name' => 'نام خانوادگی: _:last_name_',
        'username' => 'نام کاربری: @:username'
    ],

    'charity' => [
        'finance' => [
            'header' => '*کاربر در بخش مالی اعلام همراهی نموده است*',
            'card_payment' => '_انتخاب کمک مالی از طریق کارت به کارت_',
            'online_payment' => '_انتخاب پرداخت آنلاین از طریق درگاه بانکی_'
        ],
        'item' => [
            'header' => '*اهدای کمک خیریه به صورت اقلام*',
            'donation_item' => 'نام محصول: _:item_',
            'donation_amount' => 'مقدار محصول: _:amount_'
        ]
    ],

    'activity' => [
        'header' => 'انتخاب نیروی انسانی به عنوان همراهی',
        'section' => 'بخش: :section',
        'unit' => 'واحد: :unit'
    ],

    'signup' => [
        'header' => 'اطلاعات ثبت نامی کاربر به صورت زیر می باشد:',
        'first_name' => 'نام: :first_name',
        'last_name' => 'نام خانوادگی: :last_name',
        'national_number' => 'کد ملی: :national_number',
        'passport_number' => 'شماره گذرنامه: :passport_number',
        'tel_number' => 'تلفن همراه: :tel_number'
    ]

];
