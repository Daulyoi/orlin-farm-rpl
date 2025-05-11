<?php

use App\Models\Pelanggan;

if(!function_exists('currentPelanggan')){
    function currentPelanggan(){
        return Auth::guard('pelanggan')->user();
    }
    return null;
}
