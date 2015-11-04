<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('ForumTableSeeder');
        $this->call('ForumGroupTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('ThreadTableSeeder');
        $this->call('PostTableSeeder');

        Model::reguard();
    }
}
