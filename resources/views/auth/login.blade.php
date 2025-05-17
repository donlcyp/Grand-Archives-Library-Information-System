<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Grand Archives</title>

    <style>
        /* Reset and base styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            border: none;
            text-decoration: none;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        menu, ol, ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        /* Login page styles */
        .log-in-page {
            background: #f0f0e4;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .frame-rectangle-3 {
            width: min(90%, 400px);
            padding: 1.5rem;
            background: #ded9c3;
            border: 1px solid #b5835a;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(181, 131, 90, 0.1); /* Base shadow */
            margin: 1rem;
            transition: box-shadow 0.3s ease; /* Smooth shadow transition */
        }

        .frame-rectangle-3:hover {
            box-shadow: 0 20px 48px rgba(181, 131, 90, 0.4); /* Enhanced shadow for hover illusion */
        }

        .textbox {
            background: #d9d9d9;
            width: 100%;
            padding: 0.5rem;
            font-size: 0.9rem;
            color: #121246;
            border-radius: 8px;
            margin-bottom: 0.75rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .textbox:focus {
            outline: none;
            border: 1px solid #b5835a;
            box-shadow: 0 0 0 3px rgba(181, 131, 90, 0.2);
        }

        .component-2 {
            width: 100%;
        }

        .rectangle-6 {
            background: #b5835a;
            border-radius: 8px;
            width: 100%;
            padding: 0.5rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .rectangle-6:hover {
            background: #a3724e;
            transform: scale(1.02);
        }

        .log-in-btn {
            color: #d9d9d9; /* Adjusted for better contrast */
            text-align: center;
            font-size: 1rem;
            font-weight: bold;
            background: transparent;
            cursor: pointer;
            width: 100%;
            padding: 0;
            border: none;
        }

        .login-signup {
            color: #121246;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .create-account {
            width: 100%;
            text-align: center;
            margin-top: 0.75rem;
        }

        .create-account2 {
            color: #121246;
            font-size: 0.75rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .create-account2:hover {
            color: #0e0f3a;
        }

        .grand-archives2 {
            color: #0e0f3a; /* Fallback color for better visibility */
            font-family: "JacquesFrancoisShadow-Regular", "Cinzel Decorative", serif;
            font-size: 1.5rem;
            font-weight: 400;
            text-align: center;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 6px rgba(181, 131, 90, 0.7); /* Increased shadow opacity and blur */
            background: linear-gradient(to right, #0e0f3a 0%, #8c5f3f 100%); /* Darker gradient */
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent; /* Still needed for gradient effect */
            transition: transform 0.3s ease;
        }

        .remember-me-container {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .remember-me-checkbox {
            width: 0.9rem;
            height: 0.9rem;
            margin-right: 0.4rem;
            cursor: pointer;
            accent-color: #b5835a;
        }

        .remember-me-label {
            color: #121246;
            font-size: 0.75rem;
            font-weight: 400;
        }

        .logo {
            width: 120px;
            height: auto;
            margin: 0 auto 0.75rem;
            display: block;
        }

        /* Media queries for responsiveness */
        @media (max-width: 480px) {
            .frame-rectangle-3 {
                padding: 1rem;
                margin: 0.5rem;
            }

            .grand-archives2 {
                font-size: 1.25rem;
                margin-bottom: 0.75rem;
            }

            .login-signup {
                font-size: 1.25rem;
                margin-bottom: 0.75rem;
            }

            .log-in-btn {
                font-size: 0.85rem;
            }

            .logo {
                width: 100px;
                margin-bottom: 0.5rem;
            }

            .rectangle-6 {
                padding: 0.4rem;
            }

            .textbox {
                padding: 0.4rem;
                font-size: 0.85rem;
                margin-bottom: 0.5rem;
            }

            .remember-me-container {
                margin-bottom: 0.5rem;
            }

            .remember-me-checkbox {
                width: 0.8rem;
                height: 0.8rem;
                margin-right: 0.3rem;
            }

            .remember-me-label {
                font-size: 0.7rem;
            }

            .create-account2 {
                font-size: 0.7rem;
            }

            .create-account {
                margin-top: 0.5rem;
            }
        }

        /* Ensure content fits on very short screens */
        @media (max-height: 600px) {
            .frame-rectangle-3 {
                padding: 0.75rem;
                margin: 0.5rem;
            }

            .logo {
                width: 80px;
                margin-bottom: 0.5rem;
            }

            .grand-archives2 {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }

            .login-signup {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }

            .textbox {
                padding: 0.3rem;
                font-size: 0.8rem;
                margin-bottom: 0.4rem;
            }

            .remember-me-container {
                margin-bottom: 0.4rem;
            }

            .remember-me-checkbox {
                width: 0.7rem;
                height: 0.7rem;
                margin-right: 0.2rem;
            }

            .remember-me-label {
                font-size: 0.65rem;
            }

            .rectangle-6 {
                padding: 0.3rem;
            }

            .log-in-btn {
                font-size: 0.8rem;
            }

            .create-account {
                margin-top: 0.4rem;
            }

            .create-account2 {
                font-size: 0.65rem;
            }
        }
    </style>
</head>
<body>  
    <div class="log-in-page">
        <div class="frame-rectangle-3" role="main">
            <img src="{{ asset('images/logo1.png') }}" alt="Grand Archives Logo" class="logo"/>
            <div class="grand-archives2" role="heading" aria-level="1">GRAND ARCHIVES</div>
            <div class="login-signup">LOGIN</div>
            <form method="POST" action="{{ route('login') }}" aria-label="Login form">
                @csrf
                <input type="email" name="email" class="textbox" placeholder="Email" required aria-label="Email address">
                <input type="password" name="password" class="textbox" placeholder="Password" required aria-label="Password">
                <div class="remember-me-container">
                    <input type="checkbox" name="remember" id="remember" class="remember-me-checkbox" aria-label="Remember me">
                    <label for="remember" class="remember-me-label">Remember me</label>
                </div>
                <div class="component-2">
                    <div class="rectangle-6">
                        <button type="submit" class="log-in-btn">Login</button>
                    </div>
                </div>
            </form>
            <div class="create-account">
                <a href="{{ route('register') }}" class="create-account2">Don't have an account?</a>  
            </div>
        </div>
    </div>
</body>
</html> 