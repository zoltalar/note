<?php

namespace App;

final class Category extends Base
{
    protected $table = 'categories';
    
    protected $fillable = ['name', 'color'];
    
    public $timestamps = false;
}