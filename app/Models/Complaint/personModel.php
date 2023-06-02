<?php

namespace App\Models\Complaint;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personModel extends Model
{
    use HasFactory;
    protected $table = 'tblperson';
    protected $primaryKey = 'personID';

    public function genderRelation()
    {
        return $this->hasOne('App\Models\Complaint\GenderModel', 'id', 'gender');
    }
}
