@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>تنظیمات </h2>

        {!! Form::model($result,['route'=>['admin.setting',$result->id], 'method'=>'POST']) !!}

        <div class="form-group">
            {!! Form::label('email', 'نام کاربری') !!}
            {!! Form::text('email',old('email') ,['placeholder'=>'تلفیقی از حروف و اعداد']) !!}
            @error('email')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('password', 'کلمه عبور') !!}
            {!! Form::password('password',null ,['placeholder'=>'حداقل 6 کاراکتر','class' => 'awesome']) !!}
            @error('password')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror
        </div>


        <div class="form-group">
            {!! Form::submit('ثبت اطلاعات',['class'=>'panel-btn']) !!}
        </div>
        {!! Form::close() !!}


    </div>

@endsection

@section('js')

    @if(Session::has('update'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "تنظیمات با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif



@endsection
