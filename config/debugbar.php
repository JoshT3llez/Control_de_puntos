<?php

return [


    'enabled' => env('DEBUGBAR_ENABLED', env('APP_DEBUG', false)),
    'hide_empty_tabs' => true, // Hide tabs until they have content
    'except' => [
        'telescope*',
        'horizon*',
    ],
    'storage' => [
        'enabled'    => true,
        'open'       => env('DEBUGBAR_OPEN_STORAGE'), // bool/callback.
        'driver'     => 'file', // redis, file, pdo, socket, custom
        'path'       => storage_path('debugbar'), // For file driver
        'connection' => null,   // Leave null for default connection (Redis/PDO)
        'provider'   => '', // Instance of StorageInterface for custom driver
        'hostname'   => '127.0.0.1', // Hostname to use with the "socket" driver
        'port'       => 2304, // Port to use with the "socket" driver
    ],

   
    'editor' => env('DEBUGBAR_EDITOR') ?: env('IGNITION_EDITOR', 'phpstorm'),

    

    'remote_sites_path' => env('DEBUGBAR_REMOTE_SITES_PATH'),
    'local_sites_path' => env('DEBUGBAR_LOCAL_SITES_PATH', env('IGNITION_LOCAL_SITES_PATH')),


    'include_vendors' => true,

   

    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'ajax_handler_auto_show' => true,
    'ajax_handler_enable_tab' => true,


    'error_handler' => false,

  
    'clockwork' => false,



    'collectors' => [
        'phpinfo'         => true,  // Php version
        'messages'        => true,  // Messages
        'time'            => true,  // Time Datalogger
        'memory'          => true,  // Memory usage
        'exceptions'      => true,  // Exception displayer
        'log'             => true,  // Logs from Monolog (merged in messages if enabled)
        'db'              => true,  // Show database (PDO) queries and bindings
        'views'           => true,  // Views with their data
        'route'           => true,  // Current route information
        'auth'            => false, // Display Laravel authentication status
        'gate'            => true,  // Display Laravel Gate checks
        'session'         => true,  // Display session data
        'symfony_request' => true,  // Only one can be enabled..
        'mail'            => true,  // Catch mail messages
        'laravel'         => false, // Laravel version and environment
        'events'          => false, // All events fired
        'default_request' => false, // Regular or special Symfony request logger
        'logs'            => false, // Add the latest log messages
        'files'           => false, // Show the included files
        'config'          => false, // Display config settings
        'cache'           => false, // Display cache events
        'models'          => true,  // Display models
        'livewire'        => true,  // Display Livewire (when available)
        'jobs'            => false, // Display dispatched jobs
        'pennant'         => false, // Display Pennant feature flags
    ],



    'options' => [
        'time' => [
            'memory_usage' => false,  // Calculated by subtracting memory start and end, it may be inaccurate
        ],
        'messages' => [
            'trace' => true,   // Trace the origin of the debug message
        ],
        'memory' => [
            'reset_peak' => false,     // run memory_reset_peak_usage before collecting
            'with_baseline' => false,  // Set boot memory usage as memory peak baseline
            'precision' => 0,          // Memory rounding precision
        ],
        'auth' => [
            'show_name' => true,   // Also show the users name/email in the debugbar
            'show_guards' => true, // Show the guards that are used
        ],
        'db' => [
            'with_params'       => true,   // Render SQL with the parameters substituted
            'exclude_paths'     => [       // Paths to exclude entirely from the collector
//                'vendor/laravel/framework/src/Illuminate/Session', // Exclude sessions queries
            ],
            'backtrace'         => true,   // Use a backtrace to find the origin of the query in your files.
            'backtrace_exclude_paths' => [],   // Paths to exclude from backtrace. (in addition to defaults)
            'timeline'          => false,  // Add the queries to the timeline
            'duration_background'  => true,   // Show shaded background on each query relative to how long it took to execute.
            'explain' => [                 // Show EXPLAIN output on queries
                'enabled' => false,
            ],
            'hints'             => false,   // Show hints for common mistakes
            'show_copy'         => true,    // Show copy button next to the query,
            'slow_threshold'    => false,   // Only track queries that last longer than this time in ms
            'memory_usage'      => false,   // Show queries memory usage
            'soft_limit'       => 100,      // After the soft limit, no parameters/backtrace are captured
            'hard_limit'       => 500,      // After the hard limit, queries are ignored
        ],
        'mail' => [
            'timeline' => false,  // Add mails to the timeline
            'show_body' => true,
        ],
        'views' => [
            'timeline' => false,    // Add the views to the timeline (Experimental)
            'data' => false,        // True for all data, 'keys' for only names, false for no parameters.
            'group' => 50,          // Group duplicate views. Pass value to auto-group, or true/false to force
            'exclude_paths' => [    // Add the paths which you don't want to appear in the views
                'vendor/filament'   // Exclude Filament components by default
            ],
        ],
        'route' => [
            'label' => true,  // Show complete route on bar
        ],
        'session' => [
            'hiddens' => [], // Hides sensitive values using array paths
        ],
        'symfony_request' => [
            'hiddens' => [], // Hides sensitive values using array paths, example: request_request.password
        ],
        'events' => [
            'data' => false, // Collect events data, listeners
        ],
        'logs' => [
            'file' => null,
        ],
        'cache' => [
            'values' => true, // Collect cache values
        ],
    ],


    'inject' => true,


    'route_prefix' => '_debugbar',


    'route_middleware' => [],


    'route_domain' => null,


    'theme' => env('DEBUGBAR_THEME', 'auto'),


    'debug_backtrace_limit' => 50,
];
