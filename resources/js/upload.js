document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("cover-upload")
        .addEventListener("change", function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById("image-preview");
            const errorMessage = document.getElementById("error-message");

            if (file && file.type.startsWith("image/")) {
                const img = new Image();
                img.onload = function () {
                    if (img.width === 334 && img.height === 200) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            preview.src = e.target.result;
                            preview.style.display = "block";
                            errorMessage.style.display = "none";
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
            }
        });
    const eTestingCheckbox = document.getElementById("e-testing");
    const form = document.querySelector("#createContent");

    if (localStorage.getItem("formData")) {
        const formData = JSON.parse(localStorage.getItem("formData"));
        form.querySelector('input[name="title"]').value = formData.title;
        form.querySelector('textarea[name="description"]').value =
            formData.description;
        form.querySelector('textarea[name="indicators"]').value =
            formData.indicators;
        form.querySelector('select[name="level"]').value = formData.level;
        form.querySelector('select[name="category"]').value = formData.category;
        form.querySelector('input[name="e_testing"]').checked = true;
    }
    // do this after click button
    const nextStepButton = document.getElementById("nextStep");
    nextStepButton.addEventListener("click", function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        if (eTestingCheckbox.checked) {
            // Store form data in localStorage and redirect to quiz-builder
            localStorage.setItem("formData", JSON.stringify(data));
            window.location.href = "/quiz/builder";
        } else {
            // Submit form data to the server using fetch
            fetch("/content-store", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify(data),
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                // Handle success
                console.log(data);
                window.location.href = "/quiz-builder";
            })
            .catch((error) => {
                // Handle error
                console.error(
                    "There was a problem with the fetch operation:",
                    error
                );
            });
        }
    });

});
