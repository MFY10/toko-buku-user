<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sale;


class SalesTableSeeder extends Seeder
{
    public function run()
    {
        Sale::create(['book_id' => 1, 'quantity' => 2, 'total_price' => 100000]);
        Sale::create(['book_id' => 2, 'quantity' => 1, 'total_price' => 75000]);
    }
}
