const hamburgerMenu = document.getElementById("hamburger-menu");
const sliderNavigation = document.getElementById("slider-navigation");

hamburgerMenu.addEventListener("click", function () {
  // Toggle class active pada hamburger dan slider
  hamburgerMenu.classList.toggle("active");
  sliderNavigation.classList.toggle("active");
});

// Upload foto handler
const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('fileInput');

        uploadArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (event) => {
            event.preventDefault();
            uploadArea.classList.remove('dragover');

            const files = event.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                uploadFile(files[0]);
            }
        });

        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                uploadFile(fileInput.files[0]);
            }
        });

        function uploadFile(file) {
            const formData = new FormData();
            formData.append('file', file);

            // fetch('upload.php', {
            //     method: 'POST',
            //     body: formData
            // })
            // .then(response => response.text())
            // .then(result => {
            //     alert('File uploaded successfully!');
            // })
            // .catch(error => {
            //     console.error('Error:', error);
            // });
        }