<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Consultation;
use App\Models\MedicineRecipe;
use App\Models\User;

class MedicineRecipeController extends Controller
{
    //
    public function addMedicine(Request $request){
        $validation = [
            'medicine' => 'required',
            'frequency' => 'required',
        ];

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()){
            return redirect()->back()->with(['failed' => 'validation'])->withErrors($validator);
        }

        $medicine = new MedicineRecipe();

        $medicine->consultation_id = $request->consultId;
        $medicine->medicine_name = $request->medicine;
        $medicine->frequency = $request->frequency;
        $medicine->save();

        return redirect()->back()->with(['success' => "Successfully added new medicine recipe"]);
    }

    public function deleteMedicinePopup(Request $request){
        $medicine = MedicineRecipe::find($request->medId);

        if($medicine == null){
            return redirect()->back();
        }

        return redirect()->back()->with(['deleteConfPopup' => $medicine]);

    }

    public function deleteMedicine(Request $request){
        $medicine = MedicineRecipe::find($request->medicineId);
        $temp = $medicine;
        $medicine->delete();

        return redirect()->back()->with(['success' => "Successfully deleted " . $temp->medicine_name . " from medicine recipe!"]);
    }

    public function viewMyMedicine(Request $request){
        $myconsultation = Consultation::where('patient_id', Auth::user()->id)->where('status', "Done")->orderBy('created_at', 'DESC')->get();
        foreach($myconsultation as $my){
            $doctor = User::find($my->doctor_id);
            $my["doctor"] = $doctor;
        }

        return view("medicineList")
            ->with('consultation', $myconsultation);
    }

    public function statusChangePopup(Request $request){
        $medicine = MedicineRecipe::find($request->medId);

        if($medicine == null){
            return redirect()->back();
        }

        return redirect()->back()->with(['statusChange' => $medicine]);
    }

    public function updateStatusMedicine(Request $request){
        $medicine = MedicineRecipe::find($request->medicineId);

        if($medicine == null){
            return redirect()->back();
        }
        $medicine->status = $request->status;
        $medicine->save();
        return redirect()->back()->with(['success' => "Successfully change the status!"]);
    }
}
