function submitStep1(imageOption) {
    step1.classList.add('d-none');
    step2.classList.remove('d-none');
    document.getElementById('imageChoice').value = imageOption;
}

function submitStep2(option) {
    step2.classList.add('d-none');

    if (option == 'a') {
        step4a.classList.remove('d-none');
        document.getElementById('reportID').required = false;
    }

    else if (option == 'b') {
        step3b.classList.remove('d-none');
        document.getElementById('room').disabled = false;
        document.getElementById('room').required = true;
        document.getElementById('reportID').required = false;
    }

    else if (option == 'c') {
        step3c.classList.remove('d-none');
    }
}

function submitStep3(number, id) {

    var step3 = document.getElementById('step3' + number);
    var step4 = document.getElementById('step4' + number);
    step3.classList.add('d-none');
    step4.classList.remove('d-none');

    if (id !== -1) {
        document.getElementById('chooserm').value = id;
    }
}

function back4atoStep2()
{
    step4a.classList.add('d-none');
    step2.classList.remove('d-none');
}

function back4btoStep3b()
{
    step4b.classList.add('d-none');
    step3b.classList.remove('d-none');
}

function back4ctoStep3c()
{
    step4c.classList.add('d-none');
    step3c.classList.remove('d-none');
}

function backtoStep1() {
    step1.classList.remove('d-none');
    step2.classList.add('d-none');
}

function back3btoStep2() {
    step2.classList.remove('d-none');
    step3b.classList.add('d-none');
}

function back3ctoStep2() {
    step2.classList.remove('d-none');
    step3c.classList.add('d-none');
}


$('input[type=radio][name=Radios]').change(function () {
    if (this.value === 'other') {
        $('#other').prop('disabled', false);
        $('#other').prop('required', true);
    } else {
        $('#other').prop('disabled', true).val('');
    }
})
