<?php
namespace App\Bls\Admin\Model;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = 'users';
    protected $dates = ['created_at', 'updated_at'];
}