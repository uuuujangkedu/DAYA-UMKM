import Lenis from 'lenis';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

function initMotion() {
    // 1. Reduced motion check — return immediately, leaving all content in default visible state
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) {
        document.querySelectorAll('[data-reveal], [data-reveal-item]').forEach(el => {
            el.style.opacity = '1';
            el.style.transform = 'none';
        });
        return;
    }

    // 2. Register GSAP Plugin once
    gsap.registerPlugin(ScrollTrigger);

    // 3. Initialize Lenis Smooth Scroll (Landing page only)
    const lenis = new Lenis({
        duration: 1.1,
        smoothWheel: true,
        smoothTouch: false,
    });

    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);
    window.lenis = lenis;

    // 4. Header sticky scrolled state synced with Lenis
    const header = document.getElementById('site-header');
    if (header) {
        lenis.on('scroll', (e) => {
            const scrollY = typeof e.scroll === 'number' ? e.scroll : window.scrollY;
            if (scrollY > 8) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }

    // 5. Shared Reveal Configuration for all sections
    //    Each section has [data-reveal], children have [data-reveal-item]
    const revealSections = document.querySelectorAll('[data-reveal]');
    const sectionTimelines = new Map();

    revealSections.forEach((section) => {
        const isHero = section.id === 'beranda';
        const items = section.querySelectorAll('[data-reveal-item]');

        // Single coordinated timeline for the section and its children
        const tl = gsap.timeline({
            paused: true,
            defaults: {
                ease: 'power3.out',
            }
        });

        // Step 1: Section container slides up 40px (MOTION.md §3 & §4)
        tl.from(section, {
            opacity: 0,
            y: 40,
            duration: isHero ? 1.0 : 0.9,
            clearProps: 'transform,opacity',
        });

        // Step 2: Children stagger 0.15s, slide up 32px
        if (items.length > 0) {
            tl.from(items, {
                opacity: 0,
                y: 32,
                duration: 0.9,
                stagger: 0.15,
                clearProps: 'transform,opacity',
            }, '-=0.5'); // Overlap so children begin revealing right as section slides in
        }

        sectionTimelines.set(section, tl);

        if (isHero) {
            // Hero section reveals on initial page load after 0.1s delay
            gsap.delayedCall(0.1, () => {
                tl.play();
            });
        } else {
            // Scroll sections trigger at top 85%, play once
            ScrollTrigger.create({
                trigger: section,
                start: 'top 85%',
                once: true,
                onEnter: () => {
                    tl.play();
                }
            });
        }
    });

    // Safety net: ensure no element can stay hidden if scroll trigger is never reached
    setTimeout(() => {
        sectionTimelines.forEach((tl) => {
            if (tl.progress() === 0) {
                tl.play();
            }
        });
    }, 4500);

    // 6. Anchor link navigation coordinated with Lenis and Section Reveals
    function navigateToSection(targetEl, hash) {
        if (!targetEl) return;

        const isLanding = window.location.pathname === '/' || window.location.pathname === '';
        if (!isLanding) return;

        lenis.scrollTo(targetEl, {
            offset: -96,
            duration: 1.1,
            onComplete: () => {
                history.pushState(null, null, hash);
                // Guarantee the section has played its reveal animation upon reaching it
                const tl = sectionTimelines.get(targetEl);
                if (tl && tl.progress() === 0) {
                    tl.play();
                }
                ScrollTrigger.refresh();
            }
        });

        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
        }
    }

    document.querySelectorAll('a[href*="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (!href) return;
            const hashIndex = href.indexOf('#');
            if (hashIndex === -1) return;

            const hash = href.substring(hashIndex);
            if (!hash || hash === '#') return;

            const targetEl = document.querySelector(hash);
            if (targetEl) {
                e.preventDefault();
                navigateToSection(targetEl, hash);
            }
        });
    });

    const berandaLink = document.getElementById('nav-link-beranda');
    if (berandaLink) {
        berandaLink.addEventListener('click', function(e) {
            const isLanding = window.location.pathname === '/' || window.location.pathname === '';
            if (isLanding) {
                e.preventDefault();
                lenis.scrollTo(0, {
                    duration: 1.1,
                    onComplete: () => {
                        history.pushState(null, null, ' ');
                        ScrollTrigger.refresh();
                    }
                });
            }
        });
    }

    // 7. Initial Hash Navigation: e.g. opening /#tentang-kami directly
    if (window.location.hash) {
        const hash = window.location.hash;
        const targetEl = document.querySelector(hash);
        if (targetEl) {
            // Scroll to top first so Lenis smoothly travels to the anchor
            window.scrollTo(0, 0);
            setTimeout(() => {
                navigateToSection(targetEl, hash);
            }, 150);
        }
    }

    // 8. Refresh ScrollTrigger after initial setup
    ScrollTrigger.refresh();
}

// Register triggers once DOM is loaded, then refresh when fonts and images are ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initMotion();
        if (document.fonts) {
            document.fonts.ready.then(() => {
                ScrollTrigger.refresh();
            });
        }
    });
} else {
    initMotion();
    if (document.fonts) {
        document.fonts.ready.then(() => {
            ScrollTrigger.refresh();
        });
    }
}

window.addEventListener('load', () => {
    ScrollTrigger.refresh();
});

window.addEventListener('resize', () => {
    ScrollTrigger.refresh();
});
