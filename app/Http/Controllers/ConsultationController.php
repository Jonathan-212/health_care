<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Consultation;
use App\Models\User;

class ConsultationController extends Controller
{
    //
    public function getDoctorList(Request $request){
        $doctor = User::where("role", "doctor")->get();

        return view("doctorList")
            ->with('doctors', $doctor);
    }
}
