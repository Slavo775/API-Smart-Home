<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function Test(Request $request){
        return response()->json(['get' => $request->get('testing'), 'post' => $request->post('testPost')]);
    }

    //
}
