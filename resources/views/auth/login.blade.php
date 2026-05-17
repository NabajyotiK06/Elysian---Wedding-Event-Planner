<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Elysian Events</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="auth-split">
        <div class="auth-image" style="background-image: url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=1200');">
            <div class="auth-image-overlay">
                <a href="{{ url('/') }}" class="auth-brand" style="color: white; position: relative; top: 0; left: 0;">Elysian Events</a>
                <h2 class="auth-image-quote">"Elegance is the only beauty that never fades."</h2>
            </div>
        </div>
        
        <div class="auth-form-side">
            <div class="auth-header animate-fade-up">
                <h2>Welcome Back</h2>
                <p>Please enter your details to sign in.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger animate-fade-up">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="auth-form animate-fade-up animate-delay-1">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="hello@example.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn btn-primary">Sign In</button>
            </form>

            <div class="auth-footer animate-fade-up animate-delay-2">
                <p>Don't have an account? <a href="{{ route('register') }}">Create one now</a></p>
            </div>
        </div>
    </div>
</body>
</html>
