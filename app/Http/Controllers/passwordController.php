<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Password;
use App\User;

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

        $email = $request->data_token->email;
        $user = User::where('email', $email)->first();

        $category_name = $request->category_name;
        $password_title = $request->title;
        $category = Category::where('user_id', $user->id)->where('name', $category_name)->first();

        if(!isset($category))
        {
            return response()->json([
                "message" => "La categoria no existe"
            ], 401);
        }
        else
        {
            $password_Searched = Password::where('category_id', $category->id)->where('title', $password_title)->first();
            if(!isset($password_Searched))
            {
                $password->add_password($request, $category->id);

                return response()->json([
                    "message" => "contraseña creada"
                ], 200);
            }
            else
            {
                return response()->json([
                    "message" => "La contraseña ya existe"
                ], 401);
            }
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

        $category_name = $request->name_category;
        $category = Category::where('name', $category_name)->first();
       // var_dump($category);exit;
       if ($category->user_id == $user->id)
       {
        $password = Password::where('category_id', $category->id)->get();

        foreach ($password as $key => $value)
        {
            return response()->json([
                "Passwords" => $password,
            ]);
        }
       }
       else
       {
        return response()->json([
            "message" => "no existe esa categoria"
        ]);
       }
        
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

        $password_LastName = $request->LastName;
        $categoryName = $request->categoryName;
        $category = Category::where('user_id',$user->id)->where('name',$categoryName)->first();
        
        if (isset($category)) {
            $password = Password::where('title', $password_LastName)->where('category_id', $category->id)->first();
           if (!isset($password)) {
                 return response()->json([
                     "Error" => "No existe la contraseña"
                    ], 401);
            }else{                
                
                $password->title = $request->NewName;
                $password->password = $request->Newpassword;
                //var_dump($password->title);exit;
                $password->update();
                return response()->json([
                    "message" => "Se ha modificado la contraseña"
                ], 201);
            }
        }else{
             return response()->json([
                 "message" => "No existe la categoria"
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

        $password_title = $request->name;
        $categoryName = $request->categoryName;
        $category = Category::where('user_id',$user->id)->where('name',$categoryName)->first();

        if (!isset($category)) {
            return response()->json([
                "message" => "No existe la categoria"
            ], 401);
        }else
        {
            $password = Password::where('title', $password_title)->where('category_id', $category->id)->first();
            if (!isset($password)) {
                return response()->json([
                    "message" => "No existe la contraseña"
                ], 401);
            }else{                
                $password->delete();
                return response()->json([
                    "message" => "La contraseña ha sido eliminada"
                ], 200);
        }
    }
}
}
