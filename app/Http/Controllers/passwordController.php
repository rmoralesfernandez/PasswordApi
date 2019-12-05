<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Token;
use App\Category;
use App\Password;

class passwordController extends Controller
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
        $password = new Password();

        $category_name = $request->category_name;
        $category = Category::where('name', $category_name)->first();
        $password = Password::where('name', $category_name)->first();
        
        $password->add_password($request, $category);

        return response()->json([
            "message" => "contraseña creada"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $password_LastName = $request->LastName;
        $password = Password::where('title', $password_LastName)->first();

        $password->title = $request->NewName;
        $password->password = $request->Newpassword;
        $password->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $password_title = $request->name;
        $password = Password::where('title', $password_title)->first();

        $password->delete();

            return response()->json([
                "message" => 'la contrasena ha sido eliminado'
            ], 200);
    }
}
