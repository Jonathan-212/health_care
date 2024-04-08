@extends('layout')
@section('content')

    <div style="height:100%; width:calc(100% - 300px)">
        <div style="display: flex; height:50%; justify-content:space-evenly; align-items:center">
            <div class="shadowBox" style="width: 35%; height:90%; display:flex; justify-content:space-around; align-items:center">
                <div style="width: 40%"><img src="{{Storage::url('images/'. Auth::user()->image_url)}}" style="width:100%" alt=""></div>
                <div>
                    {{Auth::user()->name}}
                </div>
            </div>
            <div class="shadowBox" style="width: 55%; height:90%">

            </div>
        </div>
        <div style="display: flex; height:50%; justify-content:space-evenly; align-items:center">
            <div class="shadowBox" style="width: 55%; height:90%">

            </div>
            <div class="shadowBox" style="width: 35%; height:90%">

            </div>
        </div>
    </div>

@endsection
