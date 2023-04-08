<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'name' => 'Hidden Treasures',
                'isbn' => uniqid('ISBN'),
                'author_id' => 1
            ],
            [
                'name' => 'Tales of Borderland',
                'isbn' => uniqid('ISBN'),
                'author_id' => 1
            ]
            ]);
    }
}
