const readBarcode = (barcode) => {
    const data = new FormData();
    data.append('barcode', barcode);
    fetch(`${APP_URL}/api/register-access.php`, {
        headers: new Headers(),
        method: 'POST',
        body: data
    })
        .then(res => res.json())
        .then(res => callback(res));
}

const callback = (res) => {
    if (res.code == "200") {
        Swal.fire({
            position: 'center-center',
            icon: 'success',
            title: res.message,
            showConfirmButton: true,
            timer: 5000
        })
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Ocurrio un error inesperado...',
            text: res.message
        })
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const $codigo = document.querySelector("#codigo");
    $codigo.addEventListener("keydown", evento => {
        if (evento.keyCode === 13) {
            // El lector ya terminó de leer
            const barcode = $codigo.value;
            readBarcode(barcode);
            console.log("Tenemos un código de barras:");
            console.log(codigoDeBarras);
            $codigo.value = "";
        }
    });
});