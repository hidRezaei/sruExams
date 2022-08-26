@extends('student.master')

@section('content')
    <div style="min-height: 300px">
        @php
            $examClass = new \App\Models\Exam();
        @endphp

        @if($dorehTitle == false)
            <div class="alert alert-success  " role="alert">
                <span><h4><b> در حال حاضر آزمون فعالی تعریف نشده است</b></h4></span>
            </div>
        @else
            <div class="alert alert-success  " role="alert">
                <span><h4><b> دوره {{ $dorehTitle }} -  مرحله {{ $stepTitle }}</b></h4></span>
            </div>
            @if($karnameViewStatus == false)
                <div class="alert alert-primary" role="alert">
                    <span><h4><b>در حال حاضر امکان مشاهده کارنامه وجود ندارد</b></h4></span>
                </div>
            @else
                @foreach($validExamsForKaname as $exam)
                    <div class="alert alert-primary " role="alert">
                        <span><h4><b> کارنامه آزمون {{$examClass->getExamLessonTitleForkarname($exam) }} </b></h4></span>
                    </div>
                    <p>
                        <a href="{{route('student.karname', ['lessonNumber'=>$exam]) }}" style="margin-right: 50px;text-decoration: none">برای دریافت فایل کارنامه کلیک کنید</a>
                    </p><br/>
                @endforeach
            @endif
        @endif
    </div>

@endsection
