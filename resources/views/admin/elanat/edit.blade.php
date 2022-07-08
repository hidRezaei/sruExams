@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>جزئیات اعلان</h2>
        {!! Form::model($elanat,['route'=>['admin.elanat.update',['aid'=>-10001 ,'eid'=>$elanat->id]], 'method'=>'put']) !!}
            <div class="form-group">
                {!! Form::label('Title', 'عنوان') !!}
                {!! Form::text('Title',old('Title') ,[]) !!}
                @error('Title')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('Text', 'متن') !!}
                {!! Form::textarea('Text',old('Text') ,['style'=>'height:140px']) !!}
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
