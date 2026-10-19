// Jaya Barman — site scripts
(function () {
  "use strict";

  // Navbar background on scroll + back-to-top button
  const nav = document.querySelector(".site-nav");
  const backTop = document.querySelector(".back-top");
  const onScroll = () => {
    const y = window.scrollY;
    if (nav) nav.classList.toggle("scrolled", y > 40);
    if (backTop) backTop.classList.toggle("show", y > 500);
  };
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();
  if (backTop) backTop.addEventListener("click", () => window.scrollTo({ top: 0 }));

  // Close mobile menu after tapping a link
  document.querySelectorAll(".site-nav .nav-link").forEach((link) => {
    link.addEventListener("click", () => {
      const open = document.querySelector(".site-nav .navbar-collapse.show");
      if (open && window.bootstrap) bootstrap.Collapse.getOrCreateInstance(open).hide();
    });
  });

  // Performance videos: play button on top, only one video plays at a time
  const videos = document.querySelectorAll(".video-box video");
  videos.forEach((video) => {
    const box = video.closest(".video-box");
    box.querySelector(".play")?.addEventListener("click", () => {
      video.controls = true;
      video.play();
    });
    video.addEventListener("play", () => {
      box.classList.add("playing");
      videos.forEach((v) => { if (v !== video) v.pause(); });
    });
  });

  // Reveal on scroll
  const reveals = document.querySelectorAll(".reveal");
  if ("IntersectionObserver" in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          e.target.classList.add("in");
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.12 });
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("in"));
  }

  // Gallery filter (portfolio)
  document.querySelectorAll(".filter-btns [data-filter]").forEach((btn) => {
    btn.addEventListener("click", () => {
      const f = btn.dataset.filter;
      document.querySelectorAll(".filter-btns [data-filter]").forEach((b) => b.classList.toggle("active", b === btn));
      document.querySelectorAll("[data-cat]").forEach((item) => {
        item.classList.toggle("d-none", f !== "all" && item.dataset.cat !== f);
      });
    });
  });

  // Lightbox
  const modalEl = document.getElementById("lightbox");
  if (modalEl && window.bootstrap) {
    const modal = new bootstrap.Modal(modalEl);
    const img = modalEl.querySelector("img");
    let items = [];
    let index = 0;
    const show = (i) => {
      index = (i + items.length) % items.length;
      img.src = items[index].getAttribute("href");
      img.alt = items[index].querySelector("img")?.alt || "";
    };
    document.addEventListener("click", (e) => {
      const a = e.target.closest(".gallery-item");
      if (!a) return;
      e.preventDefault();
      items = [...document.querySelectorAll(".gallery-item")].filter((el) => !el.closest(".d-none"));
      show(items.indexOf(a));
      modal.show();
    });
    modalEl.querySelector(".lb-prev").addEventListener("click", () => show(index - 1));
    modalEl.querySelector(".lb-next").addEventListener("click", () => show(index + 1));
    document.addEventListener("keydown", (e) => {
      if (!modalEl.classList.contains("show")) return;
      if (e.key === "ArrowLeft") show(index - 1);
      if (e.key === "ArrowRight") show(index + 1);
    });
  }

  // Album players: plays an MP3 when data-src is set on the card
  let current = null;
  document.querySelectorAll(".album-card").forEach((card) => {
    const btn = card.querySelector(".play-btn");
    const bar = card.querySelector(".progress-track span");
    const time = card.querySelector(".track-time");
    const src = card.dataset.src;
    if (!btn) return;
    if (!src) {
      // No audio file yet: open the album link instead
      btn.addEventListener("click", () => {
        const link = card.querySelector("[data-album-link]");
        if (link) window.open(link.href, "_blank", "noopener");
      });
      return;
    }
    const audio = new Audio(src);
    const fmt = (s) => `${String(Math.floor(s / 60)).padStart(2, "0")}:${String(Math.floor(s % 60)).padStart(2, "0")}`;
    audio.addEventListener("timeupdate", () => {
      if (!audio.duration) return;
      bar.style.width = (audio.currentTime / audio.duration) * 100 + "%";
      if (time) time.textContent = `${fmt(audio.currentTime)} / ${fmt(audio.duration)}`;
    });
    audio.addEventListener("ended", () => btn.innerHTML = '<i class="bi bi-play-fill"></i>');
    btn.addEventListener("click", () => {
      if (current && current !== audio) {
        current.pause();
        document.querySelectorAll(".play-btn").forEach((b) => b.innerHTML = '<i class="bi bi-play-fill"></i>');
      }
      if (audio.paused) {
        audio.play();
        btn.innerHTML = '<i class="bi bi-pause-fill"></i>';
        current = audio;
      } else {
        audio.pause();
        btn.innerHTML = '<i class="bi bi-play-fill"></i>';
      }
    });
  });

  // Video cards: if data-youtube is set, play in a modal; otherwise follow the link
  const vModalEl = document.getElementById("videoModal");
  if (vModalEl && window.bootstrap) {
    const vModal = new bootstrap.Modal(vModalEl);
    const frame = vModalEl.querySelector("iframe");
    document.querySelectorAll(".video-card[data-youtube]").forEach((card) => {
      const id = card.dataset.youtube.trim();
      if (!id) return;
      card.addEventListener("click", (e) => {
        e.preventDefault();
        frame.src = `https://www.youtube.com/embed/${id}?autoplay=1`;
        vModal.show();
      });
    });
    vModalEl.addEventListener("hidden.bs.modal", () => (frame.src = ""));
  }

  // Contact form: opens the visitor's mail app with the message filled in
  const form = document.getElementById("contactForm");
  if (form) {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      if (!form.checkValidity()) {
        form.classList.add("was-validated");
        return;
      }
      const d = new FormData(form);
      const body = `${d.get("message")}\n\n— ${d.get("name")} (${d.get("email")})`;
      window.location.href = `mailto:tukuli17@gmail.com?subject=${encodeURIComponent(d.get("subject") || "Hello from your website")}&body=${encodeURIComponent(body)}`;
    });
  }

  // Footer year
  document.querySelectorAll("[data-year]").forEach((el) => (el.textContent = new Date().getFullYear()));
})();
