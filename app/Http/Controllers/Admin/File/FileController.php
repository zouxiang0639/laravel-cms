<?php
namespace App\Http\Controllers\Admin\File;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class FileController extends BaseController
{

    public function store(Request $request)
    {
        echo '{
  "code": 0
  ,"msg": ""
  ,"data": {
    "src": "http://mediapic.quanjing.com/Magazine/GroupCover/high/38026.jpg"
  }
}     ';
    }

}
