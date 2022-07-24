@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>ویرایش درس</b></h4></span>
        </div>
        {!! Form::model($data,['route'=>['lesson.update',['lid'=>$data->id]], 'method'=>'put']) !!}
        <div class="form-container">
            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Title', 'عنوان') !!}
                    {!! Form::text('Title',old('Title') ,['style'=>'width:50%']) !!}
                    @error('Title')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                </div>
            </div>

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Code', 'کد') !!}
                    {!! Form::text('Code',old('Code') ,['style'=>'width:50%']) !!}
                    @error('Code')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                </div>
            </div>

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Description', 'توضیحات') !!}
                    {!! Form::textarea('Description',old('Description') ,['style'=>'height:140px']) !!}
                    @error('Description')
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
                    <a href="{{route('lesson.index')}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به لیست</button></a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>

@endsection
