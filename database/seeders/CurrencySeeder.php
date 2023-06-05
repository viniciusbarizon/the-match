<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currencies')->insert([
            'id' => '01H0K88685BR21KWWR72ARQDJK',
            'is_salary_per_year' => false,
            'name' => 'Real',
            'symbol' => 'R$',
        ]);
    }
}
