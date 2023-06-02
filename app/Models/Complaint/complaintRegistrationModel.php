<?php

namespace App\Models\Complaint;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complaintRegistrationModel extends Model
{
    use HasFactory;
    protected $table = 'cr_tblcomplaintregistration';
    protected $primaryKey = 'complaintID';

    public function complaintmoderelation()
    {
        return $this->hasOne('App\Models\Complaint\complaintModeModel', 'complaintmodeID', 'modeID');
    }


    public function complaintTyperelation()
    {
        return $this->hasOne('App\Models\Complaint\complaintTypeModel', 'id', 'complainantType');
    }
}
