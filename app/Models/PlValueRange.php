<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlValueRange extends Model
{
    use HasFactory;
    protected $table = 'ce_pltblpvaluesrange';
    protected $primaryKey = 'pValueRangeID';
}
