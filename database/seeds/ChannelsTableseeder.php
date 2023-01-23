<?php

use LaravelForum\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'Laravel',
            'slug' => str_slug('Laravel')
        ]);
        Channel::create([
            'name' => 'Vue Js',
            'slug' => str_slug('Vue Js')
        ]);
        Channel::create([
            'name' => 'Angular',
            'slug' => str_slug('Angular')
        ]);
        Channel::create([
            'name' => 'Nod Js',
            'slug' => str_slug('Nod Js')
        ]);
    }
}
