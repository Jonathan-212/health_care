@extends('layout')

@section('title', 'Healty Record')

@section('content')

    <div style="height:100%; width:calc(100% - 300px); display: flex; justify-content:center; align-items:center; flex-direction:column; overflow:hidden">
        <div style="display: flex; justify-content:space-between; width:100%; padding:20px 20px 0px 20px;">
            <div style="font-size:25px">
                My Healthy Record
            </div>
            <div>
                <div class="shadowBox" id="addRecordOpen" style="width: 45px; height:45px; background-color:#ffffff; border-radius:10px; text-align:center; align-items:center; display:flex; justify-content:center; cursor: pointer;">
                    <i class="material-icons" style="color:black; font-size:30px">add</i>
                </div>
            </div>
        </div>
        <div style="padding:20px; width: 100%; height:100%; overflow:hidden">
            <div class="shadowBox" style="width: 100%; height:100%; overflow:auto">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Heart Rate (beats per minute)</th>
                        <th scope="col">Sistole Blood Pressure</th>
                        <th scope="col">Diastole Blood Pressure</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($record as $r)
                            <tr class="hoverList">
                                <td style="text-align:center"><a href="/confDeleteRecord/{{$r->id}}" style="text-decoration: none;"><i class="material-icons" style="color:#154a80; font-size:20px">delete</i></a></td>
                                <th scope="row">{{$number}}</th>
                                <td>{{Date('d M Y, H:i:s', strtotime($r->created_at))}}</td>
                                <td>{{$r->heart_rate}}</td>
                                <td>{{$r->sistole_blood_pressure}}</td>
                                <td>{{$r->diastole_blood_pressure}}</td>
                            </tr>
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
<div class="modal fade" tabindex="-1" id="addRecordModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Record</h5>
            <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/healthy-record" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="modal-body" style="padding: 30px">
            <div class="form-floating mb-3">
                <input type="text" name="heart_rate" class="form-control" id="heart_rate" placeholder="heart_rate" style="color:black">
                <label for="heart_rate">Heart Rate</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="sistole" class="form-control" id="sistole" placeholder="sistole" style="color:black">
                <label for="sistole">Sistole Blood Pressure</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="diastole" class="form-control" id="diastole" placeholder="diastole" style="color:black">
                <label for="diastole">Diastole Blood Pressure</label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"  data-dismiss="modal" aria-label="Close" style="background-color:#154a80; border:none">Submit</button>
            <div class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" style="background-color:rgb(216, 23, 23); border:none">Close</div>
        </div>
        </form>
      </div>
    </div>
</div>

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

<script>
    $('#addRecordOpen').click(function(){
        $('#addRecordModal').modal('show');
    });
    $(document).ready(function() {
        $('#failedMessageModal').modal('show');
    });
    $(document).ready(function() {
        $('#successModal').modal('show');
    });
    $(document).ready(function() {
        $('#deleteModal').modal('show');
    });
</script>


@endsection
