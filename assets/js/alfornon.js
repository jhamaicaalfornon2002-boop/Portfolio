(function () {
    function ready(fn) {
        if (document.readyState !== 'loading') {
            fn();
            return;
        }
        document.addEventListener('DOMContentLoaded', fn);
    }

    ready(function () {
        var header = document.getElementById('site-header');
        var nav = document.getElementById('site-nav');
        var toggle = document.getElementById('nav-toggle');
        var navLinks = nav ? Array.prototype.slice.call(nav.querySelectorAll('a')) : [];
        var sections = Array.prototype.slice.call(document.querySelectorAll('section[id]'));

        function closeMenu() {
            if (!nav || !toggle) {
                return;
            }

            nav.classList.remove('open');
            toggle.classList.remove('active');
            toggle.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('menu-open');
        }

        if (toggle && nav) {
            toggle.addEventListener('click', function () {
                var isOpen = nav.classList.toggle('open');
                toggle.classList.toggle('active', isOpen);
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                document.body.classList.toggle('menu-open', isOpen);
            });
        }

        function getHash(link) {
            var href = link.getAttribute('href') || '';
            if (href.charAt(0) === '#') {
                return href.slice(1);
            }

            try {
                var url = new URL(href, window.location.href);
                var urlPath = url.pathname.replace(/\/+$/, '') || '/';
                var currentPath = window.location.pathname.replace(/\/+$/, '') || '/';

                if (url.origin === window.location.origin && urlPath === currentPath && url.hash) {
                    return url.hash.replace('#', '');
                }
            } catch (error) {
                return '';
            }

            var label = (link.textContent || '').trim().toLowerCase().replace(/\s+/g, '-');
            var labelMap = {
                about: 'about',
                works: 'works',
                work: 'works',
                skills: 'skills',
                skill: 'skills',
                certificates: 'certificates',
                certificate: 'certificates',
                contact: 'contact'
            };

            return labelMap[label] || '';
        }

        navLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                var id = getHash(link);
                var target = id ? document.getElementById(id) : null;

                if (target) {
                    event.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }

                closeMenu();
            });
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeMenu();
            }
        });

        function updateActiveNav() {
            var currentId = '';
            var scrollPos = window.scrollY + 130;

            sections.forEach(function (section) {
                if (scrollPos >= section.offsetTop && scrollPos < section.offsetTop + section.offsetHeight) {
                    currentId = section.id;
                }
            });

            navLinks.forEach(function (link) {
                link.classList.toggle('active', getHash(link) === currentId);
            });

            if (header) {
                header.classList.toggle('scrolled', window.scrollY > 24);
            }
        }

        updateActiveNav();
        window.addEventListener('scroll', updateActiveNav, { passive: true });

        var revealItems = Array.prototype.slice.call(document.querySelectorAll('.reveal-on-scroll, .work-card, .skill-card, .cert-card'));

        if ('IntersectionObserver' in window) {
            var revealObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.14, rootMargin: '0px 0px -40px 0px' });

            revealItems.forEach(function (item) {
                revealObserver.observe(item);
            });
        } else {
            revealItems.forEach(function (item) {
                item.classList.add('revealed');
            });
        }

        var bars = Array.prototype.slice.call(document.querySelectorAll('.skill-card__fill'));

        function fillBar(bar) {
            var percent = parseInt(bar.getAttribute('data-percent') || '0', 10);
            var safePercent = Math.max(0, Math.min(100, percent));
            bar.style.width = safePercent + '%';
        }

        if ('IntersectionObserver' in window) {
            var barObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        fillBar(entry.target);
                        barObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.35 });

            bars.forEach(function (bar) {
                bar.style.width = '0%';
                barObserver.observe(bar);
            });
        } else {
            bars.forEach(fillBar);
        }

        Array.prototype.slice.call(document.querySelectorAll('.js-typing')).forEach(function (item) {
            var text = item.getAttribute('data-text') || item.textContent || '';

            if (!text || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                item.textContent = text;
                return;
            }

            item.textContent = '';
            item.classList.add('is-typing');

            var index = 0;
            var timer = window.setInterval(function () {
                item.textContent = text.slice(0, index + 1);
                index += 1;

                if (index >= text.length) {
                    window.clearInterval(timer);
                    window.setTimeout(function () {
                        item.classList.remove('is-typing');
                    }, 900);
                }
            }, 45);
        });

        Array.prototype.slice.call(document.querySelectorAll('.filter-btn')).forEach(function (button) {
            button.addEventListener('click', function () {
                var filter = button.getAttribute('data-filter') || '*';
                var buttons = Array.prototype.slice.call(document.querySelectorAll('.filter-btn'));
                var cards = Array.prototype.slice.call(document.querySelectorAll('.work-card'));

                buttons.forEach(function (item) {
                    item.classList.toggle('active', item === button);
                });

                cards.forEach(function (card) {
                    if (filter === '*') {
                        card.style.display = '';
                        return;
                    }

                    var category = card.querySelector('.work-card__category');
                    var categoryText = category ? category.textContent.toLowerCase().replace(/\s+/g, '-') : '';
                    card.style.display = categoryText.indexOf(filter) !== -1 ? '' : 'none';
                });
            });
        });
    });
}());
