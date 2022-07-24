@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>جزئیات اعتراض</b></h4></span>
        </div>
        {!! Form::model($message,['route'=>['admin.message.update',['aid'=>-10001 ,'mid'=>$message->id]], 'method'=>'put']) !!}
        <div class="form-container">
            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Sender', 'فرستنده') !!}
                    {!! Form::text('Sender',old('Sender') ,['Readonly','style'=>'background-color:#cccccc']) !!}
                </div>
                <div class="form-group-cell col">
                    {!! Form::label('created_at', 'زمان ثبت') !!}
                    {!! Form::text('created_at',verta(old('created_at'))->format('H:i  -  Y/m/d ') ,['Readonly','style'=>'background-color:#cccccc']) !!}
                </div>
            </div>

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Subject', 'آزمون') !!}
                    {!! Form::text('Subject',old('Subject') ,['Readonly','style'=>'background-color:#cccccc']) !!}
                </div>
                <div class="form-group-cell col">
                    {!! Form::label('Subject2', 'سوال - موضوع') !!}
                    {!! Form::text('Subject2',old('Subject2') ,['Readonly','style'=>'background-color:#cccccc']) !!}
                </div>
            </div>

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Message', 'متن پیام') !!}
                    {!! Form::textarea('Message',old('Message') ,['Readonly','style'=>'background-color:#cccccc;']) !!}
                </div>
                <div class="form-group-cell col">
                </div>
            </div>

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Reply', 'پاسخ') !!}
                    {!! Form::textarea('Reply',old('Reply') ) !!}
                    @error('Reply')
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
                    <a href="{{route('admin.message.index',-10001)}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به لیست</button></a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>

@endsection
