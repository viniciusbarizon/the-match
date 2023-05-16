<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Brazilian real',
            'salary_requirement_per' => 'month',
            'symbol' => 'R$'
        ]);
    }
}
