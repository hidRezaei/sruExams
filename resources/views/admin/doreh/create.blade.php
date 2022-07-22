@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>دوره جدید</h2>
        {!! Form::open(['route'=>array('doreh.store'), 'method'=>'post']) !!}
            <div class="form-group">
                {!! Form::label('Status', 'فعال',['style'=>'width:5%;display:inline']) !!}
                {!! Form::checkbox('Status',null,null,['style'=>'width:5%']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Title', 'عنوان') !!}
                {!! Form::text('Title',null ,['placeholder'=>'']) !!}
                @error('Title')
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
            {!! Form::submit('ثبت اطلاعات',['class'=>'panel-btn']) !!}
        </div>
        {!! Form::close() !!}

        <br/>
        <a href="{{route('doreh.index')}}" ><button type="button" class="btn btn-primary btn-lg" style="float:left">بازگشت به لیست</button></a>
        <br/>
        <br/>

    </div>

@endsection
