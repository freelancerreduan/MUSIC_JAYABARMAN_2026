@extends('layouts.site')

@section('title', 'Contacts | '.setting('site_name'))

@section('content')
  @include('site.partials.hero')

  <section class="section-sm pt-2 contact-stage">
    {{-- floating shapes around the card --}}
    <span class="cs-shape cs-ring" style="top:12%;left:4%"></span>
    <span class="cs-shape cs-dot" style="top:30%;left:9%"></span>
    <span class="cs-shape cs-dot sm" style="bottom:18%;left:6%"></span>
    <span class="cs-shape cs-plus" style="top:14%;right:5%"><i class="bi bi-plus-lg"></i></span>
    <span class="cs-shape cs-plus sm" style="bottom:22%;right:4%"><i class="bi bi-plus-lg"></i></span>
    <span class="cs-shape cs-dot" style="top:48%;right:8%"></span>

    <div class="container">
      <div class="contact-window reveal" id="message">
        <div class="cw-bar">
          <span class="cw-dots"><i></i><i></i><i></i></span>
          <span class="cw-lines"><i></i><i></i><i></i><i></i></span>
        </div>

        <div class="cw-body">
          {{-- Form --}}
          <div class="cw-form">
            <h2 class="cw-title">Contact <span>us</span></h2>
            <p class="text-muted-2 mb-4">Bookings, collaborations or just a hello &mdash; write a few lines and we will get back to you soon.</p>

            @if (session('sent'))
              <div class="form-success mb-4"><i class="bi bi-check-circle-fill"></i> Thank you! Your message has been sent. We will get back to you soon.</div>
            @endif

            <form method="POST" action="{{ route('contact.send') }}" class="cw-fields">
              @csrf
              <div class="d-none" aria-hidden="true"><input name="website" tabindex="-1" autocomplete="off"></div>

              <div class="cw-field">
                <label class="visually-hidden" for="name">Name</label>
                <i class="bi bi-person-fill"></i>
                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Name" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="cw-field">
                <label class="visually-hidden" for="email">Email</label>
                <i class="bi bi-envelope-fill"></i>
                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Email" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="cw-field">
                <label class="visually-hidden" for="subject">Subject</label>
                <i class="bi bi-tag-fill"></i>
                <input class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Subject" maxlength="160">
                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="cw-field">
                <label class="visually-hidden" for="message-field">Message</label>
                <i class="bi bi-chat-left-text-fill"></i>
                <textarea class="form-control @error('message') is-invalid @enderror" id="message-field" name="message" rows="5" placeholder="Message" required>{{ old('message') }}</textarea>
                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <button class="btn btn-gold w-100" type="submit"><i class="bi bi-send me-2"></i>Send Message</button>
            </form>
          </div>

          {{-- Illustration + details --}}
          <div class="cw-art">
            <div class="cw-scene" aria-hidden="true">
              <span class="cw-bubble b-phone"><i class="bi bi-telephone-fill"></i></span>
              <span class="cw-bubble b-chat"><i class="bi bi-chat-dots-fill"></i></span>
              <span class="cw-bubble b-note"><i class="bi bi-music-note-beamed"></i></span>
              <svg viewBox="0 0 320 240" class="cw-svg">
                <defs>
                  <linearGradient id="cwGrad" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0" stop-color="#1fd1b8"/><stop offset="1" stop-color="#9a5cf5"/>
                  </linearGradient>
                </defs>
                {{-- dashed flight path --}}
                <path d="M20 200 C 70 150, 40 90, 110 80" fill="none" stroke="#a7a4b2" stroke-width="2" stroke-dasharray="4 7" opacity=".6"/>
                {{-- letter coming out of the envelope --}}
                <g class="cw-letter">
                  <rect x="112" y="46" width="132" height="110" rx="8" fill="#ecebf1"/>
                  <g stroke="#9a5cf5" stroke-width="1.6" opacity=".55">
                    <line x1="126" y1="70" x2="230" y2="70"/><line x1="126" y1="78" x2="230" y2="78"/>
                    <line x1="126" y1="86" x2="230" y2="86"/><line x1="126" y1="94" x2="230" y2="94"/>
                    <line x1="126" y1="102" x2="230" y2="102"/>
                  </g>
                  <g fill="#1fd1b8">
                    <ellipse cx="148" cy="98" rx="5" ry="4"/><rect x="152" y="74" width="2" height="24"/>
                    <ellipse cx="176" cy="90" rx="5" ry="4"/><rect x="180" y="66" width="2" height="24"/>
                    <rect x="152" y="74" width="30" height="4" transform="rotate(-15 152 74)"/>
                    <ellipse cx="208" cy="94" rx="5" ry="4" fill="#9a5cf5"/><rect x="212" y="70" width="2" height="24" fill="#9a5cf5"/>
                  </g>
                </g>
                {{-- envelope --}}
                <path d="M96 110 L178 168 L260 110 V200 a10 10 0 0 1 -10 10 H106 a10 10 0 0 1 -10 -10 Z" fill="url(#cwGrad)"/>
                <path d="M96 200 L160 150 M260 200 L196 150" stroke="#fff" stroke-width="2" opacity=".35"/>
                <path d="M96 110 L178 168 L260 110" fill="none" stroke="#fff" stroke-width="2" opacity=".5"/>
                {{-- sparkles --}}
                <g fill="#e8509d"><circle cx="280" cy="60" r="4"/><circle cx="60" cy="60" r="3"/></g>
                <g stroke="#1fd1b8" stroke-width="2.5" stroke-linecap="round">
                  <line x1="290" y1="150" x2="290" y2="164"/><line x1="283" y1="157" x2="297" y2="157"/>
                  <line x1="40" y1="120" x2="40" y2="130"/><line x1="35" y1="125" x2="45" y2="125"/>
                </g>
                {{-- ground --}}
                <ellipse cx="178" cy="222" rx="96" ry="7" fill="#000" opacity=".25"/>
              </svg>
            </div>

            <div class="cw-details">
              @if (setting('phone'))
                <a class="cw-chip" href="tel:{{ setting('phone') }}"><i class="bi bi-telephone"></i><span><small>Cell</small>{{ setting('phone_display', setting('phone')) }}</span></a>
              @endif
              @if (setting('whatsapp'))
                <a class="cw-chip" href="https://wa.me/{{ preg_replace('/\D/', '', setting('whatsapp')) }}" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i><span><small>WhatsApp</small>Chat on WhatsApp</span></a>
              @endif
              @if (setting('email'))
                <a class="cw-chip" href="mailto:{{ setting('email') }}"><i class="bi bi-envelope"></i><span><small>E-mail</small>{{ setting('email') }}</span></a>
              @endif
              @if (setting('location'))
                <div class="cw-chip"><i class="bi bi-geo-alt"></i><span><small>Based in</small>{{ setting('location') }}</span></div>
              @endif
            </div>
            <div class="cw-social">
              @include('site.partials.social')
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
