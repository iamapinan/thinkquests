document.addEventListener("DOMContentLoaded", function () {
    // Function to handle image file upload and preview
    function handleImageUpload(event) {
        const file = event.target.files[0];
        const preview = document.getElementById("image-preview");
        const errorMessage = document.getElementById("error-message");

        if (file && file.type.startsWith("image/")) {
            const img = new Image();
            img.onload = function () {
                if (img.width === 334 && img.height === 200) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const base64Image = e.target.result;
                        preview.src = base64Image;
                        preview.style.display = "block";
                        errorMessage.style.display = "none";

                        // Save the image data in the input element
                        event.target.setAttribute("data-base64-image", base64Image);
                    };
                    reader.readAsDataURL(file);
                } else {
                    resetInputField();
                    errorMessage.style.display = "block";
                }
            };
            img.src = URL.createObjectURL(file);
        } else {
            resetInputField();
            errorMessage.style.display = "none";
        }

        function resetInputField() {
            preview.style.display = "none";
            event.target.value = ""; // Reset the input field
            event.target.removeAttribute("data-base64-image");
        }
    }

    // Add change event listener to the cover file input
    document.getElementById("cover-upload").addEventListener("change", handleImageUpload);

    // Handle form submission
    const form = document.querySelector("#createContent");
    const nextStepButton = document.getElementById("nextStep");
    const eTestingCheckbox = document.getElementById("e-testing");
    nextStepButton.addEventListener("click", function (e) {
        e.preventDefault();
        const formData = new FormData(form);

        // Append image data from file inputs
        document.querySelectorAll('input[type="file"]').forEach(input => {
            const inputName = input.name;
            if (input.files.length > 0) { // Make sure the file input is not empty
                const file = input.files[0];
                formData.append(inputName, file);
            }
        });

        fetch("/content/store", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: formData,
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            if (eTestingCheckbox.checked) {
                
                window.location.href = "/quiz/builder?content_id=" + data.data.id;
            } else {
                window.location.href = "/";
            }
        })
        .catch((error) => {
            // Handle error
            console.error("There was a problem with the fetch operation:", error);
        });
    });
});