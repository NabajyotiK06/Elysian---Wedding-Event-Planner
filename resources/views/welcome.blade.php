<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elysian - Wedding & Event Planning</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Landing Page Specific Styles */
        .landing-body {
            background-color: var(--primary-light);
            color: var(--secondary-color);
        }
        
        .text-gold { color: var(--primary-color); }
        .bg-gold { background-color: var(--primary-light); border-top: 1px solid var(--primary-color); border-bottom: 1px solid var(--primary-color); }
        .bg-gold-dark { background-color: var(--primary-dark); color: white; }

        /* Hero Section */
        .landing-hero {
            display: flex;
            min-height: 100vh;
        }
        .hero-left {
            flex: 1;
            padding: 3rem 5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .hero-brand {
            position: absolute;
            top: 2rem;
            left: 5rem;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 600;
        }
        .hero-text h1 {
            font-size: 5.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }
        .hero-text p {
            font-size: 1.25rem;
            max-width: 450px;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }
        .hero-right {
            flex: 1;
            background: url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=2000&auto=format&fit=crop') center/cover;
        }

        /* Stats Bar */
        .stats-bar {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 1.5rem 0;
            background-color: #f6ebd8;
            color: var(--primary-dark);
            font-weight: 500;
            font-size: 1.2rem;
        }
        .stats-divider {
            width: 1px;
            height: 24px;
            background-color: var(--primary-color);
            opacity: 0.5;
        }

        /* Features Section */
        .features-section {
            padding: 6rem 5rem;
            text-align: center;
        }
        .feature-cards {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 3rem;
        }
        .feature-card-glass {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 16px;
            padding: 3rem 2rem;
            width: 300px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        .feature-card-glass:hover {
            transform: translateY(-5px);
        }
        .feature-card-glass svg {
            width: 48px;
            height: 48px;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
        }

        /* Timeline Section */
        .timeline-section {
            padding: 4rem 5rem;
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
        }
        .timeline-item {
            display: flex;
            align-items: center;
            margin-bottom: 4rem;
            gap: 3rem;
        }
        .timeline-item:nth-child(even) {
            flex-direction: row-reverse;
            text-align: right;
        }
        .timeline-num {
            font-family: 'Playfair Display', serif;
            font-size: 6rem;
            color: rgba(212, 175, 55, 0.2);
            font-weight: 400;
            line-height: 1;
        }
        .timeline-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--surface-color);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .timeline-text {
            flex: 1;
        }
        .timeline-text h3 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        /* Testimonials */
        .testimonials {
            padding: 6rem 5rem;
            background-color: #faf8f5;
            text-align: center;
        }
        .testimonial-cards {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 4rem;
        }
        .testimonial-card {
            background: var(--surface-color);
            border-radius: 16px;
            padding: 3rem 2rem;
            width: 350px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            position: relative;
        }
        .testimonial-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            border: 4px solid #faf8f5;
        }

        /* Gallery */
        .gallery {
            padding: 0 5rem 6rem;
            background-color: #faf8f5;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .gallery-grid img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
        }
        .gallery-grid img.tall {
            grid-row: span 2;
            height: calc(500px + 1rem);
        }

        /* Logos */
        .logos {
            padding: 4rem 5rem;
            display: flex;
            justify-content: space-around;
            align-items: center;
            opacity: 0.6;
        }
        .logos h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            margin: 0;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Footer */
        .landing-footer {
            background-color: var(--primary-dark);
            color: white;
            padding: 5rem 5rem 2rem;
            text-align: center;
        }
        .footer-form {
            display: flex;
            justify-content: center;
            max-width: 500px;
            margin: 2rem auto;
            border: 1px solid white;
            border-radius: 4px;
            overflow: hidden;
        }
        .footer-input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: none;
            outline: none;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
        }
        .footer-btn {
            padding: 1rem 2.5rem;
            background-color: transparent;
            border: none;
            border-left: 1px solid white;
            color: white;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s;
        }
        .footer-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 3rem;
            margin-bottom: 2rem;
        }
        .footer-links a {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
        }
        .footer-links a:hover {
            color: white;
        }

        @media (max-width: 992px) {
            .landing-hero, .timeline-item, .feature-cards, .testimonial-cards {
                flex-direction: column;
            }
            .timeline-item:nth-child(even) {
                flex-direction: column;
                text-align: left;
            }
            .gallery-grid {
                grid-template-columns: 1fr;
            }
            .gallery-grid img.tall {
                grid-row: auto;
                height: 250px;
            }
        }
    </style>
