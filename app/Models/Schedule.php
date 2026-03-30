<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['title', 'schedule_date', 'schedule_time', 'description'];
}
