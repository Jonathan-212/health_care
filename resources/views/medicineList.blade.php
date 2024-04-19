@extends('layout')

@section('title', 'Healty Record')

@section('content')
    <div style="height:100%; width:calc(100% - 300px); display: flex; justify-content:center; align-items:center; flex-direction:column; overflow:hidden">
        <div style="display: flex; justify-content:space-between; width:100%; padding:20px 20px 0px 20px;">
            <div style="font-size:25px">
                My Medicine
            </div>
        </div>
        <div style="padding:20px; width: 100%; height:100%; overflow:hidden">
            <div class="shadowBox" style="width: 100%; height:100%; overflow:auto">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Speciality</th>
                        <th scope="col">Consultation Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($consultation as $c)
                            <tr class="hoverList">
                                <th scope="row">{{$number}}</th>
                                <td>{{$c["doctor"]->name}}</td>
                                <td>{{$c["doctor"]->specialist}}</td>
                                <td>{{Date('d M Y, H:i:s', strtotime($c->created_at))}}</td>
                            </tr>

                            @foreach ($c->getMedicine as $medicine)
                            <tr class="hoverList2">
                                <th scope="row"></th>
                                <td>{{$medicine->medicine_name}}</td>
                                <td>{{$medicine->frequency}}</td>
                                <td><a href="/medicineStatusChange/{{$medicine->id}}" style="text-decoration: none; display:flex"><div style="background-color:#142474; width:fit-content; text-align:center; border-radius:10px; color:white; padding:3px 10px;">{{$medicine->status}}</div><i class="material-icons" style="color:#154a80; font-size:20px">edit</i></a></td>
                            </tr>
                            @endforeach

                            @php
                                $number++;
                            @endphp
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>


{{-- Pop up --}}
@if ($message = Session::get('failed'))
    <div class="modal fade" tabindex="-1" id="failedMessageModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" style="color: rgb(216, 23, 23)">Record Failed</h5>
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
    <div class="modal fade" tabindex="-1" id="successModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" style="color: #142474">Record Success</h5>
            <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body" style="text-align: center; padding:20px 25px;">
              {!! $message !!}
            </div>
        </div>
        </div>
    </div>
@endif

@if ($message = Session::get('deleteConfPopup'))
<div class="modal fade" tabindex="-1" id="deleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Record</h5>
            <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/healthy-record" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('delete')
        <div class="modal-body" style="padding: 30px; text-align:center">
            <input type="text" value="{{$message->id}}" name="recordId" style="display: none">

            <div style="padding-bottom:15px">Heart Rate = {{$message->heart_rate}} <br> Blood Pressure = {{$message->sistole_blood_pressure}}/{{$message->diastole_blood_pressure}} <br> on {{Date('d M Y, H:i:s', strtotime($message->created_at))}}</div>
            <div style="font-size: 20px; font-weight:bolder">Are you sure wanna detele this record?</div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"  data-dismiss="modal" aria-label="Close" style="background-color:#154a80; border:none">Yes</button>
            <div class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" style="background-color:rgb(216, 23, 23); border:none">Close</div>
        </div>
        </form>
      </div>
    </div>
</div>
@endif

@if ($message = Session::get('statusChange'))
<div class="modal fade" tabindex="-1" id="statusModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Status</h5>
            <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/medicine" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('put')
        <div class="modal-body" style="padding: 30px; text-align:center">
            <input type="text" value="{{$message->id}}" name="medicineId" style="display: none">

            <div style="padding-bottom:15px; font-size:20px;">Update {{$message->medicine_name}} status</div>

            <select class="form-select" name="status" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="Not Added">Not Added</option>
                <option value="Add & Notify Me">Add & Notify Me</option>
                <option value="Finished">Finished</option>
            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"  data-dismiss="modal" aria-label="Close" style="background-color:#154a80; border:none">Save</button>
            <div class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" style="background-color:rgb(216, 23, 23); border:none">Close</div>
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
        $('#successModal').modal('show');
    });
    $(document).ready(function() {
        $('#deleteModal').modal('show');
    });
    $(document).ready(function() {
        $('#statusModal').modal('show');
    });
</script>

<style>
    .hoverList2 td, .hoverList2 th{
        background-color: rgb(221, 221, 221);
        cursor: pointer;
    }
    .hoverList2:hover td, .hoverList2:hover th{
        background-color: rgb(217, 217, 217);
    }
</style>

@endsection
