function submitStep1() 
{
    step1.classList.add('d-none');
    step2.classList.remove('d-none');
}

function submitStep2(id, name) 
{
    step2.classList.add('d-none');
    step3.classList.remove('d-none');

    document.getElementById('chooseRID').value = id;
    document.getElementById('chooseRname').value = name;
}