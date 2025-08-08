<?php

require 'kirby/bootstrap.php';
$kirby = new Kirby([
    'roots' => [
        // 'index'   => __DIR__,
        // 'kirby'    => __DIR__ . '/vendor/kirby',

        // src
        'site'      => __DIR__ . '/site',

            // components
            'snippets'  => __DIR__ . '/site/components',
                'templates' => __DIR__ . '/site/components/views',

            // admin
            'admin'     => __DIR__ . '/site/admin',

            // config
            'config'        => __DIR__ . '/site/config',
            
            // lib
            'engine'       => __DIR__ . '/site/engine',
                'blueprints'    => __DIR__ . '/site/engine/blueprints',
                'collections'   => __DIR__ . '/site/engine/collections',
                'controlers'    => __DIR__ . '/site/engine/controlers',
                'models'        => __DIR__ . '/site/engine/models',
                'plugins'       => __DIR__ . '/site/engine/plugins',

            // store
            'store'     => __DIR__ . '/site/store',
                'cache'         => __DIR__ . '/site/store/cache',
                'logs'          => __DIR__ . '/site/store/logs',

                // safe
                'safe'      => __DIR__ . '/site/store/safe',
                    'accounts'      => __DIR__ . '/site/store/safe/accounts',
                    'sessions'      => __DIR__ . '/site/store/safe/sessions',


        // public
        'public'      => __DIR__ . '/public',
            'content'   => __DIR__ . '/public/content',
            'assets'    => __DIR__ . '/public/assets',
            'media'     => __DIR__ . '/public/media',
    ]
]);
echo $kirby->render();
