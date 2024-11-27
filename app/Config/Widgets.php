<?php
namespace Config;
use CodeIgniter\Config\BaseConfig;

class Widgets extends BaseConfig{

    public array $positions = [
            1 => 'header',
            2 => 'footer',
            3 => 'sidebar-left',
            4 => 'sidebar-right',
            5 => 'content-top',
            6 => 'content-bottom',
    ];
    
}

