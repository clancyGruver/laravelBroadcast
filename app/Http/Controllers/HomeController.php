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
        $goods = DB::table('beletag_goods')
            ->select(DB::raw('beletag_categories.site_id as category_id, articul, `price` , description, beletag_goods.site_id as site_id'))
            ->orderBy(DB::raw('RAND()'))
            ->join('beletag_categories', 'beletag_categories.id', '=', 'beletag_goods.category_id')
            ->limit(100)
            ->get();

        return view('home',[
            'goods' => $goods,
        ]);
    }
}
