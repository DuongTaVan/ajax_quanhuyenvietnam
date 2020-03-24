<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class QuanhuyenController extends Controller
{
    public function addQuanHuyen(){
    	$json = file_get_contents(storage_path('tree.json'));
        $objs = json_decode($json,true);
        //dd($objs);
        //   insert thanh pho
        foreach ($objs as $thanh_pho) {
            $line_tp = '["code" => "'.$thanh_pho['code'].'","name" => "'.$thanh_pho['name'].'","parent_id" => 0,"type" => 0],';

            Storage::disk('local')->append('city.txt', $line_tp);
        }

         //  insert quan huyen
        foreach ($objs as $thanh_pho){
            foreach ($thanh_pho['quan-huyen'] as $quan_huyen) {
                $line_qh = '["code" => "'.$quan_huyen['code'].'","name" => "'.$quan_huyen['name'].'","parent_id" => "'.$quan_huyen['parent_code'].'","type" => 1],';

                Storage::disk('local')->append('city.txt', $line_qh);
            }
        }

        //    insert xa phuong
        foreach ($objs as $thanh_pho){
            foreach ($thanh_pho['quan-huyen'] as $quan_huyen) {
                foreach ($quan_huyen['xa-phuong'] as $xa_phuong) {
                    $line_xp = '["code" => "'.$xa_phuong['code'].'","name" => "'.$xa_phuong['name'].'","parent_id" => "'.$xa_phuong['parent_code'].'","type" => 2],';

                    Storage::disk('local')->append('city.txt', $line_xp);
                }
            }
        }

        dd("Finished adding data in table");
    }
}
