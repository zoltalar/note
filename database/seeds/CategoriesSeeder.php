<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    protected function categories()
    {
        return [
            [
                'name' => 'Uncategorized',
                'color' => 'bg-info'
            ],
            [
                'name' => 'Programming',
                'color' => 'bg-primary'
            ],
            [
                'name' => 'Stock Market',
                'color' => 'bg-warning'
            ],
            [
                'name' => 'Family',
                'color' => 'bg-success'
            ],
            [
                'name' => 'Politics',
                'color' => 'bg-danger'
            ],
            [
                'name' => 'Finances',
                'color' => 'bg-secondary'
            ]
        ];
    }
    
    public function run()
    {
        $categories = $this->categories();
        
        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }
    }
}