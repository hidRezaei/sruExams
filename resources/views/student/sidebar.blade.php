
<div id="mySlidenav" class="slidenav">
    <p class="logo"><span>S</span>ruExams</p>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-eye"></i></span>
        نمایش وب سایت
    </a>
    <a href="{{route('student.home')}}" class="icon-a">
        <span class="icon"><i class="fas fa-home"></i></span>
        خانه
    </a>
    @php
        $dorehClass = new \App\Models\Doreh();
        $dLoc = '1';
        $sLoc = '1';
        $answerView = 0;
        if($activeDorehInfo = $dorehClass->getActiveDorehStep())
        {
            $dLoc = $activeDorehInfo->DorehTitle;
            $sLoc = /*'M'.*/$activeDorehInfo->StepTitle;
            $answerView = $activeDorehInfo->AnswerView ;
        }
    @endphp
    <a href="{{route('student.answerPage',['dl'=>$dLoc,'sl'=>$sLoc,'viewST'=>$answerView])}}" class="icon-a">
        <span class="icon"><i class="fas fa-users"></i></span>
        مشاهده پاسخنامه
    </a>
    <a href="{{route('student.karnamePage')}}" class="icon-a">
        <span class="icon"><i class="fas fa-users"></i></span>
        مشاهده کارنامه
    </a>
    <a href="{{route('student.profile',auth('student')->id())}}" class="icon-a">
        <span class="icon"><i class="fas fa-users"></i></span>
        پروفایل
    </a>
    <a href="{{route('student.message.index',auth('student')->id())}}" class="icon-a">
        <span class="icon"><i class="fas fa-comment-alt"></i></span>
        اعتراض ها
    </a>
    <!--a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-laptop-house"></i></span>
        خانه
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-address-card"></i></span>
        درباره ما
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-book-open"></i></span>
        مقدمه
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-cogs"></i></span>
        خدمات
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-user-friends"></i></span>
        تیم
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-images"></i></span>
        نمونه کارها
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-comment-alt"></i></span>
        نظرات مشتریان
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-headset"></i></span>
        سوالات متداول
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-clipboard-list"></i></span>
        فوتر
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-comment"></i></span>
        نظرات
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-users"></i></span>
        پیام کاربران
    </a>
    <a href="#" class="icon-a">
        <span class="icon"><i class="fas fa-blog"></i></span>
        بلاگ
    </a-->
</div>
