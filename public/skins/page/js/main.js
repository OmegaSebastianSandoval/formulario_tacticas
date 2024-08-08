var videos = [];
$(document).ready(function () {
  $(".dropdown-toggle").dropdown();
  $(".carouselsection").carousel({
    quantity: 4,
    sizes: {
      900: 3,
      500: 1,
    },
  });

  $(".banner-video-youtube").each(function () {
    // console.log($(this).attr('data-video'));
    const datavideo = $(this).attr("data-video");
    const idvideo = $(this).attr("id");
    const playerDefaults = {
      autoplay: 0,
      autohide: 1,
      modestbranding: 0,
      rel: 0,
      showinfo: 0,
      controls: 0,
      disablekb: 1,
      enablejsapi: 0,
      iv_load_policy: 3,
    };
    const video = {
      videoId: datavideo,
      suggestedQuality: "hd1080",
    };
    videos[videos.length] = new YT.Player(idvideo, {
      videoId: datavideo,
      playerVars: playerDefaults,
      events: {
        onReady: onAutoPlay,
        onStateChange: onFinish,
      },
    });
  });

  function onAutoPlay(event) {
    event.target.playVideo();
    event.target.mute();
  }

  function onFinish(event) {
    if (event.data === 0) {
      event.target.playVideo();
    }
  }
  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
  );

  $(".switch-form").bootstrapSwitch({
    onText: "Si",
    offText: "No",
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.getElementById("form-ingreso");
  const fechaNacimientoInput = document.getElementById(
    "ingreso_fecha_nacimiento"
  );
  const edadInput = document.getElementById("ingreso_edad");

  fechaNacimientoInput.addEventListener("input", calcularEdad);

  function calcularEdad() {
    const fechaNacimiento = new Date(fechaNacimientoInput.value);
    if (isNaN(fechaNacimiento)) {
      edadInput.value = "";
      return;
    }

    const hoy = new Date();
    let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const mes = hoy.getMonth() - fechaNacimiento.getMonth();

    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
      edad--;
    }

    edadInput.value = edad >= 0 ? edad : "";
  }

  formulario.addEventListener("submit", (event) => {
    const recaptchaResponse = grecaptcha.getResponse();
    if (recaptchaResponse.length === 0) {
      event.preventDefault();
      Swal.fire({
        title: "Error",
        text: "Por favor, verifica el captcha antes de enviar el formulario.",
        icon: "info",
        confirmButtonText: "Continuar",
        confirmButtonColor: "#19A9C9",
      });
    }
  });

  const cedulaInput = document.getElementById("ingreso_cedula");
  const tooltip = document.querySelector(".tooltip1");

  cedulaInput.addEventListener("input", () => {
    console.log(cedulaInput.value);
    if (cedulaInput.value.length > 7) {
      fetch(`/page/index/validarcedula/?cc=${cedulaInput.value}`)
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "error") {
            tooltip.classList.add("active");
            disableAllInputs();
          } else {
            // In case you want to re-enable the inputs if the status is not "error"
            enableAllInputs();
          }
        });
    }
  });

  function disableAllInputs() {
    const inputs = document.querySelectorAll(
      "input, select, button[type='submit']"
    );
    inputs.forEach((element) => {
      if (element.id !== "ingreso_cedula") {
        element.disabled = true;
      }
    });
  }

  function enableAllInputs() {
    const inputs = document.querySelectorAll(
      "input, select, button[type='submit']"
    );
    inputs.forEach((element) => {
      element.disabled = false;
    });
  }

  //ocultar o mostrar campo de pareja
  const estadoCivil = document.getElementById("ingreso_estado_civil");
  const contenedorPareja = document.getElementById("contenedor-input-pareja");

  estadoCivil.addEventListener("change", () => {
    if (estadoCivil.value === "Casado") {
      contenedorPareja.classList.remove("d-none");
    } else {
      contenedorPareja.classList.add("d-none");
    }
  });
});
