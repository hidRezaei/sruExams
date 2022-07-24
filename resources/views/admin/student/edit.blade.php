@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>ویرایش دانش آموز</b></h4></span>
        </div>

        {!! Form::model($student,['route'=>['student.update',$student->id], 'method'=>'put']) !!}


        <div class="form-container">
            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('FName', 'نام') !!}
                    {!! Form::text('FName',old('FName') ,['placeholder'=>'']) !!}
                    @error('FName')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                    {!! Form::label('LName', 'نام خانوادگی') !!}
                    {!! Form::text('LName',old('LName') ,['placeholder'=>'']) !!}
                    @error('LName')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('FatherName', 'نام پدر') !!}
                    {!! Form::text('FatherName',old('FatherName') ,['placeholder'=>'']) !!}
                    @error('FatherName')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                    {!! Form::label('NIN', 'کد ملی') !!}
                    {!! Form::text('NIN',old('NIN') ,['placeholder'=>'ده رقمی بدون خط تیره']) !!}
                    @error('NIN')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('CandidID', 'کد دانش آموز در آزمون') !!}
                    {!! Form::text('CandidID',old('CandidID') ,['placeholder'=>'']) !!}
                    @error('CandidID')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                    {!! Form::label('Tel', 'شماره تماس') !!}
                    {!! Form::text('Tel',old('NIN') ,['placeholder'=>'09*********']) !!}
                    @error('Tel')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('password', 'کلمه عبور') !!}
                    {!! Form::password('password',null ,['placeholder'=>'حداقل 6 کاراکتر','class' => 'awesome']) !!}
                    @error('password')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                </div>
            </div>

            <div class="form-group-row" style="text-align: left">
                <div class="form-group-cell">
                    {!! Form::submit('ثبت اطلاعات',['class'=>'admin-panel-btn btn-green']) !!}
                </div>
                <div class="form-group-cell">
                    <a href="{{route('student.index')}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به لیست</button></a>
                </div>
            </div>

        {!! Form::close() !!}
    </div>

@endsection
