<?php

use Illuminate\Database\Seeder;
use App\Link;

class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
        	[
        		'name' => 'Jawa Tengah',
        		'link' => 'http://lpse.jatengprov.go.id/eproc4'
        	],
        	[
        		'name' => 'Kemenag',
        		'link' => 'https://lpse.kemenag.go.id/eproc4/'
        	],
        	[
        		'name' => 'Jawa Barat',
        		'link' => 'https://www.lpse.jabarprov.go.id/eproc4/'
        	],
        ];

        Link::insert($datas);
    }
}
