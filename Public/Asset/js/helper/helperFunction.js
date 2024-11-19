/**
 * Membuat option untuk element select secara dinamis dengan data dari sumber.
 * @param data {Array} data sumber.
 * @param element {HTMLSelectElement} element select yang akan ditambahkan option secara dinamis.
 * @param selectedID {String | false} ID data sumber yang akan di pilih, atur false untuk mengatur ke nilai {defaultContent}.
 * @param defaultContent {String} Nilai default untuk option
 */
export function createOptions(data, element, selectedID, defaultContent= null) {
    element.innerHTML = '';
    const defOption = document.createElement('option');
    if (defaultContent){
        defOption.value = "default";
        defOption.textContent = defaultContent;
        defOption.disabled = true;
        defOption.selected = true;
        element.appendChild(defOption);
    }
    data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.textContent = item.nama;
        element.appendChild(option);
    });
    if (selectedID) {
        element.selected = selectedID;
    }
}

/**
 * Mengatur nilai default input type date ke tanggal hari ini.
 * @param element {HTMLInputElement} element input type date yang diatur.
 */
export function setMinOnToday(element) {
    const today = new Date().toLocaleDateString('en-CA');
    element.setAttribute("min", today);
    element.value = today;
}

/**
 * Membuat elemen input secara dinamis dan menambahkan event listener.
 * @param {HTMLDivElement} container - Elemen container yang akan menampung daftar input dan tombol kontrol.
 * @param {HTMLButtonElement} button - Tombol kontrol untuk menambah elemen input (contoh: tombol tambah).
 * @param {string} inputsName - Nama atribut "name" untuk elemen input baru.
 * @param {HTMLDivElement} feedback - Elemen feedback untuk validasi tombol.
 */
export function createDinamicInputText(container, button, inputsName, feedback) {
    button.addEventListener("click", () => {
        const inputs = document.querySelectorAll(`input[name="${inputsName}"]`);
        if (inputs) {
            button.classList.remove("is-invalid");
            button.classList.add("is-valid");
            feedback.textContent = "";
            feedback.style.display = "none";
        }

        const newContainer = document.createElement("div");
        newContainer.classList.add(
            "container-add-action-control",
            "d-flex",
            "flex-column",
            "row-gap-1",
            "mb-3"
        );

        newContainer.innerHTML = `
      <div class="container-button-action-control d-flex justify-content-end">
          <button type="button" class="btn btn-hapus-persyaratan">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
                  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
              </svg>
          </button>
      </div>
      <div class="container-field-persyaratan">
          <input type="text" name="${inputsName}" class="form-control" placeholder="Contoh: Minimum Lulusan SMA">
          <div class="valid-feedback"></div>
          <div class="invalid-feedback"></div>
      </div>
    `;

        container.appendChild(newContainer);

        const btnHapus = newContainer.querySelector(".btn-hapus-persyaratan");
        btnHapus.addEventListener("click", () => {
            newContainer.remove();
        });
    });
}





