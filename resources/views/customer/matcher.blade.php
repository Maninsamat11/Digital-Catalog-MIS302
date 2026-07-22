@extends('layouts.app')

@section('title', 'Studio Matcher — Mood Set-up Studio')

@section('content')
<div style="max-width: 700px; margin: 5rem auto; padding: 0 20px;">
    
    {{-- Header Section --}}
    <div style="text-align: center; margin-bottom: 4rem;">
        <div class="system-tag">
            <span class="system-pulse"></span>
            <p>SETUP BUILDER // FIND YOUR MATCH</p>
        </div>
        <h1 class="matcher-title">FIND YOUR PERFECT <br><span class="accent-text"> SETUP</span></h1>
        <p class="matcher-subtitle">find the ideal gear, spec recommendations, and aesthetic ideas for your workspace.</p>
    </div>

    {{-- Main Glass Quiz Panel --}}
    <div class="quiz-panel">
        <form action="{{ route('matcher') }}" method="GET" id="matcherForm">
            
            <!-- Question 1: Budget -->
            <div class="question-group">
                <span class="step-num">01</span>
                <label class="question-label">WHAT IS YOUR BUDGET?</label>
                
                <div class="options-grid">
                    <label class="option-card">
                        <input type="radio" name="budget" value="budget" required>
                        <div class="card-content">
                            <span class="opt-title">ENTRY</span>
                            <span class="opt-desc">&lt; $100 USD</span>
                        </div>
                    </label>

                    <label class="option-card">
                        <input type="radio" name="budget" value="mid">
                        <div class="card-content">
                            <span class="opt-title">BALANCED</span>
                            <span class="opt-desc">$100 - $300 USD</span>
                        </div>
                    </label>

                    <label class="option-card">
                        <input type="radio" name="budget" value="premium">
                        <div class="card-content">
                            <span class="opt-title">PREMIUM</span>
                            <span class="opt-desc">$300+ USD</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Question 2: Use Case -->
            <div class="question-group" style="margin-top: 3.5rem; margin-bottom: 4rem;">
                <span class="step-num">02</span>
                <label class="question-label">HOW WILL YOU USE YOUR SPACE?</label>
                
                <div class="options-grid">
                    <label class="option-card">
                        <input type="radio" name="use_case" value="Gaming" required>
                        <div class="card-content">
                            <span class="opt-title">GAMING</span>
                            <span class="opt-desc">Low Latency / High Response</span>
                        </div>
                    </label>

                    <label class="option-card">
                        <input type="radio" name="use_case" value="Producing">
                        <div class="card-content">
                            <span class="opt-title">PRODUCING</span>
                            <span class="opt-desc">Acoustically Transparent</span>
                        </div>
                    </label>

                    <label class="option-card">
                        <input type="radio" name="use_case" value="Casual">
                        <div class="card-content">
                            <span class="opt-title">CASUAL</span>
                            <span class="opt-desc">Smooth Daily Integration</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Submit Button (Apple Glossy Design) -->
            <button type="submit" class="btn-matcher-submit">
                <span>FIND YOUR SETUP</span>
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
/* ── LOCAL STYLES FOR THE MATCHER PAGE ── */

.system-tag {
    display: inline-flex;
    align-items: center;
    background: rgba(0, 0, 0, 0.03);
    border: 1px solid rgba(0, 0, 0, 0.05);
    padding: 6px 14px;
    border-radius: 50px;
    margin-bottom: 1.5rem;
}
.system-tag p {
    font-size: 0.6rem;
    color: var(--muted);
    letter-spacing: 2px;
    font-weight: 700;
    margin: 0;
}
.system-pulse {
    width: 6px; height: 6px; background: var(--accent);
    border-radius: 50%; display: inline-block;
    margin-right: 8px;
    animation: pulse-ring 2s infinite;
}

.matcher-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(2.5rem, 5vw, 3.8rem);
    font-weight: 800;
    line-height: 0.95;
    color: #1d1d1f;
    letter-spacing: -1.5px;
    margin-bottom: 1rem;
    text-transform: uppercase;
}
.matcher-title .accent-text {
    color: var(--accent);
}

.matcher-subtitle {
    font-size: 0.95rem;
    color: var(--muted);
    max-width: 520px;
    margin: 0 auto;
    line-height: 1.5;
}

/* Glass configurator container */
.quiz-panel {
    background: rgba(255, 255, 255, 0.55);
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 28px;
    padding: 3.5rem;
    box-shadow: 0 4px 30px rgba(0,0,0,0.02), 0 30px 60px rgba(0,0,0,0.02);
}

.question-group {
    position: relative;
}

.step-num {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 0.65rem;
    letter-spacing: 2px;
    color: var(--accent);
    display: block;
    margin-bottom: 0.5rem;
}

.question-label {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 0.9rem;
    color: #1d1d1f;
    letter-spacing: 1px;
    display: block;
    margin-bottom: 1.5rem;
}

/* Tactile options grid */
.options-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.option-card {
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: 16px;
    padding: 1.5rem 1rem;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.25, 0.8, 0.25, 1);
    display: block;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.01);
}

.option-card input[type="radio"] {
    display: none; /* Hide native input button */
}

.card-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.opt-title {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 0.85rem;
    color: #1d1d1f;
    letter-spacing: 1px;
}

.opt-desc {
    font-size: 0.68rem;
    color: var(--muted);
    margin-top: 6px;
    line-height: 1.3;
}

/* Hover and active states */
.option-card:hover {
    transform: translateY(-2px);
    border-color: rgba(0, 0, 0, 0.15);
    box-shadow: 0 8px 25px rgba(0,0,0,0.04);
}

/* Apply physical selection styling when input is selected */
.option-card:has(input[type="radio"]:checked) {
    background: #1d1d1f;
    border-color: #1d1d1f;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

.option-card:has(input[type="radio"]:checked) .opt-title {
    color: #ffffff;
}

.option-card:has(input[type="radio"]:checked) .opt-desc {
    color: rgba(255, 255, 255, 0.6);
}

/* Master Submission Button */
.btn-matcher-submit {
    width: 100%;
    background: #1d1d1f;
    color: #ffffff;
    border: none;
    border-radius: 50px;
    padding: 1.2rem;
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 0.85rem;
    letter-spacing: 2px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    transition: all 0.25s;
}

.btn-matcher-submit:hover {
    background: var(--accent);
    box-shadow: 0 6px 25px rgba(166, 6, 6, 0.35);
    transform: translateY(-2px);
}

@keyframes pulse-ring {
    0% { transform: scale(0.9); opacity: 0.4; }
    50% { transform: scale(1.1); opacity: 1; }
    100% { transform: scale(0.9); opacity: 0.4; }
}
</style>
@endpush