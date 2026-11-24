// Charlotte — interactions du portfolio (sans dépendance)
(function () {
    'use strict';

    var calme = window.matchMedia('(prefers-reduced-motion: reduce)');
    var html = document.documentElement;

    // --- Apparition au défilement ---
    var aReveler = document.querySelectorAll('[data-revele]');
    if ('IntersectionObserver' in window && !calme.matches) {
        var obs = new IntersectionObserver(function (entrees) {
            entrees.forEach(function (e) {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    obs.unobserve(e.target);
                }
            });
        }, { rootMargin: '0px 0px -8% 0px', threshold: 0.12 });
        aReveler.forEach(function (el) { obs.observe(el); });
    } else {
        aReveler.forEach(function (el) { el.classList.add('visible'); });
    }

    // --- Parallaxe légère sur les visuels d'ouverture ---
    var parallaxes = document.querySelectorAll('[data-parallaxe]');
    if (parallaxes.length && !calme.matches) {
        var enAttente = false;
        var bouger = function () {
            var y = window.scrollY;
            parallaxes.forEach(function (el) {
                if (y < window.innerHeight * 1.2) {
                    var cible = el.querySelector('img') || el;
                    cible.style.transform = 'translate3d(0,' + (y * -0.12).toFixed(1) + 'px,0)';
                }
            });
            enAttente = false;
        };
        window.addEventListener('scroll', function () {
            if (!enAttente) { enAttente = true; requestAnimationFrame(bouger); }
        }, { passive: true });
    }

    // --- Navigation : bandeau noir dès qu'on quitte l'ouverture ---
    var nav = document.querySelector('[data-nav]');
    if (nav) {
        var majNav = function () { nav.classList.toggle('defile', window.scrollY > 40); };
        majNav();
        window.addEventListener('scroll', majNav, { passive: true });
    }

    // --- Inverser noir / blanc (remplace l'ancien bouton lune) ---
    var boutonInverse = document.querySelector('[data-inverse]');
    if (boutonInverse) {
        boutonInverse.setAttribute('aria-pressed', html.classList.contains('inverse') ? 'true' : 'false');
        boutonInverse.addEventListener('click', function () {
            var actif = html.classList.toggle('inverse');
            boutonInverse.setAttribute('aria-pressed', actif ? 'true' : 'false');
            try { localStorage.setItem('inverse', actif ? '1' : '0'); } catch (e) {}
        });
    }

    // --- Menu plein écran (mobile) ---
    var boutonMenu = document.querySelector('[data-menu]');
    var panneau = document.querySelector('[data-menu-panneau]');
    if (boutonMenu && panneau) {
        var basculer = function (ouvrir) {
            boutonMenu.setAttribute('aria-expanded', ouvrir ? 'true' : 'false');
            boutonMenu.textContent = ouvrir ? 'Fermer' : 'Menu';
            document.body.classList.toggle('menu-ouvert', ouvrir);
            if (ouvrir) {
                panneau.hidden = false;
                requestAnimationFrame(function () { panneau.classList.add('ouvert'); });
            } else {
                panneau.classList.remove('ouvert');
                setTimeout(function () { if (!panneau.classList.contains('ouvert')) panneau.hidden = true; }, calme.matches ? 0 : 600);
            }
        };
        boutonMenu.addEventListener('click', function () {
            basculer(boutonMenu.getAttribute('aria-expanded') !== 'true');
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && boutonMenu.getAttribute('aria-expanded') === 'true') { basculer(false); boutonMenu.focus(); }
        });
    }

    // --- Carrousel des projets ---
    var carrousel = document.querySelector('[data-carrousel]');
    if (carrousel) {
        var pas = function () {
            var plan = carrousel.querySelector('.plan');
            return plan ? plan.getBoundingClientRect().width + 20 : carrousel.clientWidth * 0.8;
        };
        var defiler = function (sens) {
            carrousel.scrollBy({ left: sens * pas(), behavior: calme.matches ? 'auto' : 'smooth' });
        };
        var prec = document.querySelector('[data-carrousel-prec]');
        var suiv = document.querySelector('[data-carrousel-suiv]');
        if (prec) prec.addEventListener('click', function () { defiler(-1); });
        if (suiv) suiv.addEventListener('click', function () { defiler(1); });
        carrousel.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowRight') { e.preventDefault(); defiler(1); }
            if (e.key === 'ArrowLeft') { e.preventDefault(); defiler(-1); }
        });
    }

    // --- Boutons Code / Démo sans lien : ne rien faire (pas de saut en haut de page) ---
    document.querySelectorAll('.btn--bientot').forEach(function (a) {
        a.addEventListener('click', function (e) { e.preventDefault(); });
    });
})();
