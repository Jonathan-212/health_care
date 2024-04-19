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

        $search = "Search";
        if($request->search != null && $request->search != 'Search'){
            $doctor = User::where("role", "doctor")->where("name", 'LIKE',"%$request->search%")->get();
            $search = $request->search ;
        }
        else{
            $doctor = User::where("role", "doctor")->get();
        }

        $speciality = null;
        if($request->speciality != null){
            $doctor = $doctor->where("specialist", $request->speciality);
            $speciality = $request->speciality;
        }

        return view("doctorList")
            ->with('doctors', $doctor)
            ->with('searchText', $search)
            ->with('specialityFilter', $speciality);
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

    public function checkStatusConsultation(Request $request){
        $consultation = Consultation::find($request->consultId);
        $consultation["doctor"] = User::find($consultation->doctor_id);

        if($consultation == null){
            return redirect()->back();
        }
        else if($consultation->status == "Unpaid"){
            return redirect()->back()->with(['paymentMethod' => $consultation]);
        }
        else if($consultation->status == "Paid"){
            return redirect()->back()->with(['startTheMeetingNow' => $consultation]);
        }
        else if($consultation->status == "Done"){
            return redirect()->back()->with(['done' => $consultation]);
        }
    }

    public function cancelConsultPopup(Request $request){
        $consultation = Consultation::find($request->consultId);
        $consultation["doctor"] = User::find($consultation->doctor_id);

        if($consultation == null){
            return redirect()->back();
        }

        return redirect()->back()->with(['cancelPopup' => $consultation]);
    }

    public function deleteConsultation(Request $request){
        $consultation = Consultation::find($request->consultId);
        $temp = User::find($consultation->doctor_id);
        $consultation->delete();

        return redirect()->back()->with(['cancelSuccess' => "Successfully cancelled consultation with ". $temp->name . "as a ". $temp->specialist . " speciality!"]);

    }



    // Doctor
    public function getMyConsultation(Request $request){
        $myconsultation = Consultation::where('doctor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        foreach($myconsultation as $my){
            $patient = User::find($my->patient_id);
            $my["patient"] = $patient;
        }

        $status = null;
        if($request->status != null){
            $myconsultation = $myconsultation->where("status", "$request->status");
            $status = $request->status;
        }

        return view ('consultationList')
            ->with('myconsultation', $myconsultation)
            ->with('filterStatus', $status);
    }
}
