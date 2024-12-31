<?php

namespace Database\Seeders;
use App\Models\Numberspeak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NumberspeakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Numberspeak::insert([
            [
                'percentage' => '70',
                'title_en' => 'shipping and sea transportation services',
                'title_ar' => 'خدمات الشحن والنقل البحري',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'percentage' => '60',
                'title_en' => 'shipping and sea transportation services',
                'title_ar' => 'خدمات الشحن والنقل البحري',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                
                'percentage' => '50',
                'title_en' => 'shipping and sea transportation services',
                'title_ar' => 'خدمات الشحن والنقل البحري',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'percentage' => '40',
                'title_en' => 'shipping and sea transportation services',
                'title_ar' => 'خدمات الشحن والنقل البحري',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
