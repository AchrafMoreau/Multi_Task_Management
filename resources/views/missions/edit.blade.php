@extends('layouts.master')
@section('title')
    @lang('translation.editMission')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        <a href="{{ url("/mission") }}">
            @lang("translation.mission")
        </a>
        @endslot
        @slot('title')
            @lang("translation.editMission")
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
                            @php
                                $id = substr($mission->serial_number, 0, -5);
                            @endphp
                            <input type="number" class="serail_number" id="serial_number" value="{{ $id }}" name="serial_number"> / {{ date('Y') }}
                        </h4>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <form id="editMission" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="row" dir="rtl" class="fw-bold">
                            <div class="live-preview">
                                <div class="card-body border">

                                    <div class="row mb-2">
                                        <div class="col-lg-3">
                                            <label for="choices-single-default" class="form-label">موقع :    </label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="site" 
                                                id="selectSite">
                                                <option value="" selected>إختر موقع السيارة</option>
                                                <option {{ $mission->car->site == "Guelmim" ? 'selected' : '' }} value="Guelmim">Guelmim</option>
                                                <option {{ $mission->car->site == "Ouarzazate" ? 'selected' : '' }} value="Ouarzazate">Ouarzazate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-3">
                                            <label for="nameInput" class="form-label">رقـــــــم السيارة   :  </label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" data-choices name="car"
                                                id="selectCarNumber">
                                                <option value="" selected>إختر رقم السيارة</option>
                                                @foreach($cars as $car)
                                                    <option {{ $mission->car_id == $car->id ? 'selected' : '' }} value="{{ $car->id }}" data-custom-properties="{{ $car->model }}">{{ $car->number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="websiteUrl" class="form-label">نوع السيارة    :    </label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control " data-choices
                                                id="selectCarModel" >
                                                <option value="">إختر نوع السيارة</option>
                                                @foreach($models as $modelName => $carsInGroup)
                                                    <option {{ $mission->car->model == $modelName ? 'selected' : '' }} value="{{ $modelName }}" >{{ $modelName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mt-3 border">
                                    <div class="row mb-2">
                                        <div class="col-lg-3">
                                            <label for="nameInput" class="form-label">خـاصة بالسيـــد :  </label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text"  name="agent" id="agent" value="{{ $mission->agent }}" class="form-control  @error('agent') is-invalid @enderror">
                                            @error('agent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-lg-3">
                                            <label class="form-label" for="driverMission">هل السائـــــق هو صاحب المهمـــــــــــــة :</label>
                                            {{-- <label for="nameInput" class="form-label">خـاصة بالسيـــد :  </label> --}}
                                        </div>
                                        <div class="col-lg-9">
                                                <input class="form-check-input" type="radio" name="driverMission" id="No" value="No" checked>
                                                <label class="form-check-label" style="margin-left: 20px" for="No">لا</label>
                                                <input class="form-check-input" type="radio" name="driverMission" id="Yes"  value="Yes">
                                                <label class="form-check-label" for="Yes">نعم</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="websiteUrl" class="form-label">المهمـــــــــــــة          :</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" value="{{ $mission->type }}" name="type" id="taskType" class="form-control @error('type') is-invalid @enderror">
                                            @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mt-3 border">
                                    <div class="row mb-2">
                                        <div class="col-lg-3">
                                            <label for="dateInput" class="form-label">إســم السائـــــق :     </label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" data-choices name="driver"
                                                id="selectDriver">
                                                <option value="">إختر السائق</option>
                                                @foreach($drivers as $driv)
                                                    <option {{ $mission->driver_id == $driv->id ? 'selected' : '' }} value="{{ $driv->id }}">{{ $driv->name }}</option>
                                                @endforeach
                                            </select>
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
                                                {{-- <div class="col-md-5">
                                                    <select class="form-control" data-choices name="dep-region"
                                                        id="selectDepRegion">
                                                        <option value="">إختر الإقليم</option>
                                                        @foreach($regions as $region)
                                                            <option {{ $mission->depart_region == $region->id ? 'selected' : '' }} value="{{ $region->id }}">{{ $region->region }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                <div class="col-md-5">
                                                    <select class="form-control" data-choices name="dep-ville"
                                                        id="selectDepVille">
                                                        <option value="">إختر المدينة</option>
                                                        @foreach($villes as $vil)
                                                            <option {{ $mission->depart_ville == $vil->id ? "selected" : "" }} value="{{ $vil->id }}">{{ $vil->ville }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" 
                                                        name="dep-coll-terr" 
                                                        id="dep-coll-terr" 
                                                        class="form-control @error('dep_coll_terr') is-invalid @enderror" 
                                                        value="{{ $mission->dep_coll_terr}}"
                                                        placeholder="الجماعة الترابية"
                                                    >
                                                    @error('dep_coll_terr')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-2">
                                                    <label for="destination">نقطة الوصول : </label>
                                                </div>
                                                {{-- <div class="col-md-5">
                                                    <select class="form-control" data-choices name="des-region"
                                                        id="selectDesRegion">
                                                        <option value="">إختر الإقليم</option>
                                                        @foreach($regions as $region)
                                                            <option {{ $mission->destination_region == $region->id ? "selected" : "" }} value="{{ $region->id }}">{{ $region->region }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                <div class="col-md-5">
                                                    <select class="form-control " data-choices name="des-ville"
                                                        id="selectDesVille">
                                                        <option value="">إختر المدينة</option>
                                                        @foreach($villes as $vil)
                                                            <option {{ $mission->destination_ville == $vil->id ? "selected" : "" }} value="{{ $vil->id }}">{{ $vil->ville }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" 
                                                        placeholder="الجماعة الترابية"
                                                        name="des-coll-terr" 
                                                        id="des-coll-terr" 
                                                        class="form-control @error('des_coll_terr') is-invalid @enderror" 
                                                        value="{{ $mission->des_coll_terr}}"
                                                    >
                                                    @error('des_coll_terr')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
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
                                            <input required type="date" class="form-control" value="{{ $mission->start_date }}" name="date_start" data-provider="flatpickr" id="dateInput" data-date-format="Y/m/d">
                                        </div>
                                        <div class="col-lg-1">
                                            <label for="from">إلى :</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input required type="date" class="form-control" name="date_end" value="{{ $mission->end_date }}" data-provider="flatpickr" id="dateInput" data-date-format="Y/m/d">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mt-3 border">
                                    <div class="row mb-2">
                                        <div class="col-lg-3">
                                            <label for="dateInput" class="form-label">  المســـموح لهم بالركــوب :</label>
                                        </div>
                                        <div class="col-lg-9 fw-bold">
                                            <input  type="text" class="form-control fw-bold"  name="permission" value="{{ $mission->permission }}">
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
                                                // dd($date);
                                            @endphp
                                            <input type="date" value="{{ $date->format('Y-m-d') }}" class="form-control" name="todaysDate" data-provider="flatpickr" data-date-format="Y/m/d" id="dateInput">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mt-3 border">
                                    <div class="row mb-2">
                                        <div class="col-lg-3">
                                            <label for="dateInput" class="form-label">المبلغ المخصص للمهمة :</label>
                                        </div>
                                        <div class="col-lg-9 d-flex border-0">
                                            <span class="input-group-text" style="border-radius: 0 5px 5px 0">0.00</span>
                                            <input type="number" class="form-control" value="{{ $mission->avance }}" style="border-radius: 0" name="avance">
                                            <span class="input-group-text"  style="border-radius: 5px 0 0 5px">MAD</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-3">
                                            <label for="dateInput" class="form-label">الباقي :</label>
                                        </div>
                                        <div class="col-lg-9 d-flex border-0">
                                            <span class="input-group-text" style="border-radius: 0 5px 5px 0">0.00</span>
                                            <input type="number" class="form-control" style="border-radius: 0" value="{{ $mission->reste }}" name='reste'>
                                            <span class="input-group-text"  style="border-radius: 5px 0 0 5px">MAD</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 mt-3 justify-content-end">
                                    <div class="">
                                        <button id='save' type="submit" value="save" name="action" class="btn btn-primary">@lang("translation.submit")</button>
                                    </div>
                                    <div class="">
                                        <button  id="save&downLoad" name="action" value="save&download" type="submit" class="btn btn-success">@lang("translation.saveAndDownload")</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!--end col-->
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        window.translations = {
            dragAndDrop: "{{ __('translation.dragAndDrop') }}",
            chose: "{{ __('translation.choose')}}",
            fieldRequired: "{{ __('translation.requiredField') }}",
            somethingWrong: "{{ __('translation.somethingWrong') }}",
        }
    </script>
  
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/store-task.js') }}"></script>

    <script>
        $('#editMission').on('submit', (e) => handelSubmit(e, 'PUT', "/mission/{{ $mission->id }}"));
    </script>
@endsection
