@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>دانش آموزان</h2>
        <!--a href="{{route('student.create')}}" ><button type="button" class="btn btn-primary btn-sm">جدید</button></a-->


        <div class="mb-5">
            <div class="mx-auto pull-right">
                <div class="">
                    <form action="{{ route('student.index') }}" method="GET" role="search">

                        <div class="input-group" style="width:50% !important">
                        <span class="input-group-btn mr-5">
                            <button class="btn btn-info" type="submit" title="Search projects">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                            <input type="text" class="form-control mr-2" name="term"      @if(isset($_GET['term'])) value="{{ $_GET['term']}}" @endif placeholder="جستجو بر اساس نام، نام خانوادگی، کد ملی، شماره تماس، کد داوطلبی" id="term">
                            <a href="{{ route('student.index') }}" >
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
                <th>نام خانوادگی</th>
                <th>کد ملی</th>
                <th>شماره تماس</th>
                <th>ویرایش</th>
            </tr>
            @php $counter = 1 ; @endphp
            @foreach($students as $student)
                <tr>
                    <td>{{$counter++}}</td>
                    <td>{{$student->FName}}</td>
                    <td>{{$student->LName}}</td>
                    <td>{{$student->NIN}}</td>
                    <td>{{$student->Tel}}</td>
                    <td><a href="{{route('student.edit', $student->id)}}" class=" text-decoration-none"> <i class="fas fa-edit"></i></a></td>
                    <!--td>
                        <a href="{{route('student.destroy', $student->id)}}" class="text-decoration-none text-danger" onclick="destroyUser(event, {{$student->id}})">حذف</a>

                        <form action="{{route('student.destroy', $student->id)}}" method="post" id="delete-student-{{$student->id}}">
                            @csrf
                            @method('delete')
                        </form>
                    </td-->
                </tr>
            @endforeach

            </tbody>
        </table>

        {{  $students->links()  }}

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


    <script>
        function destroyUser(event, id){
            event.preventDefault();
            Swal.fire({
                title: 'حذف کاربر',
                text: "آیا از حذف کاربر مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'بله, مطمئن هستم!',
                cancelButtonText: 'نه حذف نکن'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('#delete-student-'+id).submit();
                }
            })

        }

    </script>

@endsection
