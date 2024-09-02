$(document).ready( function () {
    var table = $('#tableDashboard').DataTable({
    });

    increaseNumberAnim('saldo', saldo);
    increaseNumberAnim('pemasukan', pemasukan ?? 0);
    increaseNumberAnim('pengeluaran', pengeluaran ?? 0);

    $('#customFilter').on('change', function() {
        var selectedValue = $(this).val();
        table.column(3).search(selectedValue).draw(); // Filter on the 3rd column (Office)
    });
} );

function increaseNumberAnim(elementid, endNumber, speed = 0.001) {
    let element = document.getElementById(elementid);

    if (!element) return

    let animationRunning = JSON.parse(element.dataset.animationRunning ?? false)

    if (animationRunning) return

    incNbrRec(endNumber <= 0 ? endNumber : endNumber - 150, endNumber, element, speed)
}

function incNbrRec(currentNumber, endNumber, element, speed) {
    if (currentNumber <= endNumber) {
        element.innerHTML = `${formatToRupiah(currentNumber)}`;
        setTimeout(() => {
            incNbrRec(currentNumber + 1, endNumber, element, speed)
        }, speed);
    }
    else {
        element.dataset.animationRunning = false;
    }
}

function formatToRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0 // Change this if you want decimal places
    }).format(number);
}
