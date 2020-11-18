<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name', 'parent_id', 'description'];

    public function categories()
    {
    	return $this->belongTo('App\Models\Category', 'parent_id');
    }

    public function childrenCategories()
    {
    	return $this->hasMany('App\Models\Category','parent_id');
    }

    public function childrenRecursive()
    {
    	return $this->childrenCategories()->with('childrenRecursive');
    }
}
