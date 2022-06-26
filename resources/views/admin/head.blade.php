<div class="head">
    <div class="col-div-6">
                <span class="nav">
                    <i class="fas fa-bars"></i>
                </span>
        <span class="nav2">
                    داشبورد
                </span>
    </div>
    <div class="col-div-6">
        <div class="prof-admin">
            <div class="profile">
                <p>سلام فرزاد معصومی خوش اومدی , <span>شما مدیر هستید.</span>
                    <span style="cursor: pointer;color:#FFFFFF" onclick="logoutUser()">خروج</span>

                    <form action="{{route('logout')}}" method="post" id="logout">
                        @csrf
                    </form>
                </p>
            </div>
        </div>
    </div>
</div>
