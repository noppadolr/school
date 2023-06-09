<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $guarded=[];
    // protected $fillable=[
    //     'user_id',
    //     'category_name',

    // ];
    //กรณีใช้ eroquent
    public function user(){
        return $this->hasone(User::class,'id','user_id');

    }

    //end user function
}
