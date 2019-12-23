<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Things;
use Session;

class Conti extends Controller
{
    public function addThings(Request $request){
        $n = new Things(); 
        $n->title = $request->title; 
        $n->body = $request->body;
        $n->save(); 
        return $n;
    }

    public function new(Request $request){
    	Session::put("something", $request->name);
    	return null;
    }
    public function try(){
    	return [
    		"name"=>"Frimpong",
    		"age"=>32,
    		"Profession"=>"Billionaire"
    	];
    }
}
