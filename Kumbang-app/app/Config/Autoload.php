<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

class Autoload extends AutoloadConfig
{
    public $psr4 = [
        APP_NAMESPACE => APPPATH, // For custom app namespace
        'Config'      => APPPATH . 'Config',
        'App'         => APPPATH, // Add this line
        'Myth\Auth'   => APPPATH . 'ThirdParty/myth-auth/src',

    ];

    public $autoload = ['session'];

    public $files = [];

    public $helpers = [];
}
