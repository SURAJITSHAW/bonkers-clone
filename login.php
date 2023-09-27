<?php
$conn = mysqli_connect("localhost", "root", "", "bonkers") or die("Connection Failed");

$login = false;
$showError = false;
$showAlert = false;

if (isset($_POST['register'])) {

    $email = $_POST['regEmail'];
    $pass = $_POST['regPass'];
    $cpass = $_POST['regCPass'];


    //check whether the email already exists
    $existsQuery = "SELECT email FROM users WHERE email='$email'";
    $res = mysqli_query($conn, $existsQuery);

    if (mysqli_num_rows($res) > 0) {
        $showError = "An account with this email address already exists.";
    } else {
        if (strlen($pass) < 6) {
            $showError = "Password must be at least 6 characters long.";
        } elseif (!preg_match("/[!@#$%^&*()_+[\]{};':\"\\|,.<>\/?]+/", $pass)) {
            $showError = "Password must contain at least one special character.";
        } else {
            // Password is valid; you can proceed to use/store it securely.
            // For example, you can hash and store it in a database.
            if ($pass == $cpass) {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`email`, `pass`, `created_at`) VALUES ('$email', '$hash', current_timestamp())";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $showAlert = true;
                    header('location: login.php');
                }
            } else {
                $showError = "Passwords do not match";
            }
        }
    }
}

if (isset($_POST['login'])) {

    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];


    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) == 1) {

        while ($row = mysqli_fetch_array($result)) {


            if (password_verify($pass, $row['pass'])) {
                $login = true;
                session_start();
                $_SESSION['email'] = $row['email'];
                $_SESSION['loggedin'] = true;
                header('location: index.php');
            } else {
                $showError = "Invalid credentials";
            }
        }
    } else {
        $showError = "Invalid credentials";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <style>
        .custom-alert {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .close-btn {
            float: right;
            font-weight: bold;
            cursor: pointer;
        }

        /* Style for the custom alert box */
        .custom-alert {
            position: relative;
            padding: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
            margin-bottom: 20px;
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        /* Style for the close button (×) */
        .close-btn {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            color: inherit;
            text-decoration: none;
            cursor: pointer;
        }

        /* Style for the close button hover state */
        .close-btn:hover {
            background-color: #e24343;
            color: #fff;
        }

        /* Style for the "Error!" text */
        .custom-alert strong {
            font-weight: bold;
        }

        /* Style for the error alert */
        .custom-alert.error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }


        body {
            font-family: Arial, sans-serif;
            background-image: url('./assets//bg.jpg');
            /* Replace with your image path */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            text-align: center;
            padding: 20px;
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-100%);
            }

            to {
                transform: translateY(0);
            }
        }


        .tabs {
            display: flex;
            justify-content: space-around;
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }

        .tabs a {
            text-decoration: none;
            color: inherit;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s;
            position: relative;
        }

        .tabs a.active {
            background-color: #00bcd4;
        }

        .tabs a:hover {
            background-color: #555;
        }

        .tab-content {
            padding: 20px;
        }

        .input-container {
            margin: 15px 0;
        }

        .input-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-container {
            margin-top: 20px;
        }

        .btn {
            background-color: #00bcd4;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .social-login-buttons {
            margin-top: 20px;
        }

        .social-login-buttons a {
            display: block;
            margin: 10px 0;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .facebook-button {
            background-color: #1877f2;
        }

        /* .google-button {
            background-color: #dd4b39;
        } */
        .google-button {
            background-color: #dd4b39;
            /* Google red */
            color: #fff;
            /* White text */
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .google-button:hover {
            background-color: #c53929;
            /* Slightly darker red on hover */
        }

        .google-logo {
            width: 20px;
            /* Adjust the size of the Google logo as needed */
            height: 20px;
            margin-right: 10px;
        }
    </style>

</head>

<body>

    <?php

    if ($showAlert) {
        echo '<div class="custom-alert success">
    <span class="close-btn" onclick="closeAlert(this)">&times;</span>
    <strong>Success!</strong> Your account is now created, and you can log in.
</div>';
    }


    if ($showError) {
        echo '<div class="custom-alert error">
    <span class="close-btn" onclick="closeAlert(this)">&times;</span>
    <strong>Error!</strong>  ' . $showError . '
    </div>';
    }

    
    ?>
    <script>
        function closeAlert(element) {
            element.parentElement.style.display = 'none';
        }
    </script>


    <div class="container">
        <div class="tabs">
            <a href="#login-tab" class="active">Login</a>
            <a href="#register-tab">Register</a>
        </div>



        <form action="" method="POST" class="tab-content" id="login-tab">
            <h2>Login</h2>
            <!-- ... rest of your login form ... -->
            <div class="input-container">
                <input name="loginEmail" type="text" placeholder="Email">
            </div>
            <div class="input-container">
                <input name="loginPass" type="password" placeholder="Password">
            </div>
            <div class="btn-container">
                <button type="submit" name="login" class="btn">Login</button>
            </div>
        </form>







        <form action="" method="POST" class="tab-content" id="register-tab" style="display: none;">
            <h2>Register</h2>
            <!-- ... rest of your registration form ... -->
            <div class="input-container">
                <input name="regEmail" type="text" placeholder="Email">
            </div>
            <div class="input-container">
                <input name="regPass" type="password" placeholder="Password">
            </div>
            <div class="input-container">
                <input name="regCPass" type="password" placeholder="Confirm Password">
            </div>
            <div class="btn-container">
                <button type="submit" name="register" class="btn">Register</button>
            </div>
        </form>
        <hr>
        <div class="social-login-buttons">
            <a href="#" class="facebook-button">Login with Facebook</a>
            <a href="#" class="google-button">Login with Google</a>
        </div>
    </div>


    <script>
        const tabs = document.querySelectorAll('.tabs a');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                const tabId = tab.getAttribute('href').replace('#', '');
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.style.display = 'none';
                });
                document.getElementById(tabId).style.display = 'block';
            });
        });
    </script>
</body>

</html>