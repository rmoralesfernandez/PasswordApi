<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = $request->data_token->email;
        $user = User::where('email', $email)->first();

        $category = new Category();
        $category_name = $request->name;
        $category_Searched = Category::where('user_id', $user->id)->first()->where('name', $category_name)->first();
        
        if(isset($category_Searched))
        {
            return response()->json([
                "message" => "La categoria ya existe"
            ], 401);
        }
        else
        {
            $category->add_category($request, $user);

            return response()->json([
                "message" => "nueva categoria"
            ], 200);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $email = $request->data_token->email;
        $user = User::where('email', $email)->first();

        $category = Category::where('user_id', $user->id)->get();

        return response()->json([
            "Categories" => $category
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $email = $request->data_token->email;
        $user = User::where('email', $email)->first();

        $category_LastName = $request->LastName;
        $category = Category::where('name', $category_LastName)->first()->where('user_id', $user->id)->first();

        if(isset($category))
        {
            $category->name = $request->NewName;
            $category->update();
            return response()->json([
                "message" => "se ha modificado la categoria"
            ], 200);
        }
        else
        {
            return response()->json([
                "message" => "La categoria no existe"
            ], 401);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $email = $request->data_token->email;
        $user = User::where('email', $email)->first();

        $category_name = $request->name;
        $category = Category::where('name', $category_name)->first()->where('user_id', $user->id)->first();

        if(isset($category))
        {
            $category->delete();

            return response()->json([
                "message" => 'el usuario ha sido eliminado'
            ], 200);
        }
        else
        {
            return response()->json([
                "message" => "La categoria no existe"
            ], 401);
        }
    }
}
