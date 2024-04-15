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

    public function getDoctorDetail(Request $request){
        $doctor = User::find($request->doctorId);

        if($doctor == null || $doctor->role == "patient"){
            return redirect('/consultation/doctor-list');
        }

        return view("doctorDetail")
            ->with('doctor', $doctor);
    }
}
