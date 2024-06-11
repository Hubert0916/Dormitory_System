function submitStep1(imageOption) {
    step1.classList.add('d-none');
    step2.classList.remove('d-none');
    document.getElementById('imageChoice').value = imageOption;
}

function submitStep2(option) {
    step2.classList.add('d-none');

    if (option == 'a') {
        step4a.classList.remove('d-none');
    }

    else if (option == 'b') {
        step3b.classList.remove('d-none');
        document.getElementById('room').disabled = false;
        document.getElementById('room').required = true;
    }

    else if (option == 'c') {
        step3c.classList.remove('d-none');
        document.getElementById('chooserm').disabled = false;
    }
}

function submitStep3(number, id = -1) {
    if (id !== -1) {
        document.getElementById('chooserm').value = id;
    }
    var step3 = document.getElementById('step3' + number);
    var step4 = document.getElementById('step4' + number);
    step3.classList.add('d-none');
    step4.classList.remove('d-none');

}

function back4atoStep2() {
    step4a.classList.add('d-none');
    step2.classList.remove('d-none');
    document.getElementById('a').value = '';
}

function back4btoStep3b() {
    step4b.classList.add('d-none');
    step3b.classList.remove('d-none');
    document.getElementById('b').value = '';
}

function back4ctoStep3c() {
    document.getElementById('chooserm').value = null;
    step4c.classList.add('d-none');
    step3c.classList.remove('d-none');
    document.getElementById('c').value = '';
}

function backtoStep1() {
    step1.classList.remove('d-none');
    step2.classList.add('d-none');
}

function back3btoStep2() {
    step2.classList.remove('d-none');
    step3b.classList.add('d-none');
    document.getElementById('room').disabled = true;
    document.getElementById('room').required = false;
}

function back3ctoStep2() {
    step2.classList.remove('d-none');
    step3c.classList.add('d-none');
}

function Message() {
    preventDefault();

    Swal.fire({
        icon: 'success',
        title: '恭喜! 舉報成功',
        text: '謝謝伸張宿舍正義!',
        confirmButtonText: "OK",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('reportForm').submit();
        }
    })
}

