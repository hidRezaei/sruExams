@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>تایید تصحیح</b></h4></span>
        </div>
        {!! Form::model($data,['route'=>['tashihTaedStoreUpdate',auth()->id()], 'method'=>'PUT']) !!}

        {!! Form::hidden('DorehID', $data->DorehID) !!}
        {!! Form::hidden('StepID', $data->StepID ) !!}
        {!! Form::hidden('StudentID', $data->StudentID ) !!}
        {!! Form::hidden('LessonID', $data->LessonID ) !!}
        {!! Form::hidden('QNumber', $data->QNumber ) !!}
        {!! Form::hidden('ComiteRaesID', auth()->id()) !!}
        {!! Form::hidden('hidTashihIDArr', $data->TashihIDArr ) !!}

        @error('DorehID')
        <p class="text-danger my-2">{{$message}}</p>
        @enderror
        @error('StepID')
        <p class="text-danger my-2">{{$message}}</p>
        @enderror
        @error('StudentID')
        <p class="text-danger my-2">{{$message}}</p>
        @enderror
        @error('LessonID')
        <p class="text-danger my-2">{{$message}}</p>
        @enderror
        @error('QNumber')
        <p class="text-danger my-2">{{$message}}</p>
        @enderror
        @error('MosahehID')
        <p class="text-danger my-2">{{$message}}</p>
        @enderror

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

            <div class="card border-dark mt-5" >
                <div class="card-header">
                    صفحات پاسخ
                </div>
                <div class="card-body text-dark">
                    <p style="line-height: 230%">برای مشاهده در اندازه بزرگتر بر روی تصویر پاسخ کلیک کنید</p>
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
            </div>

            @if($data->otherMosahehMark)
                <div class="card border-dark mt-5" >
                <div class="card-header">
                        نمرات مصححین
                </div>
                <div class="card-body text-dark">
                    <table class="mb-5">
                        <tbody>
                        <tr>
                            <th>نام مصحح</th>
                            <th>نمره</th>
                            <th>توضیح</th>
                            <th>تاریخ ثبت</th>
                            <th>تاریخ ویرایش</th>
                        </tr>
                        @foreach ($data->otherMosahehMark as $item)
                            <tr>
                                <td>{{$item->Name}}</td>
                                <td>{{$item->Mark}}</td>
                                <td>{{$item->Description}}</td>
                                <td>{{verta($item->created_at)->format('H:i  -  Y/m/d ')  }}</td>
                                <td>{{verta($item->updated_at)->format('H:i  -  Y/m/d ')  }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if($data->marksTanaghoz)
                <div class="alert alert-danger " role="alert">
                    <span><h5><b>با نمرات ثبت شده متناقض توسط مصححین، امکان تایید وجود ندارد</b></h5></span>
                </div>
            @endif

            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Status', 'تایید نمرات مصححین',['style'=>'width:5%;display:inline']) !!}
                    @if($data->marksTanaghoz)
                        {!! Form::checkbox('Status',old('Status'),old('Status') ,['style'=>'width:5%','disabled']) !!}
                    @else
                        {!! Form::checkbox('Status',old('Status'),old('Status') ,['style'=>'width:5%']) !!}
                    @endif
                    <br/>
                    <br/>

                    @if($data->TaedDate)
                        {!! Form::label('TaedDate', 'تاریخ تایید') !!}
                        {!! Form::text('TaedDate',old('TaedDate') ,['readonly'=>'readonly','style'=>'background-color:#cccccc']) !!}
                    @endif
                </div>
                <div class="form-group-cell col">
                    {!! Form::label('Description', 'توضیح') !!}

                    @if($data->marksTanaghoz)
                        {!! Form::textarea('Description',old('Description') ,['style'=>'','disabled']) !!}
                    @else
                        {!! Form::textarea('Description',old('Description') ,['style'=>'']) !!}
                    @endif
                </div>
            </div>

            <div class="form-group-row" style="text-align: left">
                <div class="form-group-cell">
                    @if($data->marksTanaghoz)
                        {!! Form::submit('ثبت اطلاعات',['class'=>'admin-panel-btn btn-green','style'=>'background-color:#ccc; !important;color:#000 !important','disabled']) !!}
                    @else
                        {!! Form::submit('ثبت اطلاعات',['class'=>'admin-panel-btn btn-green']) !!}
                    @endif
                </div>
                <div class="form-group-cell">
                    <a href="{{route('tashihTaed')}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به لیست</button></a>
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
                text: "کاربر با موفقیت ویرایش شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif

    <script src="{{asset('back/js/tashih.js')}}"></script>

@endsection

