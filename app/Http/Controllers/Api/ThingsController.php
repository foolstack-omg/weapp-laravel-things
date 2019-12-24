<?php
/**
 * Created by PhpStorm.
 * User: liuxiaofeng
 * Date: 2019-03-16
 * Time: 16:50
 */

namespace App\Http\Controllers\Api;


use App\Models\Things;

class ThingsController extends Controller
{
    public function index()
    {
        return $this->success(Things::query()->inRandomOrder()->limit(100)->get(['en_title', 'zh_title']));
    }


}
