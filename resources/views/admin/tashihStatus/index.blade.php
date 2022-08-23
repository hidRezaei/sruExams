@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <div class="alert alert-success " role="alert">
            <span><h4><b>وضعیت تصحیح</b></h4></span>
        </div>

        <div class="mb-5">
            <div class="mx-auto pull-right">
                <div class="">
                    <form action="{{ route('tashihStatus') }}" method="GET" role="search">

                        <div class="input-group" style="width:50% !important">
                        <span class="input-group-btn mr-5">
                            <button class="btn btn-info" type="submit" title="Search projects">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                            <input type="text" class="form-control mr-2" name="term"      @if(isset($_GET['term'])) value="{{ $_GET['term']}}" @endif placeholder="جستجو بر اساس مشخصات دانش آموز" id="term">
                            <a href="{{ route('tashihStatus') }}" >
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <table class="mb-5">
            <tbody>
            <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th>کد دانش آموز</th>
                <th>درس</th>
                <th>شماره سوال</th>
                <th>تایید شده</th>
                <th>مشاهده</th>
            </tr>
            @php $counter = 1 ; @endphp
            @foreach($data as $item)
                <tr>
                    <td>{{$counter++}}</td>
                    <td>{{$item->StName}}</td>
                    <td>{{$item->StCode}}</td>
                    <td>{{$item->Title}}</td>
                    <td>{{$item->QNumber}}</td>
                    <td><input class="form-check-input" type="checkbox" @if($item->TashihTaedStatus)  {{'checked'}} @endif /></td>
                    <td><a href="{{route('tashihStatusView', [$item->StudentID,$item->LessonID,$item->QNumber])}}" class=" text-decoration-none"> <i class="fas fa-edit"></i></a></td>
                </tr>
            @endforeach

            </tbody>
        </table>

       {{  $data->links() }}

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
@endsection
