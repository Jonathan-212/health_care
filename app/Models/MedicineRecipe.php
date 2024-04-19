<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineRecipe extends Model
{
    use HasFactory;

    public function getConsultation(){
        return $this->belongsTo(HostnameGroup::class, 'consultation_id', 'id');
    }
}
