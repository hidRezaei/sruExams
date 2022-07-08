@extends('student.master')

@section('content')
    <div class="dynamic-content">
        <h2>پیام جدید</h2>
        @php
            //$options = ['24' => 'Product 1', '32' => 'Product 2', '54' => 'Product 3'];
            $examClass = new \App\Models\Exam();
            $options = $examClass->getMessageSubjectOptions();

        $selected = 24;
        @endphp
        {!! Form::open(['route'=>array('student.message.store',['sid'=>auth('student')->id() ]), 'method'=>'post']) !!}
            <div class="form-group">
                {!! Form::label('Subject', 'انتخاب آزمون') !!}
                {!! Form::select('Subject',$options ,$selected) !!}
                @error('Subject')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('Subject2', 'شماره سوال') !!}
                {!! Form::text('Subject2',null ,['placeholder'=>'فقط شماره ذکر شود']) !!}
                @error('Subject2')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('Message', 'متن پیام') !!}
                {!! Form::textarea('Message',null ,['placeholder'=>'','Style'=>'height:140px']) !!}
                @error('Message')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>


        <div class="form-group">
            {!! Form::submit('ثبت اطلاعات',['class'=>'panel-btn']) !!}
        </div>
        {!! Form::close() !!}

        <br/>
        <a href="{{route('student.message.index',auth('student')->id())}}" ><button type="button" class="btn btn-primary btn-lg" style="float:left">بازگشت به لیست</button></a>
        <br/>
        <br/>

    </div>

@endsection
