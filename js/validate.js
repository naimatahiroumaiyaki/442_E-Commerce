const form = document.getElementById("registerForm");

form.addEventListener("submit", function (event) {
    let valid = true;

    const name = document.getElementById("name");
    const email = document.getElementById("email");
    const pass = document.getElementById("pass");
    const country = document.getElementById("country");
    const city = document.getElementById("city");
    const contact = document.getElementById("contact");

    // Clear previous error messages
    document.querySelectorAll(".error").forEach(function (error) {
        error.textContent = "";
    });

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^[0-9+\-\s]{7,15}$/;

    // Name
    if (name.value.trim() === "") {
        document.getElementById("nameError").textContent =
            "Please enter your full name.";
        valid = false;
    }

    // Email
    if (email.value.trim() === "") {
        document.getElementById("emailError").textContent =
            "Please enter your email.";
        valid = false;
    } else if (!emailRegex.test(email.value.trim())) {
        document.getElementById("emailError").textContent =
            "Please enter a valid email.";
        valid = false;
    }

    // Password
    if (pass.value.trim() === "") {
        document.getElementById("passError").textContent =
            "Please enter a password.";
        valid = false;
    }

    // Country
    if (country.value.trim() === "") {
        document.getElementById("countryError").textContent =
            "Please select your country.";
        valid = false;
    }

    // City
    if (city.value.trim() === "") {
        document.getElementById("cityError").textContent =
            "Please enter your city.";
        valid = false;
    }

    // Contact
    if (contact.value.trim() === "") {
        document.getElementById("contactError").textContent =
            "Please enter your contact number.";
        valid = false;
    } else if (!phoneRegex.test(contact.value.trim())) {
        document.getElementById("contactError").textContent =
            "Please enter a valid contact number.";
        valid = false;
    }

    // Prevent submission if validation fails
    if (!valid) {
        event.preventDefault();
    } else {
        const button = document.getElementById("registerButton");

        button.textContent = "Registering...";
        button.disabled = true;
    }
});