<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug'
    ];

    

    //relations
    public function forms() {
        return $this->hasMany(Form::class);
    }

    public function formSubmissions () {
        return $this->hasMany(FormSubmission::class);
    }
}
