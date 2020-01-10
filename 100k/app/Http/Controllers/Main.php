<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tree; 
use App\TreeLocation; 
use Auth;
class Main extends Controller
{

  
  function countPlanted(){
    return Count(Tree::where('planted',1)->get());
  }
  function testFactory(){


    $trees = Tree::where('planted',0)->get();
  
    foreach ($trees as  $v) {
      $v->update(['planted'=>1]);
    }
  
    return "DONE!";
    $coords = [
      [5.54433349,-0.19030127,
     ],
     [5.93069262,-0.38927065,
    ],
    [6.10100159,-0.81645119,
    ],
    [5.15942252,-0.0515414],
    
    [6.10679476,-0.16223444,
    ],
    [5.43869099,-0.75245711
    ],
    [5.22877951,-0.08419322
    ],
    [4.95559972,-0.15409779,
    ],
    [5.73379957,0.21942553
    ],
    [5.8121865,-0.44248025
    ],
    [6.11684268,-0.3325233
    ], 
    [5.55866075,0.0537515,
    ],
    [6.1460998,0.09386335
    ],
    [5.9949507,-0.45734483
    ],
    [4.92072777,-0.22854422
    ]
    
  ];
  $trees = [
    'Downy Serviceberry',
    'Canaertii Eastern Redcedar',
    'Green Mountain Sugar Maple',
    'Siebold Viburnum',
    'Burgundy Saucer Magnolia',
    'Umbrella Pine',
    'Weeping Eastern Hemlock',
    'English Yew',
    'Canadian Gold Giant Arborvitae',
    'Calocarpa Zumi Crabapple',
    'Superform Norway Maple',
    'Silver Maple',
    'Pekin Willow',
    'Burgundy Saucer Magnolia',
    'Fastigiata Maidenhair Tree'
  ]; 
  
  $s =   [ 'Casuarina spp',
  'Vitex negundoHeterophylla',
  'Ptelea trifoliata',
  'Pyrus calleryana Redspire',
  'Ptelea trifoliata',
  'Acer platanoides Almira',
  'Cupressus sempervirens Glauca',
  'Pinus parviflora Glauca',
  'Magnolia kobus var',
  'Acer platanoides Erectum',
  'Picea pungens Iseli Foxtail',
  'Acer saccharinum Skinneri',
  'Magnolia grandiflora Samuel Sommer',
  'Ulmus parvifolia Sempervirens',
  'Liriodendron tulipifera'
  ];
  
  
  for ($i=0; $i < count($trees) ; $i++) { 
  $user_id = rand(1,7);
  $t = new Tree(); 
  $t->name = $trees[$i]; 
  $t->species = $s[$i];
  $t->tree_number = $i + 1;
  $t->user_id = $user_id;
  $t->save();
  $loc = new TreeLocation(); 
  $loc->latitude = $coords[$i][0]; 
  $loc->longitude = $coords[$i][1];
  $loc->tree_id = $t->id;
  $loc->save();
  }
  
  
  
  return 'BOOM ALL DONE';
  
  
  
  
  
  
  
  }
  function collectTreeData(){
    $all_planted = Tree::where('planted',1)->with('location','user')->get();
    if(Auth::user()){
      $user_trees = Tree::where('user_id',Auth::user()->id)->with('user','location')->get();
      return ['user_trees'=>$user_trees,'all_planted'=>$all_planted];
    }
    return ['user_trees'=>[],'all_planted'=>$all_planted];
  }
  function saveScannedData(Request $request){ 
    $tree = Tree::where('id',$request->db_id)->first(); 
    $already_owned = Tree::where(['planted'=>1,'id'=>$request->db_id])->with('user')->first(); 
    if($tree && !$already_owned){ //if tree exists, and its not owned
      //update Tree 
      $tree->update(['user_id'=>Auth::user()->id, 'planted'=>1]); 
      //Create location for newly planted tree
      $loc = new TreeLocation(); 
      $loc->latitude = $request->lat; 
      $loc->longitude = $request->long; 
      $loc->tree_id = $request->db_id; 
      $loc->save();
      return [
        'success'=>true, 
        'error'=>null,
        'data'=>null,
        'error_code'=>null
      ];
    }
    else{
     return [
       'success'=>false,
        'error'=>'cannot own this tree',
        'data'=>$already_owned->user,
        'error_code'=>419
      ];
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


