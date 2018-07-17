<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\Goods;
use App\Good_params;
use Illuminate\Support\Facades\DB;

class Good_paramsController extends Controller
{
    public function index(Request $request)
    {
        $categories = $request->categories;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $items_count = $request->items_count;
        $goods =  DB::table('beletag_good_params')
            ->select(DB::raw('sum(`change_prev_day`) as sales, `good_id`, beletag_goods.articul, beletag_goods.description, beletag_goods.site_id, beletag_goods.price, beletag_goods.prev_price'))
            ->join('beletag_goods', 'beletag_goods.id', '=', 'beletag_good_params.good_id')
            ->where('change_prev_day', '<', 0)
            ->groupBy('good_id','articul','description','site_id','price', 'prev_price')
            ->orderBy('sales')
            ->limit($items_count);
        if($categories)
            $goods = $goods->whereIn('beletag_goods.category_id',$categories);
        else{
            $arr = [2, 21, 22, 19, 26, 17, 5, 1, 6, 8, 28, 10, 30, 11, 13, 14, 8, 26, 3];
            $goods = $goods->whereIn('beletag_goods.category_id',$arr);
        }
        if($start_date)
            $goods = $goods->where('beletag_good_params.date','>=',$start_date);
        if($end_date)
            $goods = $goods->where('beletag_good_params.date','<=',$end_date);
        $goods = $goods->get();
        return response()->json($goods);
    }

    public function one(Request $request, $id)
    {
        $type = $request->radio;
        $goods =  DB::table('beletag_good_params');
        switch ($type) {
            case 'color':
                $goods = $goods->select(DB::raw('color_name, sum(`change_prev_day`) AS sold'))
                                ->groupBy('color_name');
                break;
            case 'size':
                $goods = $goods->select(DB::raw('size, sum(`change_prev_day`) AS sold'))
                                ->groupBy('size');
                break;
            case 'colorsize':
                $goods = $goods->select(DB::raw('color_name, size, sum(`change_prev_day`) AS sold'))
                                ->groupBy('color_name', 'size');
                break;
        }
        $goods = $goods->where('good_id',$id)
                        ->where('change_prev_day', '<', 0)
                        ->get();
        /*
        SELECT color_name, sum(`change_prev_day`) AS sold
        FROM `beletag_good_params` 
        WHERE `good_id` = 12
        AND `change_prev_day` < 0
        group by color_name;

        SELECT size, sum(`change_prev_day`) AS sold
        FROM `beletag_good_params` 
        WHERE `good_id` = 12
        AND `change_prev_day` < 0
        group by size;

        SELECT color_name, size, sum(`change_prev_day`) AS sold
        FROM `beletag_good_params` 
        WHERE `good_id` = 12
        AND `change_prev_day` < 0
        group by color_name, size;
        */
        return response()->json($goods);
    }
}
