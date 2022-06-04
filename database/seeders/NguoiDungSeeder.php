<?php

namespace Database\Seeders;

use App\Models\NguoiDung;
use Illuminate\Database\Seeder;

class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nb = (int) $this->command->ask('How many users do you want to create?', 12);
        NguoiDung::factory($nb)->create();
    }
}