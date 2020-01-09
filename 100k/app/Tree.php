<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\TreeLocation;
class Tree extends Model
{
  protected $fillable = ['planted','user_id'];
    public function user(){
      return $this->belongsTo(User::class);
    }
    public function location(){
      return $this->hasOne(TreeLocation::class);
    }
}
