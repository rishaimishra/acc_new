<?php

namespace App\Models\Complaint;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complaintReceivedByModel extends Model
{
    use HasFactory;
    protected $table = 'cr_tblcomplaintreceivedby';
    protected $primaryKey = 'complaintReceivedByID';
}
