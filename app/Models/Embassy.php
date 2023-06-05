<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embassy extends Model
{
    use HasFactory;

    protected $table = 'pl_tblembassy';
    protected $primaryKey = 'embassyID';

}
