<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elysian - Wedding & Event Planning</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar animate-fade-up">
        <div class="navbar-brand">Elysian Events</div>
        <div class="d-flex gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Start Planning</a>
            @endauth
        </div>
    </nav>

    <header class="hero">
        <div class="hero-content animate-fade-up animate-delay-1">
            <h1 style="font-size: 5rem; margin-bottom: 2rem;">Plan Your <br>Perfect Day</h1>
            <p style="font-size: 1.4rem; font-weight: 300;">Elysian Events provides you with the ultimate toolkit to manage guests, coordinate vendors, and keep track of your budget with elegance and ease.</p>
            <div class="d-flex justify-center gap-3 mt-4" style="justify-content: center;">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary" style="font-size: 1.2rem; padding: 1.2rem 2.5rem; border-radius: 50px;">Go to Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 1.2rem; padding: 1.2rem 2.5rem; border-radius: 50px; box-shadow: 0 10px 30px rgba(212,175,55,0.4);">Start Planning Now</a>
                @endauth
            </div>
        </div>
    </header>

    <section class="section">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        
        <h2 class="section-title animate-fade-up">Everything You Need in One Place</h2>
        <p class="section-subtitle animate-fade-up animate-delay-1">A curated suite of tools designed to take the stress out of event planning, so you can focus on making memories.</p>
        
        <div class="feature-grid">
            <div class="feature-card animate-fade-up animate-delay-2">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3>Guest Management</h3>
                <p class="text-muted mt-2">Effortlessly organize your guest list, track RSVPs in real-time, and manage +1s to ensure everyone is accommodated flawlessly.</p>
            </div>
            <div class="feature-card animate-fade-up animate-delay-3">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3>Budget Tracking</h3>
                <p class="text-muted mt-2">Keep your finances in check with our comprehensive budget tools. Know exactly where every dollar is going without the spreadsheets.</p>
            </div>
            <div class="feature-card animate-fade-up animate-delay-4">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h3>Vendor Coordination</h3>
                <p class="text-muted mt-2">Discover, filter, and coordinate with top-tier local vendors including photographers, luxury venues, and gourmet caterers.</p>
            </div>
        </div>
    </section>

    <section class="section section-alt">
        <h2 class="section-title" style="margin-bottom: 5rem;">How It Works</h2>
        <div class="steps-container">
            <div class="step-item">
                <div class="step-content">
                    <div class="step-number">01</div>
                    <h3>Create Your Vision</h3>
                    <p class="text-muted mt-2">Sign up in seconds and input the basic details of your wedding or event. Set your budget constraint and tentative date to lay the foundation.</p>
                </div>
                <div class="step-image">
                    <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&q=80&w=800" alt="Planning Vision">
                </div>
            </div>
            <div class="step-item">
                <div class="step-content">
                    <div class="step-number">02</div>
                    <h3>Build Your Dream Team</h3>
                    <p class="text-muted mt-2">Browse our curated directory of premium vendors. Filter by your specific needs and lock in the perfect venue, catering, and music.</p>
                </div>
                <div class="step-image">
                    <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&q=80&w=800" alt="Vendor Selection">
                </div>
            </div>
            <div class="step-item">
                <div class="step-content">
                    <div class="step-number">03</div>
                    <h3>Manage Your Guests</h3>
                    <p class="text-muted mt-2">Import your guest list, send invites, and let the dashboard automatically track RSVPs and meal preferences so nothing falls through the cracks.</p>
                </div>
                <div class="step-image">
                    <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&q=80&w=800" alt="Guest Management">
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <h2>Ready to bring your event to life?</h2>
        <p>Join thousands of happy planners who have transformed their chaotic notes into beautiful, seamlessly managed events.</p>
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary" style="font-size: 1.2rem; padding: 1.2rem 3rem; border-radius: 50px;">Go to Dashboard</a>
        @else
            <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 1.2rem; padding: 1.2rem 3rem; border-radius: 50px; background: white; color: var(--secondary-color);">Create Free Account</a>
        @endauth
    </section>

    <footer class="footer">
        <div class="footer-brand">Elysian Events</div>
        <p>&copy; {{ date('Y') }} Elysian Event Planning. All rights reserved.</p>
    </footer>
</body>
</html>
