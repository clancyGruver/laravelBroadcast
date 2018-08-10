<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\Goods;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$goods = DB::table('beletag_goods')
            ->select(DB::raw('beletag_goods.id as good_id, beletag_categories.site_id as category_id, articul, `price` , description, beletag_goods.site_id as site_id'))
            ->orderBy(DB::raw('RAND()'))
            ->join('beletag_categories', 'beletag_categories.id', '=', 'beletag_goods.category_id')
            ->limit(50)
            ->get();*/

        $last_date = DB::table('beletag_good_params')
                   ->select(DB::raw('MAX(date) as last_date'))
                   ->first();
        $last_date = $last_date->last_date;

        $goods = DB::table('beletag_good_params')
                    ->select(
                        DB::raw('
                            beletag_good_params.good_id, 
                            SUM(`change_prev_day`) * -1 as change_prev_day, 
                            articul, 
                            `price`, 
                            description, 
                            beletag_goods.site_id as site_id, 
                            beletag_categories.site_id as category_id
                        ')
                    )
                    ->join('beletag_goods', 'beletag_goods.id', '=', 'beletag_good_params.good_id')
                    ->join('beletag_categories', 'beletag_categories.id', '=', 'beletag_goods.category_id')
                    ->groupBy('good_id','articul','price','description','beletag_goods.site_id','beletag_categories.site_id')
                    ->where('date',$last_date)
                    ->orderBy('change_prev_day','DESC')
                    ->limit(100)
                    ->get();

        return view('home',[
            'goods' => $goods,
        ]);
    }
}
