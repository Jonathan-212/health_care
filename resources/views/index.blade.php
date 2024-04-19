@extends('layout')

@section('title', 'Dashboard')

@section('content')

    <div style="height:100%; width:calc(100% - 300px);">
        <div style="display: flex; height:50%; justify-content:space-evenly; align-items:center;">
            <div style="width: 40%; height:100%; padding:20px">
                <div class="shadowBox" style="width: 100%; height:100%; display:flex; align-items:center; justify-content:space-around">
                    <div style="width: 40%"><img src="{{Storage::url('images/'. Auth::user()->image_url)}}" style="width:100%" alt=""></div>
                    <div style="padding-left:10px; width:max-content;">
                        <div style="padding-bottom:10px">
                            <div style="font-size: smaller; font-weight:bold">Name</div>
                            <div>{{Auth::user()->name}}</div>
                        </div>
                        <div style="padding-bottom:10px">
                            <div style="font-size: smaller; font-weight:bold">Email</div>
                            <div>{{Auth::user()->email}}</div>
                        </div>
                        <div style="padding-bottom:10px">
                            <div style="font-size: smaller; font-weight:bold">Phone</div>
                            <div>{{Auth::user()->phone}}</div>
                        </div>
                        <div style="padding-bottom:10px">
                            <div style="font-size: smaller; font-weight:bold">Height/Weight</div>
                            <div>{{Auth::user()->height}}/{{Auth::user()->weight}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="width: 60%; height:100%; padding:20px 20px 20px 0px">
                <div class="shadowBox" style="width: 100%; height:100%; display:flex; justify-content:center; align-items:center;">
                    <div style="width: 100%; ">
                        {!! $recordChart->container() !!}
                    </div>
                </div>
            </div>
        </div>
        <div style="display: flex; height:50%; justify-content:space-evenly; align-items:center;">
            <div style="width: 60%; height:100%; padding:0 20px 20px 20px;">
                <div class="shadowBox" style="width: 100%; height:100%; overflow:auto">
                    <div style="font-size:20px; padding-left:10px; font-weight:bold">Consultation History</div>
                    <table class="table" style="">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Doctor</th>
                            <th scope="col">Speciality</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = 1;
                            @endphp
                            @foreach ($myconsultation as $mc)
                              <tr class="hoverList" ondblclick="window.location = '/consultation/check/{{$mc->id}}'">
                                <th scope="row">{{$num}}</th>
                                <td>{{$mc->doctor->name}}</td>
                                <td>{{$mc->doctor->specialist}}</td>
                                <td>{{$mc->status}}</td>
                                <td>{{Date('d M Y', strtotime($mc->created_at))}}</td>
                              </tr>
                                @php
                                    $num = $num+1;
                                @endphp
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
            <div style="width: 40%; height:100%; padding:0 20px 20px 0px">
                <div class="shadowBox" style="width: 100%; height:100%; display:flex; justify-content:space-around; align-items:center">

                </div>
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
            <p style="color: black; padding:10px 30px; text-align:center">Doctor Note: {{$message->doctor_note}}</p>
            <p style="color: black; padding:20px 40px; text-align:center">Your Consultation with {{$message["doctor"]->name}} as a {{$message["doctor"]->specialist}} speciality has been done on {{Date('d M Y, H:i', strtotime($message->updated_at))}}. Thank You and Stay Healthy!</p>
        </div>
        <div class="modal-footer">
            <div class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close" style="background-color:red; border:none">Close</div>
        </div>
      </div>
    </div>
  </div>
@endif

<script src="{{ $recordChart->cdn() }}"></script>

{{ $recordChart->script() }}

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
