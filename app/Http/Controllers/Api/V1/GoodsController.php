<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\Goods;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    public function index(Request $request, $id)
    {
        $goods =  Goods::where('category_id','=',$id)->get();

        /*$goods = DB::table('beletag_good_params')
            ->select('date', 'good_id', 'sum( `change_prev_day` ) as sold')
            ->where('change_prev_day', '<', 0)
            ->groupBy('good_id', 'date')
            ->orderBy('date','DESC')
            ->limit(30)
            ->get();*/
        $goods = DB::table('beletag_good_params')
            ->select(DB::raw('date, `good_id` , sum( `change_prev_day` ) AS sold'))
            ->where('change_prev_day', '<', 0)
            ->groupBy('good_id', 'date')
            ->orderBy('date','DESC')
            ->limit(30)
            ->get();
        /*
        SELECT date, `good_id` , sum( `change_prev_day` ) AS sold
        FROM `beletag_good_params`
        WHERE `change_prev_day` <0
        GROUP BY good_id, date
        ORDER BY date DESC
        LIMIT 0 , 30
        */
        return response()->json($goods);
    }

    public function show($id)
    {
        return Goods::findOrFail($id);
    }
}
