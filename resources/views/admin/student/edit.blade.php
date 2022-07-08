@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>ویرایش دانش آموز </h2>

        {!! Form::model($student,['route'=>['student.update',$student->id], 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::label('FName', 'نام') !!}
            {!! Form::text('FName',old('FName') ,['placeholder'=>'']) !!}
            @error('FName')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('LName', 'نام خانوادگی') !!}
            {!! Form::text('LName',old('LName') ,['placeholder'=>'']) !!}
            @error('LName')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('FatherName', 'نام پدر') !!}
            {!! Form::text('FatherName',old('FatherName') ,['placeholder'=>'']) !!}
            @error('FatherName')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('NIN', 'کد ملی') !!}
            {!! Form::text('NIN',old('NIN') ,['placeholder'=>'ده رقمی بدون خط تیره']) !!}
            @error('NIN')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('CandidID', 'کد دانش آموز در آزمون') !!}
            {!! Form::text('CandidID',old('CandidID') ,['placeholder'=>'']) !!}
            @error('CandidID')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('Tel', 'شماره تماس') !!}
            {!! Form::text('Tel',old('NIN') ,['placeholder'=>'09*********']) !!}
            @error('Tel')
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
