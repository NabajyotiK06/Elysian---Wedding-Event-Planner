<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Elysian Events</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="auth-split">
        <div class="auth-image" style="background-image: url('https://images.unsplash.com/photo-1469371670807-013ccf25f16a?auto=format&fit=crop&q=80&w=1200');">
            <div class="auth-image-overlay">
                <a href="{{ url('/') }}" class="auth-brand" style="color: white; position: relative; top: 0; left: 0;">Elysian Events</a>
                <h2 class="auth-image-quote">"The best thing to hold onto in life is each other."</h2>
            </div>
        </div>
        
        <div class="auth-form-side">
            <div class="auth-header animate-fade-up">
                <h2>Create Account</h2>
                <p>Start planning your dream event today.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger animate-fade-up">
                    <ul style="margin-left: 20px; margin-bottom: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="auth-form animate-fade-up animate-delay-1">
                @csrf
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="Nav">
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="hello@example.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn btn-primary">Create Account</button>
            </form>

            <div class="auth-footer animate-fade-up animate-delay-2">
                <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            </div>
        </div>
    </div>
</body>
</html>
