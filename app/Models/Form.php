<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_id', 'category_id', 'field_type', 'field_name', 'options', 'level_name', 'is_required'
    ];

    //relations
    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
