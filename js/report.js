function submitStep1(imageOption) {
    var step1 = document.getElementById('step1');
    var step2 = document.getElementById('step2');
    var line1 = document.getElementById('line1');
    var cir2 = document.getElementById('cir2');
    step1.classList.add('d-none');
    step2.classList.remove('d-none');
    line1.classList.add('bg-success');
    cir2.classList.add('bg-success');

    document.getElementById('imageChoice').value = imageOption;
}

function submitStep2(option) {
    var step2 = document.getElementById('step2');
    var line2 = document.getElementById('line2');
    var cir3 = document.getElementById('cir3');
    line2.classList.remove('bg-secondary');
    line2.classList.add('bg-success');
    cir3.classList.remove('bg-secondary');
    cir3.classList.add('bg-success');
    step2.classList.add('d-none');

    if (option == 'a') {
        var line3 = document.getElementById('line3');
        var cir4 = document.getElementById('cir4');
        line3.classList.remove('bg-secondary');
        line3.classList.add('bg-success');
        cir4.classList.remove('bg-secondary');
        cir4.classList.add('bg-success');
        var step4 = document.getElementById('step4');
        step4.classList.remove('d-none');
        document.getElementById('reportID').required = false;
    }

    else if (option == 'b') {
        var step3b = document.getElementById('step3b');
        step3b.classList.remove('d-none');
        document.getElementById('room').disabled = false;
        document.getElementById('room').required = true;
        document.getElementById('reportID').required = false;
    }

    else if (option == 'c') {
        var step3c = document.getElementById('step3c');
        step3c.classList.remove('d-none');
    }
}

function submitStep3(number, id) {

    var step3 = document.getElementById('step3' + number);
    var step4 = document.getElementById('step4');
    var line3 = document.getElementById('line3');
    var cir4 = document.getElementById('cir4');
    line3.classList.remove('bg-secondary');
    line3.classList.add('bg-success');
    cir4.classList.remove('bg-secondary');
    cir4.classList.add('bg-success');
    step3.classList.add('d-none');
    step4.classList.remove('d-none');

    if (id !== -1) {
        document.getElementById('chooserm').value = id;
    }
}

$('input[type=radio][name=Radios]').change(function () {
    if (this.value === 'other') {
        $('#other').prop('disabled', false);
        $('#other').prop('required', true);
    } else {
        $('#other').prop('disabled', true).val('');
    }
})
