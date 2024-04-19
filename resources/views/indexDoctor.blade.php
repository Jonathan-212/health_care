@extends('layout')

@section('title', 'Dashboard')

@section('content')

<div style="height:100%; width:calc(100% - 300px); display: flex; justify-content:center; align-items:center; overflow:hidden;">
    <div style="padding: 20px; width:300px; height:100%; overflow:hidden">
        <div class="shadowBox" style="width: 100%; height:100%; display: flex; flex-direction:column; justify-content:space-evenly; align-items:center; ">
            <div style="width: 150px"><img src="{{Storage::url('images/'. Auth::user()->image_url)}}" alt="" srcset="" style="width: 100%"></div>
            <div style="padding:0 30px">
                <div style="font-weight: bold">Name</div>
                <div style="padding-bottom: 20px">{{Auth::user()->name}}</div>
                <div style="font-weight: bold">Speciality</div>
                <div style="padding-bottom: 20px">{{Auth::user()->specialist}}</div>
                <div style="font-weight: bold">Email</div>
                <div style="padding-bottom: 20px">{{Auth::user()->email}}</div>
                <div style="font-weight: bold">University</div>
                <div style="padding-bottom: 20px">{{Auth::user()->doctor_university}}</div>
                <div style="font-weight: bold">Age</div>
                <div style="padding-bottom: 20px">{{Auth::user()->age()}}</div>
            </div>
        </div>
    </div>
    <div style="width:calc(100% - 300px); height:100%; overflow:hidden; padding:20px 20px 20px 0">
        <div class="shadowBox" style="width: 100%; height:100%; position: relative; overflow:auto">
            <div style="font-size:20px; padding-left:10px; font-weight:bold">Upcoming Consultation</div>
            <table class="table" style="">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Age</th>
                    <th scope="col">Register Date</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $num = 1;
                    @endphp
                    @foreach ($myconsultation as $mc)
                      <tr class="hoverList" ondblclick="window.location = '/doctor/consultation/{{$mc->id}}'">
                        <th scope="row">{{$num}}</th>
                        <td>{{$mc->patient->name}}</td>
                        <td>{{$mc->patient->email}}</td>
                        <td>{{$mc->patient->age()}}</td>
                        <td>{{Date('d M Y', strtotime($mc->created_at))}}</td>
                        <td>{{$mc->status}}</td>
                      </tr>
                        @php
                            $num = $num+1;
                        @endphp
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>

{{-- Pop Up --}}
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

            <div class="modal-body" style="text-align:center;">
                <div style="padding:20px 40px; text-align:center">
                    Consultation with <span style="font-weight: bold">{{$message->doctor->name}}</span> as a {{$message->doctor->specialist}} Speciality is not paid.
                </div>
                <div style="color: black; font-size:20px; padding-bottom:15px">
                    Total: <span style="color: green">Rp. 75.000</span>
                </div>

                <select class="form-select" name="paymentId" aria-label="Default select example">
                    @foreach ($payment as $p)
                        <option value="{{$p->id}}">{{$p->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer" style="display: flex; justify-content:space-between">
                <a href="/cancelConsultationConfirmation/{{$message->id}}"><div class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close" style="background-color:rgb(216, 23, 23); border:none">Cancel</div></a>
                <button type="submit" class="btn btn-primary"  data-dismiss="modal" aria-label="Close" style="background-color:#154a80; border:none">Pay</button>
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

@if ($message = Session::get('startTheMeetingNow'))
<div class="modal fade" tabindex="-1" id="startMeetingModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color: #154a80">Start Consultation</h5>
          <button type="submit" id="closeSuccessMessageModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p style="color: black; padding:20px 40px; text-align:center">Do you wanna start the Video Call Consultation Now with <span style="font-weight: bold">{{$message->doctor->name}}</span> as a {{$message->doctor->specialist}}?</p>
        </div>
        <div class="modal-footer">
            <a href="/consultation/start/{{$message->id}}" style="text-decoration: none"><div class="btn btn-secondary" style="background-color:red; border:none; color:white">Start Now</div></a>
            <div class="btn btn-secondary" id="closeSuccessMessageModal2" data-bs-dismiss="modal" aria-label="Close" style="background-color:#154a80; border:none">Close</div>
        </div>
      </div>
    </div>
  </div>
@endif

@if ($message = Session::get('cancelPopup'))
<div class="modal fade" tabindex="-1" id="cancelConsultModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color: #154a80">Cancel Consultation</h5>
          <button type="submit" id="closeSuccessMessageModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p style="color: black; padding:20px 40px; text-align:center">Are you sure you wanna cancel your consultation with <span style="font-weight: bold">{{$message->doctor->name}}</span> as a {{$message->doctor->specialist}} speciality?</p>
        </div>
        <div class="modal-footer">
            <form action="/consultation" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('delete')
                <input type="text" value="{{$message->id}}" name="consultId" style="display: none">

                <div class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close" style="background-color:#154a80; border:none">Close</div>
                <button type="submit" class="btn btn-primary"  data-dismiss="modal" aria-label="Close" style="background-color:red; border:none">Yes, Cancel</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endif

@if ($message = Session::get('cancelSuccess'))
<div class="modal fade" tabindex="-1" id="cancelSuccessModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color: #154a80">Cancel Consultation</h5>
          <button type="submit" id="closeSuccessMessageModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p style="color: black; padding:20px 40px; text-align:center">{{$message}}</p>
        </div>
        <div class="modal-footer">
            <div class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close" style="background-color:red; border:none">Close</div>
        </div>
      </div>
    </div>
  </div>
@endif

@if ($message = Session::get('done'))
<div class="modal fade" tabindex="-1" id="doneModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color: #154a80">Consultation</h5>
          <button type="submit" id="closeSuccessMessageModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p style="color: black; padding:20px 40px; text-align:center">Your Consultation with {{$message["doctor"]->name}} as a {{$message["doctor"]->specialist}} speciality has been done on {{Date('d M Y, H:i', strtotime($message->updated_at))}}. Thank You and Stay Healthy!</p>
        </div>
        <div class="modal-footer">
            <div class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close" style="background-color:red; border:none">Close</div>
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
    $(document).ready(function() {
        $('#paymentOption').modal('show');
    });
    $(document).ready(function() {
        $('#confirmPayment').modal('show');
    });
    $(document).ready(function() {
        $('#startMeetingModal').modal('show');
    });
    $(document).ready(function() {
        $('#cancelConsultModal').modal('show');
    });
    $(document).ready(function() {
        $('#cancelSuccessModal').modal('show');
    });
    $(document).ready(function() {
        $('#doneModal').modal('show');
    });
</script>

@endsection
