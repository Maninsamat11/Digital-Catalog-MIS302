@extends('layouts.app')

@section('title', 'About Us — Mood Set-Up Studio')

@push('styles')
<style>
.about-story-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
}
.about-stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}
.about-values-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}
.about-visit-row {
    display: flex;
    justify-content: center;
    gap: 3rem;
    flex-wrap: wrap;
}

/* ══════════════════════════════════════════════
   📱 RESPONSIVE
   ══════════════════════════════════════════════ */

@media (max-width: 900px) {
    .about-story-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}

@media (max-width: 768px) {
    .about-values-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .about-hero { padding: 2.5rem 0 2rem !important; }
    .about-stats-grid { gap: 0.75rem; }
    .about-values-grid { grid-template-columns: 1fr; }
    .about-visit-row { gap: 1.5rem; }
    .about-visit-card { padding: 1.75rem 1.25rem !important; }
    section h2 { font-size: 1.25rem !important; }
}
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="about-hero" style="padding: 4rem 0 3rem; text-align: center; position: relative;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%, rgba(108,99,255,0.12) 0%, transparent 70%);pointer-events:none;"></div>
    <p style="font-size:0.8rem;color:var(--accent2);text-transform:uppercase;letter-spacing:0.15em;margin-bottom:0.75rem;">Who We Are</p>
    <h1 style="font-size:clamp(2.2rem,5vw,3.5rem);font-weight:800;line-height:1.1;margin-bottom:1rem;">
        Built for Audio &amp;<br><span style="color:var(--accent2);">Tech Enthusiasts</span>
    </h1>
    <p style="color:var(--muted);font-size:1.05rem;max-width:520px;margin:0 auto;">We are a local electronics and audio specialist store dedicated to helping customers find the right gear — from entry-level to audiophile-grade.</p>
</section>

{{-- OUR STORY --}}
<section style="margin-bottom:3.5rem;">
    <div class="about-story-grid">
        <div>
            <p style="font-size:0.78rem;color:var(--accent2);text-transform:uppercase;letter-spacing:0.12em;margin-bottom:0.6rem;">Our Story</p>
            <h2 style="font-size:1.7rem;font-weight:800;line-height:1.2;margin-bottom:1rem;">From a small shop to a full catalog</h2>
            <p style="color:var(--muted);line-height:1.8;margin-bottom:1rem;">TechVault started as a small in-store audio counter with a passion for quality sound and honest product recommendations. Over the years, we expanded our range to include peripherals, DACs, IEMs, and everything in between.</p>
            <p style="color:var(--muted);line-height:1.8;">This digital catalog was built so that every customer walking into our store can explore our full inventory independently — no waiting, no guesswork, just the right information at your fingertips.</p>
        </div>
        <div class="about-stats-grid">
            <div class="card" style="padding:1.5rem;text-align:center;">
                <p style="font-family:'Syne',sans-serif;font-size:2rem;font-weight:800;color:var(--accent);">14+</p>
                <p style="font-size:0.85rem;color:var(--muted);margin-top:0.3rem;">Product Categories</p>
            </div>
            <div class="card" style="padding:1.5rem;text-align:center;">
                <p style="font-family:'Syne',sans-serif;font-size:2rem;font-weight:800;color:var(--accent2);">50+</p>
                <p style="font-size:0.85rem;color:var(--muted);margin-top:0.3rem;">Products In-Store</p>
            </div>
            <div class="card" style="padding:1.5rem;text-align:center;">
                <p style="font-family:'Syne',sans-serif;font-size:2rem;font-weight:800;color:var(--accent);">100%</p>
                <p style="font-size:0.85rem;color:var(--muted);margin-top:0.3rem;">Genuine Products</p>
            </div>
            <div class="card" style="padding:1.5rem;text-align:center;">
                <p style="font-family:'Syne',sans-serif;font-size:2rem;font-weight:800;color:var(--accent2);">1</p>
                <p style="font-size:0.85rem;color:var(--muted);margin-top:0.3rem;">Dedicated Team</p>
            </div>
        </div>
    </div>
</section>

