{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}


<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ URL::asset('build/js/plugins.js') }}"></script>
<script>
    var exp = document.getElementById("selectExpediteur"),
        des = document.getElementById("selectDistination"),
        ville = document.getElementById("ville-field"),
        year = document.getElementById('yearSelect'),
        type = document.getElementById('typeSelect'),
        model = document.getElementById("selectCarModel"),
        car = document.getElementById("selectCarNumber"),
        carSite = document.getElementById("selectSite"),
        driver = document.getElementById("selectDriver"),
        monthSelect = document.getElementById("monthSelect");



    if(year){
        var yearVal = new Choices(year, {
            searchEnabled: false,
            itemSelectText: '',
            shouldSort: false,
        })
    }
    if(type){
        new Choices(type, {
            searchEnabled: false,
            itemSelectText: '',
            shouldSort: false,
        });
    }
    if(monthSelect){
        var monthVal = new Choices(monthSelect, {
            searchEnabled: false,
            itemSelectText: '',
            shouldSort: false,
        });

    }

    if(exp){
        var expVal = new Choices(exp),
            desVal = new Choices(des);
    }
    if(ville){
        var villeVal = new Choices(ville);
    }

    if(driver){
        var driverVal = new Choices(driver)
    }
    if(model){
        var modelVal = new Choices(model),
            carVal = new Choices(car),
            carSiteVal = new Choices(carSite, {
                searchEnabled: false,
                itemSelectText: ""
            });
    }
</script>

<script>
    
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        var message = `{!! Session::get('message') !!}`;
        console.log(message);
        
        switch (type) {
            case 'info':
                toastr.info(message);
                break;
            case 'success':
                toastr.success(message);
                break;
            case 'warning':
                toastr.warning(message);
                break;
            case 'error':
                toastr.error(message);
                break;
        }
    @endif

</script>
<?php
    Session::forget('alert-type');
?>
@yield('script')
@yield('script-bottom')
