<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dzongkhag extends Model
{
    use HasFactory;
    protected $table='pl_tbldzongkhag';
    protected $primaryKey = 'dzoID';
}
