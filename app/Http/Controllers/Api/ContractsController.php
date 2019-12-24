<?php
/**
 * Created by PhpStorm.
 * User: liuxiaofeng
 * Date: 2019-03-16
 * Time: 16:50
 */

namespace App\Http\Controllers\Api;


use App\Models\Contracts;
use App\Models\ContractThings;
use App\Models\Things;
use DB;
use Exception;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    public function join(Request $request)
    {
        if(Contracts::query()->where(function($query) use ($request){
            $query->where('a_user_id', $request->a_user_id)->orWhere('b_user_id', $request->a_user_id);
        })->orWhere(function($query) use ($request) {
            $query->where('a_user_id', auth()->user()->id)->orWhere('b_user_id', auth()->user()->id);
        })->exists()) {
            return $this->failed('你或他已加入别人的约定了~');
        }

        try{
            DB::transaction(function() use ($request){
                $contract = Contracts::query()->create([
                    'a_user_id' => $request->a_user_id,
                    'b_user_id' => auth()->user()->id,
                ]);
                $things_id = Things::query()->inRandomOrder()->limit(100)->pluck('id');
                foreach ($things_id as $id) {
                    ContractThings::query()->create([
                        'contract_id' => $contract->id,
                        'thing_id' => $id,
                    ]);
                }
            });
            return $this->success();
        } catch (Exception $e) {
            return $this->failed('加入失败');
        }
    }

    public function things() {
        $contract = Contracts::query()
            ->where('a_user_id', auth()->user()->id)
            ->orWhere('b_user_id', auth()->user()->id)
            ->with('a_user:id,avatar_url,name')
            ->with('b_user:id,avatar_url,name')
            ->with('things:id,finished_at')
            ->with('things.thing:id,en_title,zh_title')
            ->orderBy('id', 'asc')
            ->first();

        return $this->success($contract);
    }


}
