<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contracts')->insert([
            ['id' => '01H0K7HJTN82AYK1FRADW0P283', 'name' => 'CLT'],
        ]);
    }
}
