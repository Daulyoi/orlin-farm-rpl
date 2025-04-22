<?php

namespace App\Http\Controllers;

use App\Models\HewanQurban;

class HewanQurbanController extends Controller
{
    public function showAll(){
        $hewanQurbans = HewanQurban::all();
        return view('home', ['hewanQurbans' => $hewanQurbans]);
    }

    public function showOne($id){
        $hewanQurban = HewanQurban::find($id);
        return view('hewanQurban.detail', ['hewanQurban' => $hewanQurban]);
    }
}
