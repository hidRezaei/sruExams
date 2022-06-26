@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>دانش آموزان</h2>
        <a href="{{route('student.create')}}" ><button type="button" class="btn btn-primary btn-sm">جدید</button></a>
        <table class="mb-5">
            <tbody>
            <tr>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>کد ملی</th>
                <th>تاریخ عضویت</th>
                <th>ویرایش</th>
                <th>حذف</th>
            </tr>

            @foreach($students as $student)
                <tr>
                    <td>{{$student->FName}}</td>
                    <td>{{$student->LName}}</td>
                    <td>{{$student->CodeMeli}}</td>
                    <td>{{$student->Jalali()}}</td>
                    <td><a href="{{route('student.edit', $student->id)}}" class=" text-decoration-none"> <i class="fas fa-edit"></i></a></td>
                    <td>
                        <a href="{{route('student.destroy', $student->id)}}" class="text-decoration-none text-danger" onclick="destroyUser(event, {{$student->id}})">حذف</a>

                        <form action="{{route('student.destroy', $student->id)}}" method="post" id="delete-student-{{$student->id}}">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
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
                title: 'تبریک میگم',
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
