import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// ── Theme toggle ───────────────────────────────────────────────────────
window.toggleTheme = function () {
    const html = document.documentElement;
    const isLight = html.classList.toggle('light');
    localStorage.setItem('theme', isLight ? 'light' : 'dark');
    window.dispatchEvent(new CustomEvent('theme-changed', { detail: isLight ? 'light' : 'dark' }));
};

// ── Intersection Observer: fade-in-up on scroll ────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

    document.querySelectorAll('.animate-on-scroll').forEach(el => io.observe(el));
});

// ── Skill bar fill on scroll ───────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const barIo = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                const fill = e.target.querySelector('.skill-bar-fill');
                if (fill) setTimeout(() => { fill.style.width = fill.dataset.width; }, 200);
                barIo.unobserve(e.target);
            }
        });
    }, { threshold: 0.3 });

    document.querySelectorAll('.skill-bar-track').forEach(el => barIo.observe(el));
});

// ── Typed text effect ──────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('typed-text');
    if (!el) return;
    const phrases = JSON.parse(el.dataset.phrases || '[]');
    if (!phrases.length) return;

    let pIdx = 0, cIdx = 0, deleting = false;

    const tick = () => {
        const cur = phrases[pIdx];
        if (deleting) {
            el.textContent = cur.substring(0, --cIdx);
            if (cIdx === 0) { deleting = false; pIdx = (pIdx + 1) % phrases.length; setTimeout(tick, 500); return; }
        } else {
            el.textContent = cur.substring(0, ++cIdx);
            if (cIdx === cur.length) { deleting = true; setTimeout(tick, 2200); return; }
        }
        setTimeout(tick, deleting ? 50 : 100);
    };
    tick();
});

// ── Navbar scroll glass effect ─────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const nav = document.getElementById('navbar');
    if (!nav) return;
    const update = () => nav.classList.toggle('scrolled', window.scrollY > 20);
    window.addEventListener('scroll', update, { passive: true });
    update();
});

// ── Counter animation ──────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (!e.isIntersecting) return;
            const el = e.target;
            const target = parseInt(el.dataset.count);
            const suffix = el.dataset.suffix || '';
            let count = 0;
            const step = Math.ceil(target / 40);
            const t = setInterval(() => {
                count = Math.min(count + step, target);
                el.textContent = count + suffix;
                if (count >= target) clearInterval(t);
            }, 40);
            io.unobserve(el);
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('[data-count]').forEach(el => io.observe(el));
});
