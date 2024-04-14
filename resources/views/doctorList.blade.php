@extends('layout')
@section('content')

    <div style="height:100%; width:calc(100% - 300px); display: flex; justify-content:center; align-items:center; flex-direction:column; overflow:hidden">
        <div style="display: flex; justify-content:space-between; width:100%; padding:20px 20px 0px 20px;">
            <div style="font-size:25px">
                Doctor List
            </div>
            <div>
                Filter
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
                                <td><img src="{{Storage::url('images/'.$doctor->image_url)}}" style="width: 50px" alt="" class="mid"></td>
                                <td>{{$doctor->name}}</td>
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
