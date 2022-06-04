<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            NguoiDungSeeder::class,
            AdminSeeder::class,
            MessagesSeeder::class
        ]);
    }
}
