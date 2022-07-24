@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>مصحح جدید</b></h4></span>
        </div>

        {!! Form::open(['route'=>'mosaheh.store', 'method'=>'post']) !!}
        {!! Form::hidden('hidQNumbers',old('hidQNumbers'),['id'=>'hidQNumbers']) !!}

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
                    <div style="display:inline-block !important">
                        اختصاص درس و سوال برای تصحیح
                    </div>

                    @php
                        $flag = false;
                    @endphp
                    <div class="form-check form-switch" style="display:inline-block !important;vertical-align: bottom;margin-right: 20px;padding-top:3px">
                        {!! Form::checkbox('chk_LessonQNAssign',null,$flag,['id'=>'chk_LessonQNAssign','class'=>'form-check-input','role'=>'switch','style'=>'float:right;position:relative;display:block']) !!}
                    </div>
                    <div style="display:inline-block !important">
                        <span style="font-size: 0.88rem;color:#666666">( در صورت عدم انتخاب، اطلاعات این بخش ثبت یا بروز نمی شود)</span>
                    </div>

                </div>
                <div class="card-body text-dark">
                    <!--h5 class="card-title">انتخاب درس</h5>
                    <p-- class="card-text">متن تستی متن تستی متن تستی متن تستی متن تستی </p-->
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
                                $QNType = 2 ;
                                $hasQNItems = false ;
                                if((isset($result->LessonData)) && (count($result->LessonData)>0))
                                {
                                    $selected = $result->LessonData[0]->LessonID ;
                                    if($result->LessonData[0]->QNumber == config('constants.General.ALL') )
                                        $QNType = 1 ;
                                    else
                                        $hasQNItems = true ;
                                }
                            @endphp


                            {!! Form::select('LessonID',$options,$selected,['id'=>'cmbLessonID']) !!}
                        </div>

                        <div class="form-group-cell col" style="padding-top: 15px">
                            <label class="radio-inline lbl2"><input type="radio" name="rdoQNType" value="1" id="rdoAll" onchange="toggleQTypeSelectAction()" @if($QNType==1) CHECKED @endif>همه سوالات</label>
                            <label class="radio-inline lbl2"><input type="radio" name="rdoQNType" value="2"  id="rdoSel" onchange="toggleQTypeSelectAction()"  @if($QNType==2) CHECKED @endif >سوالات منتخب</label>
                        </div>
                    </div>
                    <div class="form-group-row row" style="margin-top: 15px !important">
                        <div class="form-group-cell col" >&nbsp;</div>
                        <div class="form-group-cell col" style="vertical-align: top !important">
                            {!! Form::text('QN',null ,['placeholder'=>'شماره سوال','id'=>'txtQN','class'=>'align-top','style'=>'height:30px;width:80px !important;font-size:12px']) !!}

                            <input type="button" id="btnAddQNToList" value=">>" class="btnDefault align-top" style="width:60px;height:30px;" />

                            <label for="lstQN" class="lbl2 align-top">سوالها</label>

                            <select multiple name="lstQN"  id="lstQN" style="width:100px" class="align-top" >
                                @php
                                    if($hasQNItems)
                                        foreach($result->LessonData AS $item)
                                            echo "<option value='". $item->QNumber ."'>". $item->QNumber ."</option>";
                                @endphp
                            </select>
                            <input type="button" id="btnRemoveQN" value="حذف" class="btnDefault align-top" style="width:60px;height:30px;" />
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

@section('js')
    <script src="{{asset('back/js/mosaheh.js')}}"></script>
@endsection
