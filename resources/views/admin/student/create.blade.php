@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>دانش آموز جدید</h2>

        {!! Form::open(['route'=>'student.store', 'method'=>'post']) !!}

            <div class="form-group">
                {!! Form::label('fname', 'نام') !!}
                {!! Form::text('fname',null ,['placeholder'=>'']) !!}
                @error('fname')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('lname', 'نام خانوادگی') !!}
                {!! Form::text('lname',null ,['placeholder'=>'']) !!}
                @error('lname')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('fathername', 'نام پدر') !!}
                {!! Form::text('fatherename',null ,['placeholder'=>'']) !!}
                @error('fatherename')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('codemeli', 'کد ملی') !!}
                {!! Form::text('codemeli',null ,['placeholder'=>'ده رقمی بدون خط تیره']) !!}
                @error('codemeli')
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
