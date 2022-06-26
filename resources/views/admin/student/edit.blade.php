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
            {!! Form::label('CodeMeli', 'کد ملی') !!}
            {!! Form::text('CodeMeli',old('CodeMeli') ,['placeholder'=>'ده رقمی بدون خط تیره']) !!}
            @error('CodeMeli')
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
