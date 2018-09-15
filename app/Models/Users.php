<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Users extends Model{
    //设置表名
    const TABLE_NAME="users";
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

}