// Configurar la biblioteca QuaggaJS
Quagga.init({
	inputStream: {
		name: "Live",
		type: "LiveStream",
		target: document.querySelector("#video"),
		constraints: {
			facingMode: "environment",
		},
	},
	decoder: {
		readers: ["ean_reader"], // Especificar el tipo de código de barras que se quiere leer
	},
});

// Iniciar la lectura de códigos de barras
Quagga.start();

// Manejar los resultados de la lectura de códigos de barras
Quagga.onDetected(function(result) {
	alert("Código de barras detectado: " + result.codeResult.code);
});
