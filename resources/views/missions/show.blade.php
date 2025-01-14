@extends('layouts.master')
@section('title')
    @lang('translation.showMission')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        <a href="{{ url("/mission") }}">
            @lang("translation.mission")
        </a>
        @endslot
        @slot('title')
            @lang("translation.showMission")
        @endslot
    @endcomponent

    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center justify-content-center d-flex flex-column">
                    <img src="{{ URL::asset('build/images/logo-lg-nav.png') }}" alt="" height="100" style="margin-block:20px">
                    <div class="task-title-bg d-flex flex-column justify-content-center align-items-center w-50 py-3">
                        <h4 class="mb-0 text-capitalize">رخصة عادية لاستعمال</h4>
                        <h4 class=" mb-0  text-capitalize">سيارات الدولة</h4>
                        <h4 class=" mb-0 fw-bold text-capitalize d-flex justify-content-center align-items-center ">
                            {{ $mission->serial_number }}
                        </h4>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="row" dir="rtl" class="fw-bold">
                        <div class="live-preview">
                            <div class="card-body border">
                                <div class="row mb-2">
                                    <div class="col-lg-3">
                                        <label for="choices-single-default" class="form-label">موقع :    </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <p class=" mb-0 text-capitalize">{{ $mission->car->site }}</p>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">رقـــــــم السيارة   :  </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <p class=" mb-0 text-capitalize">{{ $mission->car->number }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="websiteUrl" class="form-label">نوع السيارة    :    </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <p class=" mb-0 text-capitalize">{{ $mission->car->model }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body mt-3 border">
                                <div class="row mb-2">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">خـاصة بالسيـــد :  </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <p class=" mb-0 text-capitalize">{{ $mission->agent }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="websiteUrl" class="form-label">المهمـــــــــــــة          :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <p class=" mb-0 text-capitalize">{{ $mission->type }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body mt-3 border">
                                <div class="row mb-2">
                                    <div class="col-lg-3">
                                        <label for="dateInput" class="form-label">إســم السائـــــق :     </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <p class=" mb-0 text-capitalize">{{ $mission->driver->name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="timeInput" class="form-label">منطقة الإستعمال :  </label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="depart">نقطة الانطلاق : </label>
                                            </div>
                                            <div class="col-md-5">
                                                <p class=" mb-0 text-capitalize">{{ $mission->depVille->ville }}</p>
                                            </div>
                                            <div class="col-md-5">
                                                <p class=" mb-0 text-capitalize">{{ $mission->dep_coll_terr }}</p>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-2">
                                                <label for="destination">نقطة الوصول : </label>
                                            </div>
                                            <div class="col-md-5">
                                                <p class=" mb-0 text-capitalize">{{ $mission->desVille->ville }}</p>
                                            </div>
                                            <div class="col-md-5">
                                                <p class=" mb-0 text-capitalize">{{ $mission->des_coll_terr }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body mt-3 border">
                                <div class="row mb-2">
                                    <div class="col-lg-2">
                                        <label for="dateInput" class="form-label">مدة الصلاحية  :</label>
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="from">من :</label>
                                    </div>
                                    <div class="col-lg-4">
                                        @php
                                            $start_date = new \DateTime($mission->start_date);
                                        @endphp
                                        <p class=" mb-0 text-capitalize">{{ $start_date->format('Y/m/d') }}</p>
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="from">إلى :</label>
                                    </div>
                                    <div class="col-lg-4">
                                        @php
                                            $end_date = new \DateTime($mission->end_date);
                                        @endphp
                                        <p class=" mb-0 text-capitalize">{{ $end_date->format('Y/m/d') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body mt-3 border">
                                <div class="row mb-2">
                                    <div class="col-lg-3">
                                        <label for="dateInput" class="form-label">  المســـموح لهم بالركــوب :</label>
                                    </div>
                                    <div class="col-lg-9 fw-bold">
                                        <p class=" mb-0 text-capitalize">{{ $mission->permission }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body mt-3 border">
                                <div class="row mb-2">
                                    <div class="col-lg-3">
                                        <label for="dateInput" class="form-label">     التـــاريخ   :</label>
                                    </div>
                                    <div class="col-lg-9 fw-bold">
                                        @php
                                            $date = new \DateTime($mission->created_at);
                                        @endphp
                                        <p class=" mb-0 text-capitalize">{{ $date->format('Y/m/d') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body mt-3 border">
                                <div class="row mb-2">
                                    <div class="col-lg-3">
                                        <label for="dateInput" class="form-label">المبلغ المخصص للمهمة :</label>
                                    </div>
                                    <div class="col-lg-9 d-flex border-0">
                                        <p class=" mb-0 text-capitalize">{{ number_format($mission->avance, 2) }} MAD</p>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-3">
                                        <label for="dateInput" class="form-label">الباقي :</label>
                                    </div>
                                    <div class="col-lg-9 d-flex border-0">
                                        <p class=" mb-0 text-capitalize">{{ number_format($mission->reste, 2) }} MAD</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
