<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use Illuminate\Http\Request;

class Password extends Model
{
    protected $table = 'passwords';
    protected $filliable = ['title', 'password', 'category_id'];

    public function add_password(Request $request, $category)
    {
        $password = new Password();

		// var_dump($request->title);exit;
        $password->title = $request->title;
       	// var_dump($password->title);exit;
        $password->password = $request->password;
        $password->category_id = $category->id;
        $password->save();
    }
}
