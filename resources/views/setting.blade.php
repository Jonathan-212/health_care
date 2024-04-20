@extends('layout')

@section('title', 'Healty Record')

@section('content')
    <div style="height:100%; width:calc(100% - 300px); display: flex; justify-content:center; align-items:center; flex-direction:column; overflow:hidden; padding:20px">
        <div class="shadowBox" style="width: 100%; height:100%; overflow:auto; padding:20px;">
            <div style="font-size:25px; font-weight:bold; padding-bottom:20px">
                Profile & Setting
            </div>

            <div style="width: 100%; padding-bottom:20px">
                <div style="width: 150px; display:block; margin:0 auto; padding-bottom:20px"><img src="{{Storage::url('images/'. Auth::user()->image_url)}}" alt="" srcset="" style="width: 100%"></div>
                <div id="updatePhoto" style="display:block; margin:0 auto; background-color:#142474; width:fit-content; text-align:center; border-radius:10px; color:white; padding:3px 10px; margin-bottom:10px">Change Photo</div>
                <div id="removePhoto" style="display:block; margin:0 auto; background-color:#142474; width:fit-content; text-align:center; border-radius:10px; color:white; padding:3px 10px;">Remove Photo</div>
            </div>

            <form action="/setting" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('put')

                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3" style="">
                            <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{Auth::user()->name}}" style="color:black">
                            <label for="name">Full Name</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3" style="">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="phone" value="{{Auth::user()->phone}}" style="color:black">
                            <label for="phone">Phone Number</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3" style="">
                            <input type="date" name="dob" class="form-control" id="dob" placeholder="dob" value="{{Auth::user()->date_of_birth}}" style="color:black">
                            <label for="dob">Date of Birth</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3" style="">
                                    <input type="text" name="height" class="form-control" id="height" placeholder="height" value="{{Auth::user()->height}}" style="color:black">
                                    <label for="height">Height</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3" style="">
                                    <input type="text" name="weight" class="form-control" id="weight" placeholder="weight" value="{{Auth::user()->weight}}" style="color:black">
                                    <label for="weight">Weight</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style=" display:flex">
                    <div style="padding-right:10px">Notification Setting:</div>
                    <div>
                        @if (Auth::user()->notification)
                        <input type="radio" id="on" name="notification" value="true" checked="checked">
                        <label for="on">on</label><br>
                        <input type="radio" id="off" name="notification" value="false">
                        <label for="off">off</label><br>
                        @else
                        <input type="radio" id="on" name="notification" value="true">
                        <label for="on">on</label><br>
                        <input type="radio" id="off" name="notification" value="false" checked="checked">
                        <label for="off">off</label><br>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="border:none; float: right;">Update</button>
            </form>
        </div>
    </div>


{{-- Pop up --}}
@if ($message = Session::get('failed'))
    <div class="modal fade" tabindex="-1" id="failedMessageModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" style="color: rgb(216, 23, 23)">Update Failed</h5>
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
            <h5 class="modal-title" style="color: #142474">Update Success</h5>
            <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body" style="text-align: center; padding:20px 25px;">
              {!! $message !!}
            </div>
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
</script>

<style>

</style>

@endsection
