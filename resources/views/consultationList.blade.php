@extends('layout')

@section('title', 'Doctor List')

@section('content')

    <div style="height:100%; width:calc(100% - 300px); display: flex; justify-content:center; align-items:center; flex-direction:column; overflow:hidden">
        <div style="display: flex; justify-content:space-between; width:100%; padding:20px 20px 0px 20px;">
            <div style="font-size:25px">
                Consultation
            </div>
            <div style="display: flex">
                <div class="dropdown" style="width:150px; align-items:center; left:0px; ">
                    <button style="background-color:#154a80; border:none;border-radius:10px; height:50px; width:80%; display:block; margin:auto; font-size:1rem" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if ($filterStatus != null)
                            {{$filterStatus}}
                        @else
                            Status
                        @endif
                    </button>
                    <ul class="dropdown-menu" >
                      <li><a class="dropdown-item" href="/doctor/consultation">All</a></li>
                      <li><a class="dropdown-item" href="/doctor/consultation/?status=Paid">Paid</a></li>
                      <li><a class="dropdown-item" href="/doctor/consultation/?status=Unpaid">Unpaid</a></li>
                      <li><a class="dropdown-item" href="/doctor/consultation/?status=Done">Done</a></li>
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
                          <th scope="col">Patient Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Age</th>
                          <th scope="col">Note</th>
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
                              <td style="max-width: 300px">{{$mc->patient_note}}</td>
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

@endsection
