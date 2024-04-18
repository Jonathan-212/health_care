<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\HealthyRecord;

class HealthyRecordController extends Controller
{
    //
    public function getHealthyRecord(Request $request){
        $record = HealthyRecord::where('patient_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('healthyRecord')
            ->with('record', $record);
    }
    public function createHealthyRecord(Request $request){
        $validation = [
            'heart_rate' => 'required | numeric',
            'sistole' => 'required | numeric',
            'diastole' => 'required | numeric',
        ];

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()){
            return redirect()->back()->with(['failed' => 'validation'])->withErrors($validator);
        }

        $record = new HealthyRecord();
        $record->patient_id = Auth::user()->id;
        $record->heart_rate = $request->heart_rate;
        $record->sistole_blood_pressure = $request->sistole;
        $record->diastole_blood_pressure = $request->diastole;
        $record->save();

        return redirect()->back()->with(['success' => 'Heart Rate = ' . $record->heart_rate . '<br>Blood Pressure = '. $record->sistole_blood_pressure . '/'. $record->diastole_blood_pressure . '<br>Successfully Recorded Your Healthy Detail. Keep Healthy!']);;
    }

    public function deleteRecordPopup(Request $request){
        $record = HealthyRecord::find($request->recordId);

        if($record == null){
            return redirect()->back();
        }
        else{
            return redirect()->back()->with(['deleteConfPopup' => $record]);
        }
    }

    public function deleteRecord(Request $request){
        $record = HealthyRecord::find($request->recordId);
        $temp= $record;

        $record->delete();

        return redirect()->back()->with(['success' => 'Heart Rate = ' . $temp->heart_rate . '<br>Blood Pressure = '. $temp->sistole_blood_pressure . '/'. $temp->diastole_blood_pressure . '<br>on '. Date('d M Y, H:i:s', strtotime($temp->created_at)) . '<br><span style="font-size: 20px; font-weight:bolder">Was successfully deleted!</span>']);;

    }
}
