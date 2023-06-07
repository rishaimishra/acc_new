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

    public function complaintreceivedByRelation()
    {
        return $this->hasMany('App\Models\Complaint\complaintReceivedByModel', 'complaintID', 'complaintID');
    }

     public function complaintProcessingTypeRelation()
    {
        return $this->hasOne('App\Models\Complaint\pl_complaintProcessingType_Model', 'complaintProcessingTypeID', 'complaintProcessingTypeID');
    }

    public function dzongkhagrelation()
    {
        return $this->hasOne('App\Models\Dzongkhag', 'dzoID', 'placeOfOccurrenceDzongkhagID');
    }


    public function gewogrelation()
    {
        return $this->hasOne('App\Models\Gewog', 'gewogID', 'placeOfOccurrenceGewogID');
    }

    public function villagerelation()
    {
        return $this->hasOne('App\Models\Village', 'villageID', 'placeOfOccurrenceVillageID');
    }

    
}
