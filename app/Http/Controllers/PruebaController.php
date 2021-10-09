<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pokemon;

class PruebaController extends Controller
{
    public function test(Request $request){
        // $test = $request->get("data");
        $test = new Pokemon("Pikachu");
        return ["mmlo" => $test->pokemon];
        // return view('index', ["data" => ["a"=> 1, "b"=> 2]]);
    }
}
