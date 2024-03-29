@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>ویرایش دوره</b></h4></span>
        </div>
        <div class="alert alert-secondary  " role="alert">
            <span style="font-size: 14px">عنوان دوره و مراحل دوره باید عددی باشد، از این عناوین برای بارگزاری و دسترسی به فایلهای پاسخنامه استفاده می شود.</span>
        </div>
        {!! Form::model($doreh,['route'=>['doreh.update',['did'=>$doreh->id]], 'method'=>'put']) !!}
        <div class="form-container">
            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Status', 'فعال',['style'=>'width:5%;display:inline']) !!}
                    {!! Form::checkbox('Status',old('Status'),old('Status') ,['style'=>'width:5%']) !!}
                </div>
                <div class="form-group-cell col">
                </div>
            </div>

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
                    <a href="{{route('dorehSteps',['did'=>$doreh->id])}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">مراحل دوره</button></a>
                </div>
                <div class="form-group-cell">
                    <a href="{{route('doreh.index')}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به لیست</button></a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection
