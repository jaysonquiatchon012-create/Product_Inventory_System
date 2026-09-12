<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Electronics',
            'code' => 'ELEC',
        ]);

        Category::create([
            'name' => 'Clothing',
            'code' => 'CLTH',
        ]);

        Category::create([
            'name' => 'Food',
            'code' => 'FOOD',
        ]);

        Category::create([
            'name' => 'School Supplies',
            'code' => 'SCH',
        ]);
    }
}