<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Ordre de Mission {{ $mission->serial_number }} </title>
</head>
<style>
    body {
        font-family: 'cairo_font';
        font-size: 12px;
        margin: 0;
        padding: 0;
    }
    .box { 
        width: 70%; 
        margin: 0 auto; 
        text-align: center; 
        line-height: .3;
    }
    .mission-title{
        background: #d9d9d9;
        border: 1px solid;
        margin-bottom: 30px;
    }
    .line{
        border: 1px solid;
        padding: 0 5px;
    }
    .col-3 {
        float: right;
        width: 25%;
        margin: 0;
        line-height: .1;
        padding: 0;
        text-align: center;
    }
    .col-1 {
        float: right;
        width: 5%;
        line-height: .1;
        margin: 0;
        padding: 0;
        text-align: center;
    }
    .gap{
        float: left;
        width: 5%;
    }
    .col-9 {
        float: right;
        line-height: .1;
        width: 70%;
        margin: 0;
        padding: 0;
        /* text-align: center; */
    }
    .col-6 {
        float: right;
        width: 45%;
         /* Add a gap between the two columns */
    }

    .col-12{
        width: 100%;
        float: right;
    }
</style>
<body>
    <div class="col-12">
        
        <div class="col-6" >
            <div class="">
                <div class="box" style="margin-bottom: 5px">
                    <img src="{{ public_path('build/images/logo-lg-nav.png') }}" alt="" height="100" style="margin-block:20px">
                </div>
                <div class="box mission-title">
                    <h4 class="mb-0 text-capitalize">رخصة عادية لاستعمال</h4>
                    <h4 class=" mb-0  text-capitalize">سيارات الدولة</h4>
                    <h4 class=" mb-0 fw-bold text-capitalize d-flex justify-content-center align-items-center ">{{ $mission->serial_number }}</h4>
                </div>
                <div class="line" style="border-bottom: none;">
                    <div class="col-3">
                        <p>رقم السيارة</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p>{{ $mission->car->number }}</p>
                    </div>
                </div>
                <div class="line">
                    <div class="col-3" >
                        <p>نوع السيارة</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p>{{ $mission->car->model }}</p>
                    </div>
                </div>
                <br>
                <div class="line"  style="border-bottom: none;">
                    <div class="col-3">
                        <p>خاصة بالسيد</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p>{{ $mission->agent }}</p>
                    </div>
                </div>
                <div class="line">
                    <div class="col-3">
                        <p>المهمة</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p>{{ $mission->type }}</p>
                    </div>
                </div>
                <br>
                <div class="line"  style="border-bottom: none;">
                    <div class="col-3">
                        <p>إسم السائق</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p>{{ $mission->driver->name }}</p>
                    </div>
                </div>
                <div class="line">
                    <div class="col-3">
                        <p>منطقة الإستعمال</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <div class="col-12">
                            <div class="col-6">
                                <p> {{ $mission->des_coll_terr}} - {{ $mission->desVille->ville }} </p>
                            </div>
                            <div class="col-6">
                                <p> {{ $mission->dep_coll_terr}} - {{ $mission->depVille->ville }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="line">
                    <div class="col-3">
                        <p>مدة الصلاحية</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <div class="col-12">
                            <div class="col-6">
                                @php
                                    $start = new \DateTime($mission->start_date);
                                @endphp
                                <p> من {{ $start->format('Y/m/d') }}</p>
                            </div>
                            <div class="col-6">
                                @php
                                    $end = new \DateTime($mission->end_date);
                                @endphp
                                <p> إلى {{ $end->format('Y/m/d') }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="line">
                    <div class="col-3">
                        <p>المسموح لهم بالركوب</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p style="font-weight: bold">{{ $mission->permission }}</p>
                    </div>
                </div>
                <br>
                <div class="line">
                    <div class="col-3">
                        <p>التاريخ</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        @php
                            $date = new \DateTime($mission->created_at);
                        @endphp
                        <p>{{ $date->format('Y/m/d') }}</p>
                    </div>
                </div>
                <br>
                <div class="line">
                    <div class="col-3">
                        <p>الإمضاء</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9" style="height: 100%">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6" style="margin-right: 10%">
            <div class="">
                <div class="box" style="margin-bottom: 5px">
                    <img src="{{ public_path('build/images/logo-lg-nav.png') }}" alt="" height="100" style="margin-block:20px">
                </div>
                <div class="box mission-title">
                    <h4 class="mb-0 text-capitalize">رخصة عادية لاستعمال</h4>
                    <h4 class=" mb-0  text-capitalize">سيارات الدولة</h4>
                    <h4 class=" mb-0 fw-bold text-capitalize d-flex justify-content-center align-items-center ">{{ $mission->serial_number }}</h4>
                </div>
                <div class="line" style="border-bottom: none;">
                    <div class="col-3">
                        <p>رقم السيارة</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p>{{ $mission->car->number }}</p>
                    </div>
                </div>
                <div class="line">
                    <div class="col-3" >
                        <p>نوع السيارة</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p>{{ $mission->car->model }}</p>
                    </div>
                </div>
                <br>
                <div class="line"  style="border-bottom: none;">
                    <div class="col-3">
                        <p>خاصة بالسيد</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p>{{ $mission->agent }}</p>
                    </div>
                </div>
                <div class="line">
                    <div class="col-3">
                        <p>المهمة</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p>{{ $mission->type }}</p>
                    </div>
                </div>
                <br>
                <div class="line"  style="border-bottom: none;">
                    <div class="col-3">
                        <p>إسم السائق</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p>{{ $mission->driver->name }}</p>
                    </div>
                </div>
                <div class="line">
                    <div class="col-3">
                        <p>منطقة الإستعمال</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <div class="col-12">
                            <div class="col-6">
                                <p> {{ $mission->des_coll_terr}} - {{ $mission->desVille->ville }} </p>
                            </div>
                            <div class="col-6">
                                <p> {{ $mission->dep_coll_terr}} - {{ $mission->depVille->ville }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="line">
                    <div class="col-3">
                        <p>مدة الصلاحية</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <div class="col-12">
                            <div class="col-6">
                                @php
                                    $start = new \DateTime($mission->start_date);
                                @endphp
                                <p> من {{ $start->format('Y/m/d') }}</p>
                            </div>
                            <div class="col-6">
                                @php
                                    $end = new \DateTime($mission->end_date);
                                @endphp
                                <p> إلى {{ $end->format('Y/m/d') }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="line">
                    <div class="col-3">
                        <p>المسموح لهم بالركوب</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        <p style="font-weight: bold">{{ $mission->permission }}</p>
                    </div>
                </div>
                <br>
                <div class="line">
                    <div class="col-3">
                        <p>التاريخ</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9">
                        @php
                            $date = new \DateTime($mission->created_at);
                        @endphp
                        <p>{{ $date->format('Y/m/d') }}</p>
                    </div>
                </div>
                <br>
                <div class="line">
                    <div class="col-3">
                        <p>الإمضاء</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-9" style="height: 100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>