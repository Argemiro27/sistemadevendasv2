const forma_pagamento = document.getElementById("forma_pagamento");
const parceladoCampo = document.getElementById("parcelado-campo");
forma_pagamento.addEventListener("change", function () {
  if (this.value === "Parcelado") {
    parceladoCampo.style.display = "block";
  } else {
    parceladoCampo.style.display = "none";
  }
});
