@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>جزئیات دوره</h2>
        {!! Form::model($doreh,['route'=>['doreh.update',['did'=>$doreh->id]], 'method'=>'put']) !!}
            <div class="form-group">
                {!! Form::label('Status', 'فعال',['style'=>'width:5%;display:inline']) !!}
                {!! Form::checkbox('Status',old('Status'),old('Status') ,['style'=>'width:5%']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Title', 'عنوان') !!}
                {!! Form::text('Title',old('Title') ,[]) !!}
                @error('Title')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('Description', 'توضیحات') !!}
                {!! Form::textarea('Description',old('Description') ,['style'=>'height:140px']) !!}
                @error('Description')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>


        <div class="form-group">
            {!! Form::submit('ثبت اطلاعات',['class'=>'panel-btn']) !!}
        </div>
        {!! Form::close() !!}
        <br/>
        <a href="{{route('doreh.index')}}" ><button type="button" class="btn btn-primary btn-lg mx-4" style="float:left">بازگشت به لیست</button></a>
        <a href="{{route('dorehSteps',['did'=>$doreh->id])}}" ><button type="button" class="btn btn-primary btn-lg" style="float:left">مراحل دوره</button></a>
        <br/>
        <br/>


    </div>

@endsection
