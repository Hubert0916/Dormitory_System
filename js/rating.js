function submitStep1(option) {
    step1.classList.add('d-none');
    if (option == 'a') {
        step2a.classList.remove('d-none');
    }
    else{
        step2b.classList.remove('d-none');
    }
}

function submitStep2a(id, name) {
    step2a.classList.add('d-none');
    step3.classList.remove('d-none');

    document.getElementById('chooseRID').value = id;
    document.getElementById('chooseRname').value = name;
}