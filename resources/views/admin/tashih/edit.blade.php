@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>تصحیح</b></h4></span>
        </div>
        {!! Form::model($data,['route'=>['tashihStoreUpdate',$data->MosahehID], 'method'=>'PUT']) !!}

        {!! Form::hidden('DorehID', $data->DorehID) !!}
        {!! Form::hidden('StepID', $data->StepID ) !!}
        {!! Form::hidden('StudentID', $data->StudentID ) !!}
        {!! Form::hidden('LessonID', $data->LessonID ) !!}
        {!! Form::hidden('QNumber', $data->QNumber ) !!}
        {!! Form::hidden('MosahehID', $data->MosahehID ) !!}
        {!! Form::hidden('OldDataID', $data->OldDataID ) !!}
        {!! Form::hidden('hidMarkSection',old('hidMarkSection'),['id'=>'hidMarkSection']) !!}

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

        @if($data->taedTashih)
            <div class="alert alert-danger " role="alert">
                <span><h5><b>اطلاعات ثبت شده تایید شده است و امکان ویرایش وجود ندارد</b></h5></span>
            </div>
        @endif
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
                        نمرات سایر مصححین
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
                            <th>وضعیت</th>
                        </tr>
                        @foreach ($data->otherMosahehMark as $item)
                            <tr>
                                <td>{{$item->Name}}</td>
                                <td>{{$item->Mark}}</td>
                                <td>{{$item->Description}}</td>
                                <td>{{verta($item->created_at)->format('H:i  -  Y/m/d ')  }}</td>
                                <td>{{verta($item->updated_at)->format('H:i  -  Y/m/d ')  }}</td>
                                @if($item->Tanaghoz)
                                    <td style="background-color: red">{{ $item->Tanaghoz }}</td>
                                @else
                                    <td style="">{{ $item->Tanaghoz }}</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif


            @if($data->markLogs)
                <div class="card border-dark mt-5" >
                    <div class="card-header"  >
                            تاریخچه ثبت  نمرات توسط شما
                        <a style="color: blue;float:left" onclick="f1()" id="txtToggle"> + مشاهده</a>
                    </div>
                    <div class="card-body text-dark">
                        <div id="markLogs" style="display: none">
                            <table class="mb-5">
                                <tbody>
                                <tr>
                                    <th>نمره</th>
                                    <th>تاریخ ثبت</th>
                                </tr>
                                @foreach ($data->markLogs as $item)
                                    <tr>
                                        <td>{{$item->Mark}}</td>
                                        <td>{{verta($item->created_at)->format('H:i  -  Y/m/d ')  }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif


            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Mark', 'نمره کل شما به پاسخ') !!}
                    {!! Form::text('Mark',old('Mark'),['style'=>'']) !!}
                    @error('Mark')
                    <p class="text-danger my-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group-cell col">
                    <p>نمره دهی به بخش های مختلف جواب</p>
                    {!! Form::text('QN',null ,['placeholder'=>'مثلا: قسمت الف - 3 نمره','id'=>'txtQN','class'=>'align-top','style'=>'height:30px;width:150px !important;font-size:12px']) !!}

                    <input type="button" id="btnAddQNToList" value=">>" class="btnDefault align-top" style="width:60px;height:30px;" />

                    <!--label for="lstQN" class="lbl2 align-top">سوالها</label-->

                    <select multiple name="lstQN"  id="lstQN" style="width:160px;font-size:12px" class="align-top" >
                        @php
                            if($data->markItems)
                                foreach($data->markItems AS $item)
                                    echo "<option value='". $item->MarkItem ."'>". $item->MarkItem ."</option>";
                        @endphp
                    </select>
                    <input type="button" id="btnRemoveQN" value="حذف" class="btnDefault align-top" style="width:60px;height:30px;" />
                </div>
            </div>
            <div class="form-group-row row" >
                <div class="form-group-cell col">
                    {!! Form::label('Description', 'توضیح') !!}
                    {!! Form::textarea('Description',old('Description') ,['style'=>'']) !!}
                </div>
                <div class="form-group-cell col">
                </div>
            </div>

            <div class="form-group-row" style="text-align: left">
                <div class="form-group-cell">
                    @if($data->taedTashih)
                        {!! Form::submit('ثبت اطلاعات',['class'=>'admin-panel-btn btn-green','style'=>'background-color:#ccc; !important;color:#000 !important','disabled']) !!}
                    @else
                        {!! Form::submit('ثبت اطلاعات',['class'=>'admin-panel-btn btn-green']) !!}
                    @endif
                </div>
                <div class="form-group-cell">
                    <a href="{{route('tashih')}}" ><button type="button" class="admin-panel-btn btn-blue" style="float:left">بازگشت به لیست</button></a>
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
                text: "اطلاعات با موفقیت ویرایش شد.",
                confirmButtonText: "تایید",
            })
        </script>
    @endif

    <script src="{{asset('back/js/tashih.js')}}"></script>

@endsection

