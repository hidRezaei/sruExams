@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>ویرایش اعلان</b></h4></span>
        </div>

        {!! Form::model($elanat,['route'=>['admin.elanat.update',['aid'=>-10001 ,'eid'=>$elanat->id]], 'method'=>'put']) !!}

        <div class="form-container">
            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Title', 'عنوان') !!}
                    {!! Form::text('Title',old('Title') ,[]) !!}
                    @error('Title')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                </div>
            </div>
            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Text', 'متن') !!}
                    {!! Form::textarea('Text',old('Text') ,['style'=>'height:140px']) !!}
                    @error('Text')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                </div>
            </div>

            <div class="form-group-row" style="text-align: left">
                <div class="form-group-cell">
                    {!! Form::submit('ثبت اطلاعات',['class'=>'admin-panel-btn btn-green']) !!}
                </div>
                <div class="form-group-cell">
                    <a href="{{route('admin.elanat.index',-10001)}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به لیست</button></a>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>

@endsection
