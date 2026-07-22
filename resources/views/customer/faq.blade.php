@extends('layouts.app')

@section('title', 'FAQ — TechVault')

@section('content')

{{-- HERO --}}
<section style="padding: 4rem 0 3rem; text-align: center; position: relative;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%, rgba(108,99,255,0.12) 0%, transparent 70%);pointer-events:none;"></div>
    <p style="font-size:0.8rem;color:var(--accent2);text-transform:uppercase;letter-spacing:0.15em;margin-bottom:0.75rem;">Got Questions?</p>
    <h1 style="font-size:clamp(2.2rem,5vw,3.5rem);font-weight:800;line-height:1.1;margin-bottom:1rem;">
        Frequently Asked<br><span style="color:var(--accent2);">Questions</span>
    </h1>
    <p style="color:var(--muted);font-size:1.05rem;max-width:480px;margin:0 auto;">Everything you need to know about our store, products, and how to use this catalog.</p>
</section>

@push('styles')
<style>
.faq-item {
    border-bottom: 1px solid var(--border);
}
.faq-item:last-child {
    border-bottom: none;
}
.faq-question {
    width: 100%;
    background: none;
    border: none;
    text-align: left;
    padding: 1.2rem 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    cursor: pointer;
    font-family: 'Syne', sans-serif;
    font-weight: 600;
    font-size: 1rem;
    color: var(--text);
    transition: color 0.2s;
}
.faq-question:hover { color: var(--accent); }
.faq-question.open  { color: var(--accent); }
.faq-icon {
    flex-shrink: 0;
    width: 24px; height: 24px;
    border-radius: 50%;
    border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; line-height: 1;
    color: var(--muted);
    transition: all 0.25s;
}
.faq-question.open .faq-icon {
    background: var(--accent);
    border-color: var(--accent);
    color: #fff;
    transform: rotate(45deg);
}
.faq-answer {
    overflow: hidden;
    max-height: 0;
    transition: max-height 0.35s ease, padding 0.2s;
}
.faq-answer.open {
    max-height: 400px;
}
.faq-answer p {
    padding-bottom: 1.2rem;
    color: var(--muted);
    line-height: 1.75;
    font-size: 0.925rem;
}
</style>
@endpush

