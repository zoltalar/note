<?php

namespace App;

final class Note extends Base
{
    protected $table = 'notes';
    
    protected $fillable = ['note', 'category_id'];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
