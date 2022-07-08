@extends('student.master')

@section('content')
    <span class="nav2">

    </span>

    <div class="information">
        <div class="col-div-3">
            <div class="box">
                <div class="box-icon">
                    <i class="fas fa-clipboard"></i>
                </div>
                <div class="box-text">
                    <h4>30</h4>
                    <h3>آزمون ها</h3>
                </div>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <div class="box-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="box-text">
                    <h4>1121</h4>
                    <h3>افراد</h3>
                </div>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <div class="box-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="box-text">
                    <h4>3</h4>
                    <h3>مراحل</h3>
                </div>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <div class="box-icon">
                    <i class="fas fa-comment"></i>
                </div>
                <div class="box-text">
                    <h4>600</h4>
                    <h3>کامنت</h3>
                </div>
            </div>
        </div>
    </div>

    <div style="height: 300px">
        @foreach($elanats as $elanat)
            <p style="margin:10px 5px 10px 0 ;padding-right:30px;line-height:200%;color:white;background-color:blue; border-radius: 7px">{{$elanat->Title  }}</p>
            <span style="color:#777777; margin-right:20px"> تاریخ :  {{ verta($elanat->created_at)->format('H:i  -  Y/m/d ') }}</span>
            <br/>
            <p style="color:#333333; margin-right:20px">{{ $elanat->Text }}</p>
            <br/>
        @endforeach

    </div>

@endsection
