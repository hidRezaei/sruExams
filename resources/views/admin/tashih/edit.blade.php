@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>تصحیح</b></h4></span>
        </div>

        {!! Form::model($data,['route'=>['student.update',$data->id], 'method'=>'put']) !!}


        <div class="form-container">
            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('StName', 'نام دانش آموز') !!}
                    {!! Form::text('StName',old('StName') ,['readonly'=>'readonly','style'=>'background-color:#cccccc']) !!}
                </div>
                <div class="form-group-cell col">
                    {!! Form::label('Title', 'درس') !!}
                    {!! Form::text('Title',old('Title') ,['readonly'=>'readonly','style'=>'background-color:#cccccc']) !!}
                </div>
            </div>

            <div class="form-group-row row alert alert-secondary"  >
                <p style="color:blue">صفحات پاسخ </p>
                <span style="line-height: 230%">برای مشاهده در اندازه بزرگتر بر روی تصویر پاسخ کلیک کنید</span>
                @php  $counter = 1 ; @endphp
                @foreach ($data->answerPagesData as $page)
                    @php /*for($k=0;$k<3;$k++)*/ { @endphp
                    <div class="form-group-cell col">
                        <a href="{{route('displayAnswerImage' , ['stcode'=>$data->CandidID,'lessonNumber'=>$data->LessonID,'QN'=>$data->QNumber, 'filename'=>$page]) }}" target="_blank">
                            <img src="{{ route('displayAnswerImage' , ['stcode'=>$data->CandidID,'lessonNumber'=>$data->LessonID,'QN'=>$data->QNumber, 'filename'=>$page]) }}"
                                 style="border:1px solid black" width="120"/><br/> صفحه{{ $counter++ }}</a>
                    </div>
                    @php } @endphp
                @endforeach
            </div>

            <div class="form-group-row" style="text-align: left">
                <div class="form-group-cell">
                    {!! Form::submit('ثبت اطلاعات',['class'=>'admin-panel-btn btn-green']) !!}
                </div>
                <div class="form-group-cell">
                    <a href="{{route('tashih')}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به لیست</button></a>
                </div>
            </div>

        {!! Form::close() !!}
    </div>

@endsection
