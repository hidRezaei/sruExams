@extends('student.master')

@section('content')
<div style="min-height: 300px">
    @if($dorehTitle == false)
        <div class="alert alert-success  " role="alert">
            <span><h4><b> در حال حاضر آزمون فعالی تعریف نشده است</b></h4></span>
        </div>
    @else
        <div class="alert alert-success  " role="alert">
            <span><h4><b>پاسخنامه دوره {{ $dorehTitle }} -  مرحله {{ $stepTitle }}</b></h4></span>
        </div>
        @if($answerViewStatus == false)
            <div class="alert alert-primary" role="alert">
                <span><h4><b>در حال حاضر امکان مشاهده پاسخنامه وجود ندارد</b></h4></span>
            </div>
        @else

            @php
                $examClass = new \App\Models\Exam();
                $student = new \App\Models\Student();
            @endphp

            @if(! $validExams)
                <p>پاسخنامه ای یافت نشد</p>
            @endif

            @foreach($validExams as $exam)
                <div class="alert alert-primary " role="alert">
                    <span><h4><b> آزمون {{$examClass->getExamLessonTitle($exam) }} </b></h4></span>
                </div>
                @php
                    $questionNumber = $student->getQuestionCount($exam,$dorehTitle,$stepTitle);
                @endphp

                @foreach($questionNumber as $question)
                    <p>{{' سوال ' . $question}}</p>
                    @php
                        $answerPage = $student->getAnswerPagesOfQuestion($exam,$question,$dorehTitle,$stepTitle);
                    @endphp
                    @foreach ($answerPage as $page)
                        <a href="{{route('image.displayImage' , ['lessonNumber'=>$exam,'QN'=>$question, 'filename'=>$page,'dl'=> $dorehTitle,'sl'=>$stepTitle]) }}" target="_blank">
                            <img src="{{ route('image.displayImage' , ['lessonNumber'=>$exam,'QN'=>$question, 'filename'=>$page,'dl'=> $dorehTitle,'sl'=>$stepTitle]) }}"
                                style="border:1px solid black" width="200"/></a>
                    @endforeach
                    <br/><br/>
                @endforeach
            @endforeach
       @endif
    @endif

    @if($oldExams)
            <div class="alert alert-success  " role="alert">
                <span><h4><b>پاسخنامه آزمون های گذشته</b></h4></span>
            </div>
            <table class="mb-5">
                <tbody>
                <tr>
                    <th>ردیف</th>
                    <th>دوره</th>
                    <th>مرحله</th>
                    <th>مشاهده پاسخنامه</th>
                    <th>مشاهده کارنامه</th>
                </tr>

                @php $counter =1 @endphp
                @foreach($oldExams as $exam)
                    <tr>
                        <td>{{ $counter++}}</td>
                        <td>{{$exam->DorehTitle}}</td>
                        <td>{{$exam->StepTitle}}</td>
                        <td><a href="{{route('student.answerPage',['dl'=>$exam->DorehTitle,'sl'=>/*'M'.*/$exam->StepTitle,'viewST'=>$exam->AnswerView] )}}" class="text-blue text-decoration-none"> پاسخنامه</a></td>
                        <td><a href="{{route('student.answerPage',['dl'=>$exam->DorehTitle,'sl'=>/*'M'.*/$exam->StepTitle,'viewST'=>$exam->AnswerView] )}}" class="text-blue text-decoration-none">کارنامه</a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
    @endif
</div>

@endsection
