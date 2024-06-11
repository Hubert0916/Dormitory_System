function submitStep1(option) {
    step1.classList.add('d-none');
    if (option == 'a') {
        step2a.classList.remove('d-none');
    }
    else {
        step2b.classList.remove('d-none');
    }
}

function submitStep2a(id, name) {
    step2a.classList.add('d-none');
    step3.classList.remove('d-none');

    document.getElementById('chooseRID').value = id;
    document.getElementById('chooseRname').value = name;
}

function backtoStep1(option) {
    if (option == 'a')
        step2a.classList.add('d-none');
    else
        step2b.classList.add('d-none');
    step1.classList.remove('d-none');
}

function backtoStep2() {

    step2a.classList.remove('d-none');
    step3.classList.add('d-none');
}

function filterTable() {
    var input, filter, table, tr, th, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("ratingTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        th = tr[i].getElementsByTagName("th")[0];
        if (th) {
            txtValue = th.textContent || th.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function Message(e) {
    e.preventDefault();

    Swal.fire({
        icon: 'success',
        title: '恭喜! 評分成功',
        text: '你是品頭論足高手!',
        confirmButtonText: "OK",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('ratingForm').submit();
        }
    })
}