<?php
namespace app\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model{

    protected $table = "users";
    protected $guarded =[];
    public   $timestamps = false;
}