@extends('layouts.app')

@section('content')
<div class="hero" style="background: var(--bg-main); overflow: hidden;">
    <!-- Background Cinematic Video -->
    <video autoplay loop muted playsinline class="hero-video">
        <source src="{{ asset('videos/About us.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>

    <!-- Foreground Content -->
    <div style="position: relative; z-index: 2;">
        <h1>ABOUT <span style="color: var(--accent);">OVERCLOCKHUB</span></h1>
        <p>Malaysia's premier destination for high-performance computing hardware. Built by enthusiasts, for enthusiasts.</p>
    </div>
</div>

<h2 class="section-title">// Our <span>Mission</span></h2>
<div class="grid-2" style="margin-bottom: 4rem;">
    <div class="feature-box stagger-item">
        <h3>Who We Are</h3>
        <p>OverclockHub was founded with a single purpose: to provide PC builders and enthusiasts with access to the highest-quality computing components at competitive prices. Based in Malaysia, we serve overclockers, gamers, content creators, and enterprise clients who demand nothing but the best from their hardware.</p>
    </div>
    <div class="feature-box stagger-item">
        <h3>What We Do</h3>
        <p>We curate an extensive catalogue of performance-grade components — from cutting-edge processors and graphics cards to enterprise storage and precision cooling solutions. Every product in our inventory is tested, validated, and backed by our quality guarantee before it reaches your doorstep.</p>
    </div>
</div>

<h2 class="section-title">// Why <span>Choose Us</span></h2>
<div class="grid-4" style="margin-bottom: 4rem;">
    <div class="feature-box stagger-item">
        <h3>Expert Curation</h3>
        <p>Our team hand-picks every product based on real-world benchmarks and reliability data — no filler, only proven hardware.</p>
    </div>
    <div class="feature-box stagger-item">
        <h3>Fast Delivery</h3>
        <p>Free express shipping on orders over RM 5,000. Standard delivery available nationwide within 3-5 business days.</p>
    </div>
    <div class="feature-box stagger-item">
        <h3>Secure Transactions</h3>
        <p>End-to-end encrypted checkout with industry-standard security protocols to protect every transaction.</p>
    </div>
    <div class="feature-box stagger-item">
        <h3>24/7 Support</h3>
        <p>Our dedicated support team is available around the clock to help with technical questions, orders, and troubleshooting.</p>
    </div>
</div>

<h2 class="section-title">// System <span>Specifications</span></h2>
<div style="max-width: 800px; margin: 0 auto 4rem;">
    <table>
        <tr>
            <th style="width: 40%;">Parameter</th>
            <th>Value</th>
        </tr>
        <tr>
            <td style="color: var(--text-muted);">Founded</td>
            <td>2025</td>
        </tr>
        <tr>
            <td style="color: var(--text-muted);">Headquarters</td>
            <td>Johor Darul Ta'zim , Malaysia</td>
        </tr>
        <tr>
            <td style="color: var(--text-muted);">Product Categories</td>
            <td>14 categories, 100+ components</td>
        </tr>
        <tr>
            <td style="color: var(--text-muted);">Shipping Coverage</td>
            <td>Nationwide (Peninsular &amp; East Malaysia)</td>
        </tr>
        <tr>
            <td style="color: var(--text-muted);">Support Channels</td>
            <td>Email, Ticket System, Live Chat</td>
        </tr>
        <tr>
            <td style="color: var(--text-muted);">System Version</td>
            <td style="font-family: monospace; color: var(--accent);">v3.0.0 Final</td>
        </tr>
    </table>
</div>

<h2 class="section-title">// Our <span>Commitment</span></h2>
<div style="max-width: 800px; margin: 0 auto 4rem;">
    <div class="feature-box stagger-item">
        <p style="font-size: 1rem; line-height: 1.8; color: var(--text-main);">
            At OverclockHub, we believe every build deserves components that perform at their absolute peak.
            Whether you're assembling a competitive gaming rig, a professional workstation, or a home server,
            our mission is to equip you with hardware that exceeds expectations. We stand behind every product
            we sell with comprehensive warranty support and a hassle-free return policy.
        </p>
        <div style="margin-top: 2rem; display: flex; gap: 1.5rem;">
            <a href="{{ route('catalog', 'cpu') }}" class="btn btn-primary">Browse Hardware <i data-lucide="chevron-right" style="width: 1.2rem; height: 1.2rem; margin-left: 0.5rem;"></i></a>
            <a href="{{ route('contact') }}" class="btn btn-outline">Contact Support</a>
        </div>
    </div>
</div>
@endsection