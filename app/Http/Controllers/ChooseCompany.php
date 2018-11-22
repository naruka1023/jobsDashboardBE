<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
class ChooseCompany extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyInfoArray = array();
        // $this->middleware('auth');
        $rawData = company::all();
        $index = 0;
        foreach($rawData as $r){
            $block = new \stdClass;
            $block->name = $r->companyName;
            $block->id = $r->cID;
            $companyInfoArray = array_merge($companyInfoArray, array('block'. $index => $block));
            $index++;
        }
        return view('choosecompany', ['info' => $companyInfoArray]);
    }
}
