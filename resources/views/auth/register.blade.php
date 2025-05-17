<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Grand Archives</title>
    <style>
        /* Reset and base styles */
        *, a, button, input, select, h1, h2, h3, h4, h5 {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            border: none;
            text-decoration: none;
            background: none;
            -webkit-font-smoothing: antialiased;
        }

        menu, ol, ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        /* Sign-up page styles */
        .sign-up-page {
            background: #f0f0e4;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: "Inter-Regular", sans-serif;
        }

        .frame-rectangle-3 {
            width: min(90%, 430px);
            padding: 1.5rem;
            margin: 1rem;
            border: 2px solid #b5835a;
            border-radius: 12px;
            background: #ded9c3;
            box-shadow: 0 8px 24px rgba(181, 131, 90, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .frame-rectangle-3:hover {
            box-shadow: 0 20px 48px rgba(181, 131, 90, 0.4); /* Hover shadow for lift illusion */
        }

        .form-group {
            width: min(100%, 304px);
            margin: 0 auto 1.25rem;
            position: relative;
        }

        .textbox {
            background: #d9d9d9;
            width: 100%;
            height: 2.5rem;
            padding: 0.5rem;
            font-size: 0.9rem;
            color: #121246;
            border-radius: 8px;
            display: block;
            outline: none;
        }

        .textbox:focus {
            border: 2px solid #b5835a;
            box-shadow: 0 0 0 3px rgba(181, 131, 90, 0.2);
        }

        .form-group label {
            color: #121246;
            font-size: 0.75rem;
            font-weight: 400;
            position: absolute;
            left: 0.5rem;
            top: -1rem;
        }

        .component-2 {
            width: min(100%, 160px);
            height: 2.5rem;
            margin: 1rem auto 0;
            position: relative;
        }

        .rectangle-62 {
            background: #b5835a;
            border-radius: 10px;
            width: 100%;
            height: 100%;
            position: absolute;
            transition: background 0.2s ease;
        }

        .create-btn {
            color: #121246;
            text-align: center;
            font-size: 1.25rem;
            font-weight: 400;
            width: 100%;
            height: 100%;
            position: relative;
            cursor: pointer;
            z-index: 1;
        }

        .component-2:hover .rectangle-62 {
            background: rgba(181, 131, 90, 0.8);
        }

        .login-signup {
            color: #121246;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 1rem 0;
        }

        .logo {
            width: 80px;
            height: auto;
            margin: 0 auto 0.75rem;
            display: block;
        }

        .grand-archives2 {
            color: #0e0f3a; /* Fallback color */
            text-align: center;
            font-family: "JacquesFrancoisShadow-Regular", "Cinzel Decorative", serif;
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 6px rgba(181, 131, 90, 0.7);
            background: linear-gradient(to right, #0e0f3a 0%, #8c5f3f 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            transition: transform 0.3s ease;
        }

        .login-link-container {
            width: 100%;
            margin: 0.75rem auto;
            text-align: center;
        }

        .login-link {
            color: #121246;
            font-size: 0.75rem;
            font-weight: 400;
            display: block;
            cursor: pointer;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #c22d2d;
            font-size: 0.75rem;
            position: absolute;
            left: 0.5rem;
            bottom: -1rem;
            width: 100%;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .frame-rectangle-3 {
                width: 90%;
                padding: 1rem;
            }
            .form-group {
                width: 100%;
            }
            .logo {
                width: 70px;
            }
            .grand-archives2 {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .frame-rectangle-3 {
                width: 95%;
                padding: 0.75rem;
            }
            .form-group {
                width: 90%;
                margin-bottom: 1rem;
            }
            .login-signup {
                font-size: 1.25rem;
            }
            .create-btn {
                font-size: 1rem;
            }
            .logo {
                width: 60px;
            }
            .grand-archives2 {
                font-size: 1rem;
                margin-bottom: 0.75rem;
            }
            .textbox {
                height: 2rem;
                font-size: 0.85rem;
            }
        }

        /* Ensure content fits on very short screens */
        @media (max-height: 600px) {
            .frame-rectangle-3 {
                padding: 0.5rem;
                margin: 0.5rem;
            }
            .logo {
                width: 50px;
                margin-bottom: 0.5rem;
            }
            .grand-archives2 {
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
            }
            .login-signup {
                font-size: 1rem;
                margin: 0.5rem 0;
            }
            .form-group {
                margin-bottom: 0.75rem;
            }
            .textbox {
                height: 1.8rem;
                padding: 0.3rem;
                font-size: 0.8rem;
            }
            .form-group label {
                font-size: 0.7rem;
                top: -0.9rem;
            }
            .error-message {
                font-size: 0.7rem;
                bottom: -0.9rem;
            }
            .component-2 {
                height: 2rem;
                margin: 0.5rem auto;
            }
            .create-btn {
                font-size: 0.9rem;
            }
            .login-link-container {
                margin: 0.5rem auto;
            }
            .login-link {
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="sign-up-page">
        <div class="frame-rectangle-3">
            <img src="{{ asset('images/logo1.png') }}" alt="Grand Archives Logo" class="logo">
            <div class="grand-archives2">GRAND ARCHIVES</div>
            <div class="login-signup">SIGNUP</div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="textbox" placeholder="Name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="textbox" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="textbox" placeholder="Password" required>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="textbox" placeholder="Confirm Password" required>
                    @error('password_confirmation')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="component-2">
                    <div class="rectangle-62"></div>
                    <button type="submit" class="create-btn">CREATE</button>
                </div>
            </form>
            <div class="login-link-container">
                <a href="{{ route('login') }}" class="login-link">Already have an account?</a>
            </div>
        </div>
    </div>
</body>
</html>