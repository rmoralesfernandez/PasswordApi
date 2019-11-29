<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    protected $table = 'categories';
    protected $filliable = ['name', 'user_id'];

    public function add_category(Request $request)
    {
        $category = new Category();

        $category->name = $request->name;
        $category->save();
    }
}
