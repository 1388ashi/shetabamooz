<?php

return [
    'sms' => [
        'driver' => 'kavenegar',
        'sender' => '1000596446',
        'api_key' => '4C4E6E7A424B6676576D3452382F6D66464E477554647470686445315332446B',
        'patterns' => [
            'shetabamooz_bootcamp_hour_reminder' => 'shetabamooz-bootcamp-hour-reminder',
            'shetabamooz_bootcamp_day_reminder' => 'shetabamooz-bootcamp-day-reminder',
            'shetabamooz_bootcamp_register' => 'shetabamooz-bootcamp-register',
            'shetabamooz_sms_comments' => 'shetabamooz-sms-comments',
            'shetabamooz_game_register' => 'shetabamooz-game-register'
        ],
        'new_order' => [
            'dont_send_full_name' => false
        ]
    ],  
];