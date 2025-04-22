<?php

use App\Models\Pelanggan;

if(!function_exists('currentPelanggan')){
    function currentPelanggan(){
        $id = session('pelanggan_id');
        return Pelanggan::find($id);
    }
    return null;
}
