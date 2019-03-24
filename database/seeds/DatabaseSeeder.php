<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'name' => 'Md Abul Kalam',
       	    'email' => 'tipu@gmail.com',
            'password' => bcrypt('123'),
      	    'remember_token' => str_random(10),
        ]);

        DB::table('categories')->insert([
            'category_name' => 'uncategorized',
            'slug' => 'uncategorized',
            'short_description' => 'All uncategorized products',
        ]);

    }
}
