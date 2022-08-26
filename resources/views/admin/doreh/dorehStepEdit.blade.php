@extends('admin.index')
@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>مراحل دوره</b></h4></span>
        </div>
        <div class="dynamic-content">
            {!! Form::model($data,['route'=>['dorehStepUpdate',request()->sid], 'method'=>'put']) !!}
            {!! Form::hidden('DorehID', request()->did) !!}
            {!! Form::hidden('StepID', request()->sid) !!}
            @error('StepID')
            <p class="text-danger my-2">{{$message}}</p>
            @enderror

            <div class="form-container">
                <div class="form-group-row row" >
                    <div class="form-group-cell col">
                        {!! Form::label('Status', 'فعال',['style'=>'width:5%;display:inline']) !!}
                        {!! Form::checkbox('Status',old('Status'),old('Status'),['style'=>'width:5%']) !!}
                    </div>
                </div>

                <div class="form-group-row row" >
                    <div class="form-group-cell col">
                        {!! Form::label('Title', 'عنوان مرحله') !!}
                        {!! Form::text('Title',old('Title')  ,['placeholder'=>'عنوان فقط عدد باشد']) !!}
                        @error('Title')
                        <p class="text-danger my-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group-cell col">
                    </div>
                </div>
                <!--div class="form-group-row row" >
                    <div class="form-group-cell col">
                        {!! Form::label('AnswerLoc', 'محل ذخیره فایل های پاسخنامه') !!}
                        {!! Form::text('AnswerLoc',old('AnswerLoc')  ,['placeholder'=>'مثلا   D:\\1401\\M3','style'=>'width:90%']) !!}
                        @error('AnswerLoc')
                        <p class="text-danger my-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group-cell col">
                    </div>
                </div-->

                <div class="form-group-row row" >
                    <div class="form-group-cell col">
                        {!! Form::label('Description', 'توضیحات') !!}
                        {!! Form::textarea('Description',old('Description')  ,['placeholder'=>'توضیحات']) !!}
                        @error('Description')
                        <p class="text-danger my-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group-cell col">
                    </div>
                </div>

                <div class="form-group-row row" >
                    <div class="form-group-cell col">
                        {!! Form::label('AnswerView', 'مشاهده پاسخنامه توسط دانش آموزان',['style'=>'width:5%;display:inline']) !!}
                        {!! Form::checkbox('AnswerView',old('AnswerView'),old('AnswerView'),['style'=>'width:5%']) !!}
                    </div>
                    <div class="form-group-cell col">
                        {!! Form::label('ResultView', 'مشاهده نتایج توسط دانش آموزان',['style'=>'width:5%;display:inline']) !!}
                        {!! Form::checkbox('ResultView',old('AnswerView'),old('AnswerView'),['style'=>'width:5%']) !!}
                    </div>
                </div>

                <div class="form-group-row" >
                    <div class="form-group-cell">
                        {!! Form::submit('ثبت مشخصات مرحله',['class'=>'admin-panel-btn btn-green']) !!}
                    </div>
                </div>

            </div>

            {!! Form::close() !!}
        </div>

        <div class="card border-dark mt-5" style="width:90%">
            <div class="card-header">
                اختصاص درس ها به مرحله دوره
            </div>
            <div class="card-body text-dark" style="background-color:#eeeeee">

                <div class="dynamic-content">
                    {!! Form::open(['route'=>array('dorehStepLessonsStore',['did'=>request()->did,'sid'=>request()->sid]), 'method'=>'post']) !!}

                    {!! Form::hidden('DorehID', request()->did) !!}
                    @error('DorehID')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                    {!! Form::hidden('StepID', request()->sid) !!}
                    @error('StepID')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                    <table class="mb-5">
                        <tbody>
                        <tr>
                            <th>عنوان</th>
                            <th>وضعیت</th>
                            <th>تعداد سوالات</th>
                        </tr>

                        @foreach($data2 as $dataItem)
                            <tr>
                                <td>{{$dataItem->Title}}</td>
                                <td>
                                    @php
                                        $flag = false;
                                        if($dataItem->LessonID!= null)
                                            $flag = true;
                                    @endphp

                                    <div class="form-check form-switch">
                                        {!! Form::checkbox('Status['. $dataItem->id .']',null,$flag,['id'=>'chk_'. $dataItem->id,'class'=>'form-check-input','role'=>'switch','style'=>'float:right;position:relative;display:block']) !!}
                                    </div>
                                </td>
                                <td>

                                    <div class="form-group">
                                        {!! Form::text('QCount['. $dataItem->id .']' ,$dataItem->QCount ,['placeholder'=>'فقط عدد']) !!}
                                        @error('QCount['. $dataItem->id .']')
                                        <p class="text-danger my-2">{{$message}}</p>
                                        @enderror
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="form-group-row" >
                        <div class="form-group-cell">
                            {!! Form::submit('ثبت مشخصات درس در دوره',['class'=>'admin-panel-btn btn-green','style'=>'width:220px']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>

        <div class="form-group-row" style="text-align: left">
            <div class="form-group-cell">
                <a href="{{route('dorehSteps',['did'=>request()->did])}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به مراحل دوره</button></a>
            </div>
        </div>


    </div>

@endsection
@section('js')
    @if(Session::has('create'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "مرحله دوره با موفقیت ثبت شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif
    @if(Session::has('update'))
        <script>
            Swal.fire({
                icon: "success",
                title: 'انجام شد',
                text: "مرحله دوره با موفقیت ویرایش شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif
@endsection
