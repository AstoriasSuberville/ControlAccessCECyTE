document.addEventListener("DOMContentLoaded", () => {
	const $resultados = document.getElementById("resultado");
	Quagga.init({
		inputStream: {
			constraints: {
				width: 250,
				height: 250,
			},
			name: "Live",
			type: "LiveStream",
			target: document.getElementById('video'), // Pasar el elemento del DOM
		},
		decoder: {
			readers: ["ean_reader"]
		}
	}, function (err) {
		if (err) {
			console.log(err);
			return
		}
		console.log("Iniciado correctamente");
		Quagga.start();
	});

	Quagga.onDetected((data) => {
		$resultados.textContent = data.codeResult.code;
		// Imprimimos todo el data para que puedas depurar
		console.log(data);
	});
});