@php
$faqs = [
    'Using the Catalog' => [
        [
            'q' => 'How do I search for a product?',
            'a' => 'Use the search bar at the top of any page. Type a product name, brand, or keyword (e.g. "Sony", "IEM", "mechanical keyboard") and press Enter. You can also filter results by category using the sidebar on the search results page.'
        ],
        [
            'q' => 'How does the Compare feature work?',
            'a' => 'On any product card, click the "Compare" button in the top-right corner. You can select up to 3 products. A floating bar will appear at the bottom of the screen — click "Compare Now" to see a side-by-side spec table of all selected products.'
        ],
        [
            'q' => 'Can I browse by category?',
            'a' => 'Yes. The homepage shows all available categories. Click any category card to see all products listed under it. Categories include IEMs, Headphones, DAC/Amp, Keyboards, Mice, Monitors, and more.'
        ],
        [
            'q' => 'Is this catalog updated in real time?',
            'a' => 'Yes. Our staff updates product availability, pricing, and stock directly through the admin panel, so what you see on this catalog reflects the current in-store inventory.'
        ],
    ],
    'Products & Stock' => [
        [
            'q' => 'What does "Out of Stock" mean?',
            'a' => 'It means that particular product is currently not available in-store. You can still view its details and specifications. Ask a staff member if you would like to be notified when it is restocked.'
        ],
        [
            'q' => 'Are all products on this catalog genuine?',
            'a' => 'Absolutely. Every product we carry is sourced from authorized distributors and official brand channels. We do not sell replicas, grey-market, or refurbished goods unless explicitly stated.'
        ],
        [
            'q' => 'Can I request a product that is not listed?',
            'a' => 'Yes. If you are looking for a specific product or brand not shown in the catalog, speak with one of our staff members. We regularly update our stock based on customer requests and availability.'
        ],
        [
            'q' => 'Do you carry products for all budgets?',
            'a' => 'Yes. Our catalog ranges from affordable entry-level options (like the Final Audio E3000 or SpinFit eartips) all the way to high-end audiophile gear (like the Campfire Audio Supermoon or KEF LSX II). There is something for every budget.'
        ],
    ],
    'Audio & Technical' => [
        [
            'q' => 'What is the difference between an IEM and an earphone?',
            'a' => 'IEMs (In-Ear Monitors) are designed to create a deep acoustic seal inside the ear canal, offering better isolation and detail retrieval. Earphones (Wired) is a broader category that includes IEMs but also shallower-fitting designs. Both are wired and connect via 3.5mm or balanced plugs.'
        ],
        [
            'q' => 'What is a DAC/Amp and do I need one?',
            'a' => 'A DAC (Digital-to-Analog Converter) converts digital audio from your device into an analog signal, while an Amp (Amplifier) boosts that signal to drive headphones. If your headphones or IEMs are hard to drive (high impedance) or you notice poor audio quality from your phone or laptop, a DAC/Amp will make a noticeable improvement.'
        ],
        [
            'q' => 'What is a Dongle DAC?',
            'a' => 'A Dongle DAC is a small portable DAC/Amp that plugs directly into your phone or laptop via USB-C (or Lightning). It is an easy upgrade over the built-in audio output of most modern devices, offering better sound quality in a pocket-sized form factor.'
        ],
        [
            'q' => 'What connector types do your IEM cables use?',
            'a' => 'Most IEMs and cables in our store use either 2-pin 0.78mm or MMCX connectors. Always check the product detail page for the connector type before purchasing an upgrade cable. Our staff can also help you find a compatible match.'
        ],
    ],
    'Store & Policy' => [
        [
            'q' => 'Can I try products before buying?',
            'a' => 'Yes, for select items we have demo units available in-store. Ask a staff member which products are available for listening or testing. Demo availability varies depending on current stock.'
        ],
        [
            'q' => 'What is your return or exchange policy?',
            'a' => 'We accept exchanges within 7 days of purchase for items in original, unopened condition. For defective products, please speak with our staff directly and we will assist with warranty or replacement depending on the brand policy.'
        ],
        [
            'q' => 'Do you offer any warranty on products?',
            'a' => 'Warranty terms vary by brand and product. Most items carry the manufacturer\'s standard warranty (typically 1 year). Warranty details are included in the product packaging. Our staff can clarify warranty coverage for any specific item.'
        ],
        [
            'q' => 'What are your store hours?',
            'a' => 'We are open Monday to Saturday, 9:00 AM to 7:00 PM. We are closed on Sundays and public holidays. You are welcome to use this digital catalog in-store any time during business hours.'
        ],
    ],
];
@endphp

{{-- FAQ SECTIONS --}}
<div style="max-width:780px;margin:0 auto;">
    @foreach($faqs as $section => $items)
    <section style="margin-bottom:2.5rem;">
        <h2 style="font-size:1rem;font-weight:700;color:var(--accent2);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.75rem;">{{ $section }}</h2>
        <div class="card">
            <div style="padding:0 1.5rem;">
                @foreach($items as $i => $faq)
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $faq['q'] }}</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>{{ $faq['a'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endforeach

    {{-- STILL HAVE QUESTIONS --}}
    <div class="card" style="padding:2rem;text-align:center;margin-bottom:3rem;background:linear-gradient(135deg,rgba(108,99,255,0.08),rgba(0,229,192,0.05));">
        <p style="font-family:'Syne',sans-serif;font-weight:700;font-size:1.1rem;margin-bottom:0.5rem;">Still have questions?</p>
        <p style="color:var(--muted);font-size:0.9rem;margin-bottom:1.25rem;">Our staff are happy to help. Come find us in-store or give us a call.</p>
        <div style="display:flex;justify-content:center;gap:1rem;flex-wrap:wrap;">
            <a href="{{ route('about') }}" class="btn btn-primary">About Us</a>
            <a href="{{ route('home') }}" class="btn btn-outline">Browse Products</a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleFaq(btn) {
    const answer = btn.nextElementSibling;
    const isOpen = btn.classList.contains('open');

    // Close all
    document.querySelectorAll('.faq-question.open').forEach(q => {
        q.classList.remove('open');
        q.nextElementSibling.classList.remove('open');
    });

    // Open clicked if it was closed
    if (!isOpen) {
        btn.classList.add('open');
        answer.classList.add('open');
    }
}
</script>
@endpush

@endsection