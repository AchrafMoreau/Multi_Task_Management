
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let JsonCar = [];
document.addEventListener('DOMContentLoaded', () => {
    $.get('/cars-json', function(res){
        JsonCar = res;
    })
    model.addEventListener('change', (e) => {
        allChoices = carVal?.config?.choices;
        const optionMatch = allChoices.filter(elm => elm.customProperties == modelVal.getValue(true));
        console.log(optionMatch)
        if(optionMatch.length > 0){
            carVal.clearStore(); 
            carVal.setChoices(optionMatch, 'value', 'label', false);
        }else{
            carVal.setChoices(carVal?.config?.choices);
        }
    });

    car.addEventListener('change', (e) => {
        modelVal.setChoiceByValue(carVal.getValue().customProperties)
    });

    carSite.addEventListener('change', (e) => {
        const filterd = JsonCar.filter((elm) => elm.site == e.target.value).map(elm => ({
            customProperties : elm.model,
            disabled : false,
            label: elm.number,
            placeholder: false,
            selected: false,
            value: elm.id
        }))
        if(filterd.length > 0){
            carVal.clearStore(); 
            carVal.setChoices(filterd, 'value', 'label', false);
            modelVal.clearStore();
            let modelList = Object.keys(Object.groupBy(filterd, ({customProperties}) => customProperties)).map(elm => ({
                disabled : false,
                label: elm,
                placeholder: false,
                selected: false,
                value: elm
            }));
            modelVal.setChoices(modelList, 'value', 'label', false)
        }else{
            carVal.clearStore();
            carVal.setChoices(carVal?.config?.choices);
            modelVal.clearStore();
            modelVal.setChoices(modelVal?.config?.choices);
        }
    });

    const check = document.getElementsByName('driverMission');
    check.forEach(elm => {
        elm.addEventListener('change', function(e){
            if(e.target.checked && e.target.value == 'Yes'){
                document.getElementById("agent").disabled = true;
            }else{
                document.getElementById("agent").disabled = false;
            }
        })
    }
    );

});


$('#addMission').on('submit', (e) => handelSubmit(e, 'POST', '/mission'));
const handelSubmit = (e, method, url) => {
    e.preventDefault()
    const form = e.target;
    const button = e.originalEvent.submitter.innerHTML;
    const data = {
        serial_number : document.getElementById('serial_number').value,
        car : form.elements['car'].value,
        agent : document.querySelector('[name="driverMission"][value="Yes"]').checked ? driverVal.getValue().label : form.elements['agent'].value ,
        type:  form.elements['type'].value,
        driver : form.elements['driver'].value,
        date_start : form.elements['date_start'].value,
        date_end : form.elements['date_end'].value,
        avance : form.elements['avance'].value,
        reste: form.elements['reste'].value,
        dep_coll_terr : form.elements['dep-coll-terr'].value,
        des_coll_terr : form.elements['des-coll-terr'].value,
        des_ville : form.elements['des-ville'].value,
        dep_ville : form.elements['dep-ville'].value,
        permission: form.elements['permission'].value,
        download: e.originalEvent.submitter.value == "save&download" ? true : false
    }
    $.ajax({
        url: url,
        type: method,
        data,
        headers:{
            'X-CSRF-TOKEN' : token,
        },
        beforeSend: ()=>{

            e.originalEvent.submitter.innerHTML = `
                <div style='width:1rem; height:1rem;' class="spinner-border text-white" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            `;
        },
        complete: ()=>{
            // e.originalEvent.submitter.innerHTML = "@lang('translation.submit')";
            e.originalEvent.submitter.innerHTML = button;
        },
        success: (res) => {
            toastr[res.alert_type](res.message);
            console.log(res)
            // if(res.download_url){
            //     const iframe = document.createElement('iframe');
            //     iframe.style.display = 'none';
            //     iframe.src = res.download_url;
            //     document.body.appendChild(iframe);
            //     setTimeout(() => {
            //         window.location.href = "/mission";
            //     }, 1000);
            //     return;
            // }
            window.location.href = "/mission";
        },
        error: (e) =>{
            const errorMessage = e.responseJSON.message
            if(errorMessage.startsWith("validation.required")){
                toastr.error(
                    `<div dir='rtl'>
                    <strong>${window.translations.fieldRequired}</strong><br>
                    - رقم السيارة<br>
                    - خـاصة بالسيـــد <br>
                    - المهمـــــــــــــة<br>
                    - إســم السائـــــق<br>
                    - مدة الصلاحية<br>
                    - المبلغ المخصص للمهمة<br>
                    - نقطة الانطلاق<br>
                    - نقطة الوصول<br>
                    - المســـموح لهم بالركــوب<br>
                    </div>
                    `
                );

            }else{
                toastr.error(`${window.translations.somethingWrong} :(`, errorMessage);
            }


        }
    })
}
