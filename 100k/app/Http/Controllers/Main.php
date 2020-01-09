<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tree; 
use App\TreeLocation; 
use Auth;
class Main extends Controller
{
  function saveScannedData(Request $request){ 
    $tree = Tree::where('id',$request->db_id)->first(); 
    $already_owned = Tree::where(['planted'=>1,'tree_id'=>$tree->id])->with('user')->first(); 
    if($tree && !$already_owned){ //if tree exists, and its not owned
      //update Tree 
      $tree->update(['user_id'=>Auth::user()->id, 'planted'=>1]); 
      //Create location for newly planted tree
      $loc = new TreeLocation(); 
      $loc->latitude = $request->lat; 
      $loc->longitude = $request->long; 
      $loc->tree_id = $request->tree_id; 
      $loc->save();
      return ['success'=>true, 'error'=>null,'data'=>null,'error_code'=>null];
    }
    else{
     return ['success'=>false, 'error'=>'cannot own this tree','data'=>$already_owned,'error_code'=>419];
    }
  }
  function getToken(){
      return csrf_token();
  }
  function returnUser(){
    $r = [ 
      'data'=>null, 
      'success'=>false, 
      'error' =>'user not found', 
      'error_code'=>404
    ];
    if(Auth::user()){
      $r['data'] = Auth::user();
      $r['error'] = null; 
      $r['error_code'] =null;
      $r['success'] = true;
      return $r;
    }
    return $r;
  }
}
