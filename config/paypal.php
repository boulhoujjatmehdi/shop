<?php 
return[
    //SANDBOX
    'sandbox_client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
    'sandbox_secret' => env('PAYPAL_SANDBOX_SECRET'),


    //LIVE 
    'live_client_id' => env('PAYPAL_LIVE_CLIENT_ID'),
    'live_secret' => env('PAYPAL_LIVE_SECRET'),

    //PAYPAL SDK CONFIGURATIONS
    'settings' =>[
        //live or sandbox in mode 
        'mode' =>env('PAYPAL_MODE', 'sandbox'),
        //connection timout
        'http.ConnectionTimeOut' => 3000,
        //logs
        'log.LogEnabled' => true,
        'log.FileName'=> storage_path(). '/logs/paypal.log',
        //debug:DBUG , INFO , WARN , ERROR
        'log.LogLevel'=>'DEBUG'
    ]    
    
];
?>

