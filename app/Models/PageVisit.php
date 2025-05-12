<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    protected $fillable = ['page_key', 'date', 'visit_count'];

    protected $dates = ['date']; 

}
