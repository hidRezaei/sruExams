@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>اعلان جدید</h2>
        {!! Form::open(['route'=>array('admin.elanat.store',['aid'=>-10001 ]), 'method'=>'post']) !!}
            <div class="form-group">
                {!! Form::label('Title', 'عنوان') !!}
                {!! Form::text('Title',null ,['placeholder'=>'']) !!}
                @error('Title')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('Text', 'متن') !!}
                {!! Form::textarea('Text',null ,['placeholder'=>'','Style'=>'height:140px']) !!}
                @error('Text')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>


        <div class="form-group">
            {!! Form::submit('ثبت اطلاعات',['class'=>'panel-btn']) !!}
        </div>
        {!! Form::close() !!}

        <br/>
        <a href="{{route('admin.elanat.index',-10001)}}" ><button type="button" class="btn btn-primary btn-lg" style="float:left">بازگشت به لیست</button></a>
        <br/>
        <br/>

    </div>

@endsection
