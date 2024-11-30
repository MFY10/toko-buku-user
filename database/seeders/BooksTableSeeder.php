<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;


class BooksTableSeeder extends Seeder
{
    public function run()
    {
        Book::create(['title' => 'Buku A', 'category' => 'Fiksi', 'price' => 50000, 'stock' => 10]);
        Book::create(['title' => 'Buku B', 'category' => 'Non-Fiksi', 'price' => 75000, 'stock' => 5]);
        Book::create(['title' => 'Buku C', 'category' => 'Edukasi', 'price' => 90000, 'stock' => 2]);
    }
}

