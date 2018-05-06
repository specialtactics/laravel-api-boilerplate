<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Path to the stub files for the generator
    |--------------------------------------------------------------------------
    */
    'path' => base_path('vendor/specialtactics/l5-api/resources/stubs'),

    /*
    |--------------------------------------------------------------------------
    | Default namespaces for the classes
    |--------------------------------------------------------------------------
    | Warning! Root application namespaсe (like "App") should be skipped.
    */
    'namespaces' => [
        'channel'      => '\Broadcasting',
        'command'      => '\Console\Commands',
        'controller'   => '\Http\Controllers',
        'event'        => '\Events',
        'exception'    => '\Exceptions',
        'job'          => '\Jobs',
        'listener'     => '\Listeners',
        'mail'         => '\Mail',
        'middleware'   => '\Http\Middleware',
        'model'        => '\Models',
        'notification' => '\Notifications',
        'policy'       => '\Policies',
        'provider'     => '\Providers',
        'request'      => '\Http\Requests',
        'resource'     => '\Http\Resources',
        'rule'         => '\Rules',
    ],

];
