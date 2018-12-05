<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    protected function categories()
    {
        return [
            ['name' => 'Uncategorized']
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