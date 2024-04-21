@extends('layout')

@section('title', 'Doctor List')

@section('content')

    <div style="height:100%; width:calc(100% - 300px); display: flex; justify-content:center; align-items:center; flex-direction:column; overflow:hidden">
        <div style="display: flex; justify-content:space-between; width:100%; padding:20px 20px 0px 20px;">
            <div style="font-size:25px">
                Doctor List
            </div>
            <div style="display: flex">
                <form class="d-flex" action="/consultation/doctor-list" style="position: relative; align-items:center;  " >
                    <input type="text" value="{{$specialityFilter}}" name="speciality" style="display: none">
                    <input class="form-control me-sm-2" type="text" name="search" placeholder="{{$searchText}}" value="{{$searchText=="Search"?null:$searchText}}"style="padding-left:25px; background-color: #ffffff; border-radius:20px; height:50px; width:250px">
                    <button class="material-icons " type="submit" style="font-size:30px; color:#154a80; position: absolute; right:25px; border:none; background-color:transparent">search</button>
                </form>
                <div class="dropdown" style="width:150px; align-items:center; left:0px; ">
                    <button style="background-color:#154a80; border:none;border-radius:10px; height:50px; width:80%; display:block; margin:auto; font-size:1rem" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if ($specialityFilter != null)
                            {{$specialityFilter}}
                        @else
                            Speciality
                        @endif
                    </button>
                    <ul class="dropdown-menu" >
                      <li><a class="dropdown-item" href="/consultation/doctor-list?search={{$searchText}}">All</a></li>
                      <li><a class="dropdown-item" href="/consultation/doctor-list?search={{$searchText}}&speciality=Bedah">Bedah</a></li>
                      <li><a class="dropdown-item" href="/consultation/doctor-list?search={{$searchText}}&speciality=THT">THT</a></li>
                      <li><a class="dropdown-item" href="/consultation/doctor-list?search={{$searchText}}&speciality=Gizi">Gizi</a></li>
                      <li><a class="dropdown-item" href="/consultation/doctor-list?search={{$searchText}}&speciality=Akupuntur">Akupuntur</a></li>
                      <li><a class="dropdown-item" href="/consultation/doctor-list?search={{$searchText}}&speciality=Jantung">Jantung</a></li>
                      <li><a class="dropdown-item" href="/consultation/doctor-list?search={{$searchText}}&speciality=Gigi">Gigi</a></li>
                    </ul>
                  </div>
            </div>
        </div>
        <div style="padding:20px; width: 100%; height:100%; overflow:hidden">
            <div class="shadowBox" style="width: 100%; height:100%; overflow:auto">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">University</th>
                        <th scope="col">Age</th>
                        <th scope="col">Specialist</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($doctors as $doctor)
                            <tr class="hoverList" onclick="window.location = '/consultation/doctor/{{$doctor->id}}'">
                                <th scope="row">{{$number}}</th>
                                <td><img src="{{Storage::url('images/'.$doctor->image_url)}}" style="width: 50px;  aspect-ratio : 1 / 1; border-radius:100%" alt="" class="mid"></td>
                                <td>{{$doctor->name}}</td>
                                <td>{{$doctor->doctor_university}}</td>
                                <td>{{$doctor->age()}}</td>
                                <td>{{$doctor->specialist}}</td>
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

@endsection
