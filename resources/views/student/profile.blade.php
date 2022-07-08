@extends('student.master')

@section('content')
    <div class="dynamic-content">
        <h2>پروفایل </h2>

        {!! Form::model($student,['route'=>['student.updateProfile',$student->id], 'method'=>'POST']) !!}

        <div class="form-group">
            {!! Form::text('FName',old('FName') ,['readonly','Style'=>'background-color:#ccc']) !!}
            {!! Form::text('LName',old('LName') ,['readonly','Style'=>'background-color:#ccc']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('FatherName', 'نام پدر') !!}
            {!! Form::text('FatherName',old('FatherName') ,['readonly','Style'=>'background-color:#ccc']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('NIN', 'کد ملی') !!}
            {!! Form::text('NIN',old('NIN') ,['placeholder'=>'ده رقمی بدون خط تیره','readonly','Style'=>'background-color:#ccc']) !!}
            @error('NIN')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('CandidID', 'کد دانش آموز در آزمون') !!}
            {!! Form::text('CandidID',old('CandidID') ,['placeholder'=>'ده رقمی بدون خط تیره','readonly','Style'=>'background-color:#ccc']) !!}
            @error('CandidID')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('password', 'کلمه عبور') !!}
            {!! Form::password('password',null ,['placeholder'=>'حداقل 6 کاراکتر','class' => 'awesome']) !!}
            @error('password')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
        </div>


        <div class="form-group">
            {!! Form::submit('ثبت اطلاعات',['class'=>'panel-btn']) !!}
        </div>
        {!! Form::close() !!}


    </div>

@endsection
