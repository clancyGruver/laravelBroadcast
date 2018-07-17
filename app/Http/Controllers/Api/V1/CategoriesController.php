<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index()
    {
        //2, 21, 22, 19, 26, 17, 5, 1, 6, 8, 28, 10, 30, 11, 13, 14, 8, 26, 3
        $arr = [2, 21, 22, 19, 26, 17, 5, 1, 6, 8, 28, 10, 30, 11, 13, 14, 8, 26, 3];
        return Categories::whereIn('id', $arr)->get();
    }

    public function show($id)
    {
        $goods = DB::table('beletag_good_params')
            ->select(DB::raw('sum( `change_prev_day` ) AS sold, min(date) as min_date'))
            ->whereRaw('good_id in (SELECT id FROM `beletag_goods` WHERE category_id = ?)', $id)
            ->where('change_prev_day', '<', 0)
            ->get();
        /*
            SELECT sum(`change_prev_day`) AS sold
            FROM `beletag_good_params` 
            WHERE `good_id` in (SELECT id FROM `beletag_goods` WHERE category_id = 1)
            AND `change_prev_day` < 0
        */
        return response()->json($goods[0]);
    }
}
