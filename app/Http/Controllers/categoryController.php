<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Helpers\Token;
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
        //print($request->email->email);exit;
        $email = $request->data_token->email;
        // $token = new Token();
        // $data = $token->decode($token_header);

        //$user = new User();
        $user = User::where('email', $email)->first();

        
        //var_dump($user);exit;
        $category = new Category();
        
        $category->add_category($request, $user);

        return response()->json([
            "message" => "nueva categoria"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCategory($id)
    {
        $category = Category::all();
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
        $category_LastName = $request->LastName;
        $category = Category::where('name', $category_LastName)->first();

        $category->name = $request->NewName;
        $category->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category_name = $request->name;
        $category = Category::where('name', $category_name)->first();

        $category->delete();

            return response()->json([
                "message" => 'el usuario ha sido eliminado'
            ], 200);
    }
}
