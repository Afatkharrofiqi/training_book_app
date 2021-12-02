<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 100; $i++) {
            $name = 'Category '.$i;
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name)
            ]);
        }
    }
}
