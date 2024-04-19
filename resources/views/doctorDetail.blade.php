@extends('layout')

@section('title', $doctor->name)

@section('content')

    <div style="height:100%; width:calc(100% - 300px); display: flex; justify-content:center; align-items:center; overflow:hidden;">
        <div style="padding: 20px; width:300px; height:100%; overflow:hidden">
            <div class="shadowBox" style="width: 100%; height:100%; overflow:auto; display: flex; flex-direction:column; justify-content:space-evenly; align-items:center; ">
                <div style="width: 150px"><img src="{{Storage::url('images/'. $doctor->image_url)}}" alt="" srcset="" style="width: 100%"></div>
                <div style="padding:0 30px">
                    <div style="font-weight: bold">Doctor's Name</div>
                    <div style="padding-bottom: 30px">{{$doctor->name}}</div>
                    <div style="font-weight: bold">Speciality</div>
                    <div style="padding-bottom: 30px">{{$doctor->specialist}}</div>
                    <div style="font-weight: bold">University</div>
                    <div style="padding-bottom: 30px">{{$doctor->doctor_university}}</div>
                    <div style="font-weight: bold">Age</div>
                    <div style="padding-bottom: 30px">{{$doctor->age()}}</div>
                </div>
            </div>
        </div>
        <div style="width:calc(100% - 300px); height:100%; overflow:hidden">
            <div style="padding: 20px 20px 20px 0; width:100%; height:65%; overflow:hidden">
                <div class="shadowBox" style="width: 100%; height:100%; overflow:auto">
                    <div style="font-weight:bold; font-size:20px; padding: 10px;">About {{$doctor->name}}</div>
                    <div style="padding: 10px; text-align:justify">{{$doctor->about_doctor}}</div>
                </div>
            </div>
            <div style="padding: 0 20px 20px 0; width:100%; height:35%; overflow:auto">
                <div class="shadowBox" style="width: 100%; height:100%; position: relative;">
                    <form action="/consultation" method="POST" enctype="multipart/form-data" style="padding:10px; height:100%">
                        {{ csrf_field() }}
                        <input type="text" name="doctor_id" style="display: none" value="{{$doctor->id}}">

                        <div class="form-floating mb-3" style="height:100%">
                            <textarea name="patient_note" class="form-control" id="patient_note" placeholder="patient_note" style="height: calc(100% - 50px); color:black"></textarea>
                            <label for="patient_note">Your Disease / Case</label>
                        </div>
                        <button type="submit" class="btn btn-primary" style="border:none; position: absolute; bottom: 20px; right:30px;">Consult Now For Rp. 75.000</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


{{-- Pop Up --}}
@if ($message = Session::get('failed'))
    <div class="modal fade" tabindex="-1" id="failedMessageModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" style="color: rgb(216, 23, 23)">Registration Failed</h5>
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
            <p style="color: black">{!! $message["message"] !!}</p>
        </div>
        <div class="modal-footer">
            <a href="/consultation/start/{{$message["consultation"]->id}}" style="text-decoration: none"><div class="btn btn-secondary" style="background-color:red; border:none; color:white">Start Now</div></a>
            <div class="btn btn-secondary" id="closeSuccessMessageModal2" data-bs-dismiss="modal" aria-label="Close" style="background-color:#154a80; border:none">Close</div>
        </div>
      </div>
    </div>
  </div>
@endif

@if ($message = Session::get('paymentMethod'))
    <div id="paymentOption" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: #142474">Payment</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/payment/{{$message->id}}" method="GET">

            <div class="modal-body" style="text-align:center">
                <div style="color: black; font-size:20px; padding-bottom:15px">
                    Total: <span style="color: green">Rp. 75.000</span>
                </div>

                <select class="form-select" name="paymentId" aria-label="Default select example">
                    @foreach ($payment as $p)
                        <option value="{{$p->id}}">{{$p->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"  data-dismiss="modal" aria-label="Close" style="background-color:#154a80; border:none">Pay</button>
                <div class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close" style="background-color:rgb(216, 23, 23); border:none">Cancel</div>
            </div>
            </form>
          </div>
        </div>
    </div>
@endif

@if ($message = Session::get('confirmPayment'))
    <div id="confirmPayment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: #142474">Payment</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/payment" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

            <div class="modal-body" style="text-align:center">
                <input type="text" value="{{$message["consultation"]->id}}" name="consultationId" style="display:none" >
                <input type="text" value="{{$message["payment"]->id}}" name="paymentId" style="display:none" >

                <div style="color: black; font-size:20px; padding-bottom:20px">
                    Total: <span style="color: green">Rp. 75.000</span>
                </div>

                <div style="color: #142474; font-size:23px;">
                    {{$message["payment"]->name}}: <span style="color: black">{{$message["payment"]->number}}</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"  data-dismiss="modal" aria-label="Close" style="background-color:#154a80; border:none">Pay</button>
                <div class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close" style="background-color:rgb(216, 23, 23); border:none">Cancel</div>
            </div>
            </form>
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
    $(document).ready(function() {
        $('#paymentOption').modal('show');
    });
    $(document).ready(function() {
        $('#confirmPayment').modal('show');
    });
</script>

@endsection
