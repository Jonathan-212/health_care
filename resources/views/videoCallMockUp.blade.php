@extends('layout')

@section('title', 'Doctor List')

@section('content')

    <div style="height:100%; width:calc(100% - 300px); display: flex; justify-content:center; align-items:center; flex-direction:column; overflow:hidden; padding:20px">
        <div class="shadowBox" style="width: 100%; height:100%; background-color:rgb(60, 60, 60); position: relative;">
            <div style="position: absolute; top: 15px; left: 25px; color:white; font-size:25px">{{$doctor->name}}</div>
            <div id="patientNoteOpen" style="width: 45px; height:45px; background-color:#f0f0f0; border-radius:10px; position: absolute; top: 15px; right: 25px; text-align:center; align-items:center; display:flex; justify-content:center; cursor: pointer;">
                <i class="material-icons" style="color:black; font-size:30px">text_snippet</i>
            </div>
            <a href="/" style="text-decoration:none">
                <div style="width: 60px; height:60px; background-color:red; border-radius:100%; position: absolute; bottom:30px; left:calc(50% - 30px); text-align:center; align-items:center; display:flex; justify-content:center; cursor: pointer;">
                    <i class="material-icons" style="color:white; font-size:30px">call_end</i>
                </div>
            </a>
        </div>
    </div>


{{-- Pop up --}}
<div class="modal fade" tabindex="-1" id="patientNoteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Patient Note</h5>
            <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding: 30px">
            {{$consultation->patient_note}}
        </div>
        <div class="modal-footer">
            <div class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" style="background-color:rgb(216, 23, 23); border:none">Close</div>
        </div>

      </div>
    </div>
</div>

<script>
    $('#patientNoteOpen').click(function(){
        $('#patientNoteModal').modal('show');
    });
</script>

@endsection
