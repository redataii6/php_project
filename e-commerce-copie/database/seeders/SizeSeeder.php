<?php

namespace Database\Seeders;

use App\Models\ProductSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $sizes = [
            ['size' => 'XS'],
            ['size' => 'S'],
            ['size' => 'M'],
            ['size' => 'L'],
            ['size' => 'XL'],
            ['size' => 'XXL'],
            ['size' => '3XL'],
            ['size' => '4XL'],
            ['size' => '5XL'],
        ];

        foreach ($sizes as $size) {
            ProductSize::updateOrCreate(['size' => $size['size']], $size);
        }
    }
}
