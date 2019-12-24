<?php
/**
 * Created by PhpStorm.
 * User: liuxiaofeng
 * Date: 2019-03-16
 * Time: 16:50
 */

namespace App\Http\Controllers\Api;

use App\Models\ContractThings;
use App\Models\ThingMemories;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;

class ContractThingsController extends Controller
{
    public function memories(Request $request) {
        $meories = ThingMemories::query()
            ->where('contract_thing_id', $request->input('contract_thing_id'))
            ->with('user:id,name,avatar_url')
            ->orderBy('id', 'desc')
            ->get();

        return $this->success($meories);
    }


    public function createMemory(Request $request) {



        ThingMemories::query()->create([
            'contract_thing_id' => $request->contract_thing_id,
            'user_id' => auth()->user()->id,
            'images' => $request->input('images', '') ?? '',
            'content' => $request->input('content', '') ?? ''
        ]);

        ContractThings::query()->where('id', $request->contract_thing_id)->whereNull('finished_at')
            ->update(['finished_at' => Carbon::now()]);

        return $this->success();
    }

    public function deleteMemory(Request $request) {
        ThingMemories::query()->where('id', $request->id)->where('user_id', auth()->user()->id)->delete();


        return $this->success();
    }




}
