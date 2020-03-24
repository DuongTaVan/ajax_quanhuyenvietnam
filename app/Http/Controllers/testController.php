<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class testController extends Controller
{
    public function test(){
    	$tinhthanh = DB::table('tbl_quanhuyen')->where('type',0)->get();
    	return view('test',compact('tinhthanh'));
    }
    public function ajax(Request $Request){
    	$parentID = $Request->parent;
    	
    	//$type = $Request->type;
    	if($parentID)
    	{
    		$locations = DB::table('tbl_quanhuyen')->where('parent_id',$parentID)->get();
    		return response(['data'=>$locations]);
    	}
    }
}
