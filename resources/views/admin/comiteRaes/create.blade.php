@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>رئیس کمیته جدید</b></h4></span>
        </div>

        {!! Form::open(['route'=>'comiteRaes.store', 'method'=>'post']) !!}

        <div class="form-container">
            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('name', 'نام') !!}
                    {!! Form::text('name',null ,['placeholder'=>'']) !!}
                    @error('name')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                    {!! Form::label('lname', 'نام خانوادگی') !!}
                    {!! Form::text('lname',null,['placeholder'=>'']) !!}
                    @error('lname')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('code', 'کد') !!}
                    {!! Form::text('code',null,['placeholder'=>'']) !!}
                    @error('code')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('email', 'نام کاربری') !!}
                    {!! Form::text('email',null ,['placeholder'=>'']) !!}
                    @error('email')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                    {!! Form::label('password', 'کلمه عبور') !!}
                    {!! Form::password('password',['placeholder'=>'حداقل 6 کاراکتر','class' => 'awesome']) !!}
                    @error('password')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="card border-dark mt-5" >
                <div class="card-header">
                    تخصیص درس
                </div>
                <div class="card-body text-dark">
                    <p id='txtDorehInfo' class="card-text" style="color:blue">مشخصات دوره فعال :
                        {{ $result['DorehTitle'] }} - {{ $result['StepTitle'] }}
                    </p>
                    <div class="form-group-row row" style="margin-top: 2px !important">
                        <div class="form-group-cell col">
                            <label style="display: inline !important">انتخاب درس  </label>
                            @php
                                //$options = ['24' => 'Product 1', '32' => 'Product 2', '54' => 'Product 3'];
                                $options = array(0=>'انتخاب کنید');
                                foreach ($result['allLesons'] AS $item)
                                   $options[$item->id] = $item->Title;
                                //dd($options);
                                $selected = 0;
                            @endphp

                            {!! Form::select('LessonID',$options,$selected,['id'=>'cmbLessonID']) !!}
                        </div>

                    </div>
                </div>
            </div>




            <div class="form-group-row" style="text-align: left">
                <div class="form-group-cell">
                    {!! Form::submit('ثبت اطلاعات',['class'=>'admin-panel-btn btn-green']) !!}
                </div>
                <div class="form-group-cell">
                    <a href="{{route('mosaheh.index')}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به لیست</button></a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection
