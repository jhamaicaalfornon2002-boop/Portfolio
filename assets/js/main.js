/**
 * Dev Portfolio - Main JS
 */

document.addEventListener('DOMContentLoaded', () => {

    // ─── Mobile Nav Toggle ──────────────────────────────────────────
    const toggle = document.getElementById('nav-toggle');
    const nav    = document.getElementById('site-nav');

    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            toggle.classList.toggle('active');
            nav.classList.toggle('open');
        });
    }

    // ─── Sticky Header ──────────────────────────────────────────────
    const header = document.getElementById('site-header');
    if (header) {
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    // ─── Scroll Reveal Animation ────────────────────────────────────
    const reveals = document.querySelectorAll(
        '.work-card, .skill-card, .cert-card, .about-grid, .contact-grid, .section__title'
    );

    if (reveals.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        reveals.forEach(el => observer.observe(el));
    }

    // ─── Skill Bar Animation ────────────────────────────────────────
    const bars = document.querySelectorAll('.skill-card__fill');
    if (bars.length && 'IntersectionObserver' in window) {
        const barObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const pct = entry.target.getAttribute('data-percent');
                    entry.target.style.width = pct + '%';
                    barObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        bars.forEach(bar => {
            bar.style.width = '0%';
            barObserver.observe(bar);
        });
    }

    // ─── Works Filter (Archive page) ────────────────────────────────
    const filterBtns = document.querySelectorAll('.filter-btn');
    if (filterBtns.length) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.getAttribute('data-filter');
                const cards  = document.querySelectorAll('.work-card');

                cards.forEach(card => {
                    if (filter === '*') {
                        card.style.display = '';
                    } else {
                        const cat = card.querySelector('.work-card__category');
                        const catText = cat ? cat.textContent.toLowerCase().replace(/\s+/g, '-') : '';
                        card.style.display = catText.includes(filter) ? '' : 'none';
                    }
                });
            });
        });
    }

    // ─── Smooth scroll for anchor links ─────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                // Close mobile nav if open
                if (nav) nav.classList.remove('open');
                if (toggle) toggle.classList.remove('active');
            }
        });
    });
});
