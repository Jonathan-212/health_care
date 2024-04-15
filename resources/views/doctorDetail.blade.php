@extends('layout')

@section('title', $doctor->name)

@section('content')

    <div style="height:100%; width:calc(100% - 300px); display: flex; justify-content:center; align-items:center; overflow:hidden;">
        <div style="padding: 20px; width:300px; height:100%; overflow:hidden">
            <div class="shadowBox" style="width: 100%; height:100%; overflow:auto; display: flex; flex-direction:column; justify-content:space-evenly; align-items:center; ">
                <div style="width: 150px"><img src="{{Storage::url('images/'. Auth::user()->image_url)}}" alt="" srcset="" style="width: 100%"></div>
                <div style="">
                    <div style="font-weight: bold">Doctor's Name</div>
                    <div style="padding-bottom: 30px">{{$doctor->name}}</div>
                    <div style="font-weight: bold">Speciality</div>
                    <div style="padding-bottom: 30px">{{$doctor->specialist}}</div>
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

@endsection
