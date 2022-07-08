@extends('admin.index')

@section('content')
    <div class="dynamic-content">
        <h2>دانش آموزان</h2>
        <!--a href="{{route('student.create')}}" ><button type="button" class="btn btn-primary btn-sm">جدید</button></a-->
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
