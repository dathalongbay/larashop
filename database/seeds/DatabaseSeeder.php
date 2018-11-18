<?php

use Illuminate\Database\Seeder;
use App\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SettingTableSeeder::class);

        /*Admin::create([
            'name' => 'Admin',
            'email' => 'dathalongbay@gmail.com',
            'password' => Hash::make('12345678'),
        ]);*/
    }
}
