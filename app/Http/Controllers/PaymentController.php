<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Consultation;

class PaymentController extends Controller
{
    //
    public function confirmPayment(Request $request){
        $payment = Payment::find($request->paymentId);
        $consultation = Consultation::find($request->consultId);
        $response = [
            "payment" => $payment,
            "consultation" => $consultation,
        ];
        return redirect()->back()->with(['confirmPayment' => $response]);
    }

    public function approvePayment(Request $request){
        $consultation = Consultation::find($request->consultationId);
        $consultation->payment_id = $request->paymentId;
        $consultation->status = "Paid";
        $consultation->save();

        $response = [
            "message" => "Successfully paid Rp. 75.000 for the consultation!<br>You can start the Video Call Consultation now or later!",
            "consultation" => $consultation,
        ];

        return redirect()->back()->with(['success' => $response]);
    }
}
