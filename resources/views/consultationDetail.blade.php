@extends('layout')

@section('title', 'Consultation with '. $consultation->patient->name)

@section('content')

    <div style="height:100%; width:calc(100% - 300px); display: flex; justify-content:center; align-items:center; overflow:hidden;">
        <div style="padding: 20px; width:300px; height:100%; overflow:hidden">
            <div class="shadowBox" style="width: 100%; height:100%; overflow:auto; display: flex; flex-direction:column; justify-content:space-evenly; align-items:center; ">
                <div style="width: 150px"><img src="{{Storage::url('images/'. $consultation->patient->image_url)}}" alt="" srcset="" style="width: 100%"></div>
                <div style="padding:0 30px">
                    <div style="font-weight: bold">Patients's Name</div>
                    <div style="padding-bottom: 30px">{{$consultation->patient->name}}</div>
                    <div style="font-weight: bold">Height/weight</div>
                    <div style="padding-bottom: 30px">{{$consultation->patient->height}}/{{$consultation->patient->weight}}</div>
                    <div style="font-weight: bold">Email</div>
                    <div style="padding-bottom: 30px">{{$consultation->patient->email}}</div>
                    <div style="font-weight: bold">Age</div>
                    <div style="padding-bottom: 30px">{{$consultation->patient->age()}}</div>
                </div>
            </div>
        </div>
        <div style="width:calc(100% - 300px); height:100%; overflow:hidden; padding: 20px 20px 20px 0;">
            <div class="shadowBox" style="width: 100%; height:100%; overflow:auto; padding:20px">
                <div style="font-size: 20px; font-weight:bold; ">Patient's Case/ Disease</div>
                <div style="padding-bottom: 20px;">{{$consultation->patient_note}}</div>

                <div style="font-size: 20px; font-weight:bold; ">Doctor's Note To The Patient</div>
                @if ($consultation->status == "Done")
                    <form action="/doctor/consultation" method="POST" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        @method('put')
                        <input type="text" value="{{$consultation->id}}" name="consultId" style="display: none">

                        <div class="form-floating mb-3">
                            <textarea name="doctor_note" class="form-control" id="doctor_note" placeholder="doctor_note" style="height: 100px; color:black">{{$consultation->doctor_note}}</textarea>
                            <label for="doctor_note">Write note for patient</label>
                        </div>
                        <button type="submit" class="btn btn-primary" style="border:none;">Submit</button>
                    </form>

                    <div style="font-size: 20px; font-weight:bold; padding-top:20px">Medicine</div>
                    <form action="/medicine" method="POST" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <input type="text" value="{{$consultation->id}}" name="consultId" style="display: none">

                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3" style="display: flex">
                                    <input type="text" name="medicine" class="form-control" id="medicine" placeholder="medicine" style="color:black">
                                    <label for="medicine">Medicine Name</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3" style="display: flex">
                                    <input type="text" name="frequency" class="form-control" id="frequency" placeholder="frequency" style="color:black">
                                    <label for="frequency">Frequency</label>
                                    <button type="submit" class="btn btn-primary" style="border:none; width:60px; font-size:30px">+</button>
                                </div>
                            </div>
                        </div>

                    </form>

                @elseif ($consultation->status == "Paid")
                <div style="color: red">Wait for the Patient to start the Video Call Consultation</div>

                @elseif ($consultation->status == "Unpaid")
                    <div style="color: red">The Patient has not paid yet. Wait for the Patient to Pay and Start the Consultation</div>
                @endif
            </div>
        </div>
    </div>


{{-- Pop Up --}}
@if ($message = Session::get('failed'))
    <div class="modal fade" tabindex="-1" id="failedMessageModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" style="color: rgb(216, 23, 23)">Failed</h5>
            <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
              @if ($message == 'validation')
              <p style="color: black">{{$errors->first()}}</p>
              @else
              <p style="color: black">{{$message}}</p>
              @endif
            </div>
        </div>
        </div>
    </div>
@endif

@if ($message = Session::get('success'))
<div class="modal fade" tabindex="-1" id="successMessageModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color: #154a80">Completed</h5>
          <button type="submit" id="closeSuccessMessageModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p style="color: black">{{$message}}</p>
        </div>
        <div class="modal-footer">
            <div class="btn btn-secondary" id="closeSuccessMessageModal2" data-bs-dismiss="modal" aria-label="Close" style="background-color:#154a80; border:none">Close</div>
        </div>
      </div>
    </div>
  </div>
@endif

<script>
    $(document).ready(function() {
        $('#failedMessageModal').modal('show');
    });
    $(document).ready(function() {
        $('#successMessageModal').modal('show');
    });
</script>

@endsection
