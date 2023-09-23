<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset some default browser styles */
        body,
        h1,
        p {
            margin-bottom: 5px;
            margin-top: 0px;
            padding: 5px;
        }

        /* Style the container */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Style the form */
        form {
            background-color: #f4f4f4;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Add responsive styles */
        @media screen and (max-width: 768px) {
            .container {
                padding: 10px;
            }

            form {
                padding: 10px;
            }
        }
    </style>
    <title>Contact Us</title>
</head>

<body>
    <div class="container">
        <h1>Contact Us</h1>
        <p>Feel free to get in touch with us using the form below:</p>

        <form action="submit_contact.php" method="post" id="contact-form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    <script>
        // Form validation
        const form = document.getElementById("contact-form");

        form.addEventListener("submit", function(event) {
            let valid = true;

            const name = document.getElementById("name");
            const email = document.getElementById("email");
            const message = document.getElementById("message");

            if (name.value.trim() === "") {
                showError(name, "Name is required");
                valid = false;
            } else {
                showSuccess(name);
            }

            if (email.value.trim() === "") {
                showError(email, "Email is required");
                valid = false;
            } else if (!isValidEmail(email.value.trim())) {
                showError(email, "Invalid email format");
                valid = false;
            } else {
                showSuccess(email);
            }

            if (message.value.trim() === "") {
                showError(message, "Message is required");
                valid = false;
            } else {
                showSuccess(message);
            }

            if (!valid) {
                event.preventDefault();
            }
        });

        function showError(input, message) {
            const formGroup = input.parentElement;
            formGroup.className = "form-group error";
            const error = formGroup.querySelector("small");
            error.textContent = message;
        }

        function showSuccess(input) {
            const formGroup = input.parentElement;
            formGroup.className = "form-group success";
        }

        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }
    </script>
</body>

</html>