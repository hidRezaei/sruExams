@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>جزئیات پیام</h2>
        @php
            //$options = ['24' => 'Product 1', '32' => 'Product 2', '54' => 'Product 3'];
            $examClass = new \App\Models\Exam();
            $options = $examClass->getMessageSubjectOptionsForAdmin();

            // $selected = 24;
            //dd($message);

        @endphp
        {!! Form::model($message,['route'=>['admin.message.update',['aid'=>-10001 ,'mid'=>$message->id]], 'method'=>'put']) !!}
            <div class="form-group">
                {!! Form::label('Sender', 'فرستنده') !!}
                {!! Form::text('Sender',old('Sender') ,['Readonly','style'=>'background-color:#cccccc']) !!}
                {!! Form::text('created_at',verta(old('created_at'))->format('H:i  -  Y/m/d ') ,['Readonly','style'=>'background-color:#cccccc']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Subject', 'آزمون') !!}
                {!! Form::text('Subject',old('Subject') ,['Readonly','style'=>'background-color:#cccccc']) !!}
                {!! Form::text('Subject2',old('Subject2') ,['Readonly','style'=>'background-color:#cccccc']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Message', 'متن پیام') !!}
                {!! Form::textarea('Message',old('Message') ,['Readonly','style'=>'background-color:#cccccc;height:140px']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Reply', 'پاسخ') !!}
                {!! Form::textarea('Reply',old('Reply') ,['style'=>'height:140px']) !!}
                @error('Reply')
                <p class="text-danger my-2">{{$message}}</p>
                @enderror
            </div>


        <div class="form-group">
            {!! Form::submit('ثبت اطلاعات',['class'=>'panel-btn']) !!}
        </div>
        {!! Form::close() !!}
        <br/>
        <a href="{{route('admin.message.index',-10001)}}" ><button type="button" class="btn btn-primary btn-lg" style="float:left">بازگشت به لیست</button></a>
        <br/>
        <br/>


    </div>

@endsection
