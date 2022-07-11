<div class="head">
    <div class="col-div-1" style="width: 40%">
                <span class="nav">
                    <i class="fas fa-bars"></i>
                </span>
    </div>
    <div class="col-div-11" style="width: 60%">

        <div class="prof-admin">
            <div class="profile" style="text-align: left;">
                <img  src="{{asset('images/logo3.png')}}" width="80" style="float: left;margin-right:20px" />
                <p> سلام کاربر <font style="color:yellow" >{{auth()->user()->FName .' '.auth()->user()->LName }}</font>  خوش آمدید
                    <br/><span style="color:white">شما دانش آموز هستید.</span>
                    <span style="cursor: pointer;color:red" onclick="logoutUser()">خروج</span>

                    <form action="{{route('student.logout')}}" method="post" id="logout">
                        @csrf
                    </form>
                </p>
            </div>
        </div>
    </div>
</div>
