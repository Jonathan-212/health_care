@extends('layout')

@section('title', 'Dashboard')

@section('content')

    <div style="height:100%; width:calc(100% - 300px)">
        <div style="display: flex; height:50%; justify-content:space-evenly; align-items:center;">
            <div style="width: 40%; height:100%; padding:20px">
                <div class="shadowBox" style="width: 100%; height:100%; display:flex; justify-content:space-around; align-items:center">
                    <div style="width: 40%"><img src="{{Storage::url('images/'. Auth::user()->image_url)}}" style="width:100%" alt=""></div>
                    <div>
                        {{Auth::user()->name}}
                    </div>
                </div>
            </div>
            <div style="width: 60%; height:100%; padding:20px 20px 20px 0px">
                <div class="shadowBox" style="width: 100%; height:100%; display:flex; justify-content:space-around; align-items:center">

                </div>
            </div>
        </div>
        <div style="display: flex; height:50%; justify-content:space-evenly; align-items:center;">
            <div style="width: 60%; height:100%; padding:0 20px 20px 20px">
                <div class="shadowBox" style="width: 100%; height:100%; display:flex; justify-content:space-around; align-items:center">

                </div>
            </div>
            <div style="width: 40%; height:100%; padding:0 20px 20px 0px">
                <div class="shadowBox" style="width: 100%; height:100%; display:flex; justify-content:space-around; align-items:center">

                </div>
            </div>
        </div>
    </div>

@endsection
