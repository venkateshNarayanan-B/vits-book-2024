<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BrowserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'engine'    => 'Gecko',
                'browser'   => 'Firefox 1.0',
                'platform'  => 'Win 98+ / OSX.2+',
                'version'   => '1.7',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Gecko',
                'browser'   => 'Firefox 1.5',
                'platform'  => 'Win 98+ / OSX.2+',
                'version'   => '1.8',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Gecko',
                'browser'   => 'Firefox 2.0',
                'platform'  => 'Win 98+ / OSX.2+',
                'version'   => '1.8',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Gecko',
                'browser'   => 'Firefox 3.0',
                'platform'  => 'Win 2k+ / OSX.3+',
                'version'   => '1.9',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Webkit',
                'browser'   => 'Safari 1.2',
                'platform'  => 'OSX.3',
                'version'   => '125.5',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Webkit',
                'browser'   => 'Safari 1.3',
                'platform'  => 'OSX.3',
                'version'   => '312.8',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Webkit',
                'browser'   => 'Safari 2.0',
                'platform'  => 'OSX.4+',
                'version'   => '419.3',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Webkit',
                'browser'   => 'Safari 3.0',
                'platform'  => 'OSX.4+',
                'version'   => '522.1',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Webkit',
                'browser'   => 'Google Chrome',
                'platform'  => 'Win 2k+ / OSX.3+',
                'version'   => '0.2',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Presto',
                'browser'   => 'Opera 7.0',
                'platform'  => 'Win 95+ / OSX.1+',
                'version'   => '7.0',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Presto',
                'browser'   => 'Opera 8.0',
                'platform'  => 'Win 95+ / OSX.1+',
                'version'   => '8.0',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Presto',
                'browser'   => 'Opera 9.0',
                'platform'  => 'Win 95+ / OSX.3+',
                'version'   => '9.0',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Presto',
                'browser'   => 'Opera 9.5',
                'platform'  => 'Win 95+ / OSX.3+',
                'version'   => '9.5',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Presto',
                'browser'   => 'Opera for Wii',
                'platform'  => 'Wii',
                'version'   => '9.5',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Trident',
                'browser'   => 'Internet Explorer 6',
                'platform'  => 'Win 98+',
                'version'   => '6',
                'css_grade' => 'C',
            ],
            [
                'engine'    => 'Trident',
                'browser'   => 'Internet Explorer 7',
                'platform'  => 'Win XP SP2+',
                'version'   => '7',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Trident',
                'browser'   => 'Internet Explorer 8',
                'platform'  => 'Win XP SP2+',
                'version'   => '8',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Trident',
                'browser'   => 'Internet Explorer 9',
                'platform'  => 'Win Vista+',
                'version'   => '9',
                'css_grade' => 'A',
            ],
            [
                'engine'    => 'Misc',
                'browser'   => 'NetFront 3.1',
                'platform'  => 'Embedded devices',
                'version'   => '3.1',
                'css_grade' => 'C',
            ],
            [
                'engine'    => 'Misc',
                'browser'   => 'NetFront 3.4',
                'platform'  => 'Embedded devices',
                'version'   => '3.4',
                'css_grade' => 'A',
            ],
        ];

        // Insert data
        $this->db->table('browsers')->insertBatch($data);
    }
}