{{-- WHAT WE CARRY --}}
<section style="margin-bottom:3.5rem;">
    <p style="font-size:0.78rem;color:var(--accent2);text-transform:uppercase;letter-spacing:0.12em;margin-bottom:0.6rem;">What We Carry</p>
    <h2 style="font-size:1.4rem;font-weight:800;margin-bottom:1.5rem;">Specialists in Audio &amp; Peripherals</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem;">

        @php
        $specialties = [
            ['icon' => 'M9 19V6l12-3v13M9 19c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm12-3c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2z', 'title' => 'Audio Gear', 'desc' => 'IEMs, earphones, headphones, DACs, amps, and music players from top audiophile brands.'],
            ['icon' => 'M12 18.5A2.5 2.5 0 0 1 9.5 21h-6A2.5 2.5 0 0 1 1 18.5v-13A2.5 2.5 0 0 1 3.5 3h6A2.5 2.5 0 0 1 12 5.5m0 0v13m0-13A2.5 2.5 0 0 1 14.5 3h6A2.5 2.5 0 0 1 23 5.5v13a2.5 2.5 0 0 1-2.5 2.5h-6A2.5 2.5 0 0 1 12 18.5', 'title' => 'Peripherals', 'desc' => 'Mechanical keyboards and precision gaming mice for productivity and esports.'],
            ['icon' => 'M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2zM22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z', 'title' => 'Cables &amp; Tips', 'desc' => 'Upgrade cables in MMCX and 2-pin, plus premium eartips from SpinFit, Azla, and Comply.'],
            ['icon' => 'M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM2 17h20M2 7h20', 'title' => 'Monitors', 'desc' => 'Gaming and professional displays from LG, Samsung, Dell, and ASUS ROG.'],
        ];
        @endphp

        @foreach($specialties as $s)
        <div class="card" style="padding:1.5rem;">
            <div style="width:44px;height:44px;border-radius:10px;background:rgba(108,99,255,0.1);display:flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                <svg width="22" height="22" fill="none" stroke="var(--accent)" stroke-width="1.6" viewBox="0 0 24 24"><path d="{{ $s['icon'] }}"/></svg>
            </div>
            <p style="font-family:'Syne',sans-serif;font-weight:700;margin-bottom:0.4rem;">{{ $s['title'] }}</p>
            <p style="font-size:0.85rem;color:var(--muted);line-height:1.6;">{!! $s['desc'] !!}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- VALUES --}}
<section style="margin-bottom:3.5rem;">
    <p style="font-size:0.78rem;color:var(--accent2);text-transform:uppercase;letter-spacing:0.12em;margin-bottom:0.6rem;">Our Values</p>
    <h2 style="font-size:1.4rem;font-weight:800;margin-bottom:1.5rem;">Why customers choose us</h2>
    <div class="about-values-grid">
        <div class="card" style="padding:1.5rem;border-top:3px solid var(--accent);">
            <p style="font-family:'Syne',sans-serif;font-weight:700;margin-bottom:0.5rem;">Honest Recommendations</p>
            <p style="font-size:0.85rem;color:var(--muted);line-height:1.6;">We recommend what fits your needs and budget — not just the most expensive option on the shelf.</p>
        </div>
        <div class="card" style="padding:1.5rem;border-top:3px solid var(--accent2);">
            <p style="font-family:'Syne',sans-serif;font-weight:700;margin-bottom:0.5rem;">Genuine Products Only</p>
            <p style="font-size:0.85rem;color:var(--muted);line-height:1.6;">Every item we carry is sourced from authorized distributors. No replicas, no counterfeits — ever.</p>
        </div>
        <div class="card" style="padding:1.5rem;border-top:3px solid var(--accent);">
            <p style="font-family:'Syne',sans-serif;font-weight:700;margin-bottom:0.5rem;">Self-Service Browsing</p>
            <p style="font-size:0.85rem;color:var(--muted);line-height:1.6;">This digital catalog lets you explore, compare, and research products at your own pace in-store.</p>
        </div>
    </div>
</section>

{{-- VISIT US --}}
<section style="margin-bottom:3.5rem;">
    <div class="card about-visit-card" style="padding:2.5rem;text-align:center;background:linear-gradient(135deg,rgba(108,99,255,0.08),rgba(0,229,192,0.05));">
        <p style="font-size:0.78rem;color:var(--accent2);text-transform:uppercase;letter-spacing:0.12em;margin-bottom:0.6rem;">Find Us</p>
        <h2 style="font-size:1.5rem;font-weight:800;margin-bottom:1rem;">Visit Our Store</h2>
        <div class="about-visit-row">
            <div>
                <p style="font-size:0.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.3rem;">Location</p>
                <p style="font-weight:600;">Phnom Penh, Cambodia</p>
            </div>
            <div>
                <p style="font-size:0.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.3rem;">Hours</p>
                <p style="font-weight:600;">Mon – Sat, 9am – 7pm</p>
            </div>
            <div>
                <p style="font-size:0.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.3rem;">Contact</p>
                <p style="font-weight:600;">+855 12 345 678</p>
            </div>
        </div>
    </div>
</section>

@endsection