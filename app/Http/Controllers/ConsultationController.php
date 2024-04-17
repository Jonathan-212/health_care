<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Consultation;
use App\Models\User;
use App\Models\Payment;

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

        $payment = Payment::all();

        return view("doctorDetail")
            ->with('doctor', $doctor)
            ->with('payment', $payment);
    }

    public function createConsultation(Request $request){
        $validation = [
            'patient_note' => 'required',
        ];

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()){
            return redirect()->back()->with(['failed' => 'validation'])->withErrors($validator);
        }

        $consultation = new Consultation();
        $consultation->patient_id = Auth::user()->id;
        $consultation->doctor_id = $request->doctor_id;
        $consultation->patient_note = $request->patient_note;

        $consultation->save();

        return redirect()->back()->with(['paymentMethod' => $consultation]);
    }

    public function startConsultation(Request $request){
        $consultation = Consultation::find($request->consultId);
        if(Auth::user()->id != $consultation->patient_id){
            return redirect()->back();
        }

        $doctor = User::find($consultation->doctor_id);
        $consultation->status = "Done";
        $consultation->save();
        return view('videoCallMockUp')
            ->with("consultation", $consultation)
            ->with("doctor", $doctor);
    }
}
