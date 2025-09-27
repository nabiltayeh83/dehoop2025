<?php

return [
    'twilio' => [
        'default' => 'twilio',
        'connections' => [
            'twilio' => [
         
                'sid' => env('TWILIO_SID', 'ACb1d77b0b7d96b8df9c362a639cf7f97f'),
                'token' => env('TWILIO_TOKEN', 'b294e7a819c53f35fe8bd7ca4e0da542'),
                'from' => env('TWILIO_FROM', 'Good Life Community'),
            ],
        ],
    ],
];
