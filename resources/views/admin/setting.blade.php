@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>تنظیمات</b></h4></span>
        </div>

        {!! Form::model($result,['route'=>['admin.setting',$result->id], 'method'=>'POST']) !!}
        <div class="form-container">
            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('email', 'نام کاربری') !!}
                    {!! Form::text('email',old('email') ,['placeholder'=>'تلفیقی از حروف و اعداد']) !!}
                    @error('email')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                </div>
            </div>

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('password', 'کلمه عبور') !!}
                    {!! Form::password('password',null ,['placeholder'=>'حداقل 6 کاراکتر','class' => 'awesome']) !!}
                    @error('password')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                </div>
            </div>

            <div class="form-group-row" >
                <div class="form-group-cell">
                    {!! Form::submit('ثبت اطلاعات',['class'=>'admin-panel-btn btn-green']) !!}
                </div>
            </div>
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
