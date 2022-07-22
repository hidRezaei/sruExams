@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>درس جدید</h2>
        {!! Form::open(['route'=>array('lesson.store'), 'method'=>'post']) !!}
            <div class="form-group">
                {!! Form::label('Title', 'عنوان') !!}
                {!! Form::text('Title',null ,['placeholder'=>'','Style'=>'width:50%']) !!}
                @error('Title')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('Code', 'کد') !!}
                {!! Form::text('Code',null ,['placeholder'=>'','Style'=>'width:50%']) !!}
                @error('Code')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('Description', 'توضیحات') !!}
                {!! Form::textarea('Description',null ,['placeholder'=>'','Style'=>'height:140px']) !!}
                @error('Description')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>


        <div class="form-group">
            {!! Form::submit('ثبت اطلاعات',['class'=>'panel-btn','Style'=>'width:50%']) !!}
        </div>
        {!! Form::close() !!}

        <br/>
        <a href="{{route('lesson.index')}}" ><button type="button" class="btn btn-primary btn-lg" style="float:left">بازگشت به لیست</button></a>
        <br/>
        <br/>

    </div>

@endsection
