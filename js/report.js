function submitStep1(imageNumber) {
    var step1 = document.getElementById('step1');
    var step2 = document.getElementById('step2');
    var line1 = document.getElementById('line1');
    var cir2 = document.getElementById('cir2');

    step1.classList.add('d-none');
    step2.classList.remove('d-none');
    line1.classList.add('bg-success');
    cir2.classList.add('bg-success');

    var form = document.getElementById('imageForm');
    form.imageChoice.value = imageNumber;
}

function submitStep2(imageNumber) {
    var step2 = document.getElementById('step2');
    var step3 = document.getElementById('step3');
    var line2 = document.getElementById('line2');
    var cir3 = document.getElementById('cir3');

    step2.classList.add('d-none');
    
    step3.classList.remove('d-none');
    line2.classList.remove('bg-secondary');
    cir3.classList.remove('bg-secondary');
    line2.classList.add('bg-success');
    cir3.classList.add('bg-success');
}

function inputRoom()
{
    var step2b = document.getElementById('step2+');
    step2b.classList.remove('d-none');
    document.getElementById('room').disabled = false;
    document.getElementById('room').required = true;
}

$('input[type=radio][name=Radios]').change(function () {
    if (this.value === 'option10') {
        $('#otherInput').prop('disabled', false);
    } else {
        $('#otherInput').prop('disabled', true).val('');
    }
})
