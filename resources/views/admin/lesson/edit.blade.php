@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>جزئیات درس</h2>
        {!! Form::model($data,['route'=>['doreh.update',['did'=>$data->id]], 'method'=>'put']) !!}
            <div class="form-group">
                {!! Form::label('Title', 'عنوان') !!}
                {!! Form::text('Title',old('Title') ,['style'=>'width:50%']) !!}
                @error('Title')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('Code', 'کد') !!}
                {!! Form::text('Code',old('Code') ,['style'=>'width:50%']) !!}
                @error('Code')
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
            {!! Form::submit('ثبت اطلاعات',['class'=>'panel-btn','style'=>'width:50%']) !!}
        </div>
        {!! Form::close() !!}
        <br/>
        <a href="{{route('lesson.index')}}" ><button type="button" class="btn btn-primary btn-lg mx-4" style="float:left">بازگشت به لیست</button></a>
        <br/>
        <br/>


    </div>

@endsection