</head>
<body class="landing-body">

    <!-- Hero Section -->
    <header class="landing-hero">
        <div class="hero-brand">Elysian Events</div>
        <div class="hero-left">
            <div class="hero-text">
                <h1>Your <span class="text-gold">Vision,</span><br>Perfectly<br>Planned</h1>
                <p>Elysian Events provides you with the ultimate toolkit to manage guests, coordinate vendors, and keep track of your budget with elegance and ease.</p>
                <a href="{{ route('login') }}" class="btn" style="border: 1px solid var(--primary-dark); color: var(--primary-dark); padding: 1rem 2.5rem; border-radius: 4px; font-weight: 500; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Start Planning</a>
            </div>
        </div>
        <div class="hero-right"></div>
    </header>

    <!-- Stats Bar -->
    <div class="stats-bar">
        <span>500+ Dream Weddings</span>
        <div class="stats-divider"></div>
        <span>150+ Elite Vendors</span>
        <div class="stats-divider"></div>
        <span>4.9/5 Star Rating</span>
    </div>

    <!-- Features -->
    <section class="features-section">
        <div class="feature-cards">
            <div class="feature-card-glass">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <h3 style="font-family: 'Outfit', sans-serif;">Guest List</h3>
                <p class="text-muted" style="font-size: 0.95rem;">Effortlessly organize your guest list, track RSVPs in real-time, and manage +1s flawlessly.</p>
            </div>
            <div class="feature-card-glass">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 style="font-family: 'Outfit', sans-serif;">Budget</h3>
                <p class="text-muted" style="font-size: 0.95rem;">Keep your finances in check with our comprehensive budget tools and expense tracking.</p>
            </div>
            <div class="feature-card-glass">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <h3 style="font-family: 'Outfit', sans-serif;">Vendors</h3>
                <p class="text-muted" style="font-size: 0.95rem;">Discover, filter, and coordinate with top-tier local vendors including venues and caterers.</p>
            </div>
        </div>
    </section>

    <!-- Process Timeline -->
    <section class="timeline-section">
        <div class="timeline-item">
            <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&q=80&w=400" alt="Concept" class="timeline-img">
            <div class="timeline-text">
                <h3>Design Your Concept</h3>
                <p class="text-muted">Input the basic details of your wedding or event. Set your budget constraint and tentative date to lay the elegant foundation of your dreams.</p>
            </div>
            <div class="timeline-num">01</div>
        </div>
        <div class="timeline-item">
            <div class="timeline-num">02</div>
            <div class="timeline-text">
                <h3>Build Your Team</h3>
                <p class="text-muted">Browse our curated directory of premium vendors. Filter by your specific needs and lock in the perfect venue, catering, and music.</p>
            </div>
            <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&q=80&w=400" alt="Team" class="timeline-img">
        </div>
        <div class="timeline-item">
            <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&q=80&w=400" alt="Guests" class="timeline-img">
            <div class="timeline-text">
                <h3>Manage Your Guests</h3>
                <p class="text-muted">Import your guest list, send invites, and let the dashboard automatically track RSVPs so nothing falls through the cracks.</p>
            </div>
            <div class="timeline-num">03</div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <h2 style="font-size: 3rem; margin-bottom: 0.5rem;">Love Stories</h2>
        <div style="color: var(--primary-dark); font-size: 1.5rem;">★★★★★</div>
        
        <div class="testimonial-cards">
            <div class="testimonial-card">
                <img src="https://images.unsplash.com/photo-1522529599102-193c0d76b5b6?auto=format&fit=crop&q=80&w=200" alt="Sarah & Michael" class="testimonial-img">
                <h4 style="margin-top: 1rem; margin-bottom: 1rem; font-family: 'Outfit', sans-serif;">Sarah & Michael</h4>
                <p class="text-muted">"Elysian Events made our dream wedding a reality. The budget tracking alone saved us from so much stress, and the vendor coordination was seamless."</p>
                <span style="color: var(--primary-color); font-size: 0.9rem; margin-top: 1rem; display: block;">June 2025</span>
            </div>
            <div class="testimonial-card">
                <img src="https://images.unsplash.com/photo-1606800052052-a08af7148866?auto=format&fit=crop&q=80&w=200" alt="Emma & David" class="testimonial-img">
                <h4 style="margin-top: 1rem; margin-bottom: 1rem; font-family: 'Outfit', sans-serif;">Emma & David</h4>
                <p class="text-muted">"The guest management tool was a lifesaver. We had over 200 guests and Elysian kept everything perfectly organized. Highly recommend!"</p>
                <span style="color: var(--primary-color); font-size: 0.9rem; margin-top: 1rem; display: block;">August 2025</span>
            </div>
            <div class="testimonial-card">
                <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=200" alt="Chloe & Ryan" class="testimonial-img">
                <h4 style="margin-top: 1rem; margin-bottom: 1rem; font-family: 'Outfit', sans-serif;">Chloe & Ryan</h4>
                <p class="text-muted">"We planned a massive destination wedding and the timeline feature kept us on track every step of the way. A truly premium experience."</p>
                <span style="color: var(--primary-color); font-size: 0.9rem; margin-top: 1rem; display: block;">October 2025</span>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="gallery">
        <div class="gallery-grid">
            <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=800" alt="Gallery 1" class="tall">
            <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?auto=format&fit=crop&q=80&w=800" alt="Gallery 2">
            <img src="https://images.unsplash.com/photo-1520854221256-17451cc331bf?auto=format&fit=crop&q=80&w=800" alt="Gallery 3">
            <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=800" alt="Gallery 4">
            <img src="https://images.unsplash.com/photo-1469371670807-013ccf25f16a?auto=format&fit=crop&q=80&w=800" alt="Gallery 5">
        </div>
    </section>

    <!-- Logos -->
    <section class="logos">
        <h4>Vogue Weddings</h4>
        <h4>Brides</h4>
        <h4>Harper's Bazaar</h4>
        <h4>The Knot</h4>
    </section>

    <!-- Footer -->
    <footer class="landing-footer">
        <h2 style="font-size: 2.5rem; color: white; margin-bottom: 1rem;">Join the Elysian Circle</h2>
        <p style="color: rgba(255,255,255,0.8);">Get exclusive planning tips and vendor recommendations.</p>
        
        <form action="{{ route('register') }}" method="GET" class="footer-form">
            <input type="email" name="email" placeholder="Enter your email address" class="footer-input" required>
            <button type="submit" class="footer-btn">Sign Up</button>
        </form>
        
        <div class="footer-links">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Events</a>
            <a href="#">Contact</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms</a>
        </div>
        
        <p style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">&copy; {{ date('Y') }} Elysian Events. All rights reserved.</p>
    </footer>

</body>
</html>
