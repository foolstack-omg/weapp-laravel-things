<?php
/**
 * Created by PhpStorm.
 * User: liuxiaofeng
 * Date: 2019-03-16
 * Time: 16:50
 */

namespace App\Http\Controllers\Api;


use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function store(Request $request, ImageUploadHandler $uploader)
    {
        $result = $uploader->save($request->image, 'memories', '');
        if($request) {
            return $this->success($result['path']);
        } else {
            return $this->failed('图片上传失败');
        }


    }

}
