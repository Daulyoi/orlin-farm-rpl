<?php

use Illuminate\Support\Facades\Auth;

if(!function_exists('currentPelanggan')){
    function currentPelanggan(){
        return Auth::guard('pelanggan')->user();
    }
    return null;
}
