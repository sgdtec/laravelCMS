<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Page;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
       
    public function index(request $request) {

        $visitsCount  = 0;
        $onLineCount  = 0;
        $pageCount    = 0;
        $userCount    = 0;
        $dateInterVal = intval($request->input('interval', 30));

        //Verifico se o usuário não modificou o select
        if($dateInterVal > 120) {
            $dateInterVal = 120;
        }

        //Count Visitors
        $dateInterval = date('Y-m-d H:i:s', strtotime('-'.$dateInterVal.' days'));
        $visitsCount = Visitor::where('date_access', '>=', $dateInterval)->count();
        
        //Contagem de User OnLine
        $userCount = User::count();

        //Count Pages
        $pageCount = Page::count();

        //User OnLine
        $dataLimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onLineList = Visitor::where('date_access', '>=', $dataLimit)
                    ->select('ip')
                    ->groupBy('ip')
                    ->get();
        $onLineCount = count($onLineList);

        //Count PagePie
        $pagePie = [];
        $visitsAll = Visitor::selectRaw('page, count(page) as totalPage')
                   ->where('date_access', '>=', $dateInterval)
                   ->groupBy('page')
                   ->get();

        foreach($visitsAll as $visit) {
          $pagePie[ $visit['page'] ] = intval($visit['totalPage']);
        } 

        $pageLabels = json_encode( array_keys($pagePie) );
        $pageValues = json_encode( array_values($pagePie) );


        return view('admin.painel', [
            'visitsCount'  => $visitsCount,
            'onLineCount'  => $onLineCount,
            'pageCount'    => $pageCount,
            'userCount'    => $userCount,
            'pageLabels'   => $pageLabels,
            'pageValues'   => $pageValues,
            'dateInterVal' => $dateInterVal
        ]); 
    }
}