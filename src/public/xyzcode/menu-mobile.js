/* ==========================================================================
   Menu mobile (hambúrguer) — Confeitaria Davilla
   Lê os links do menu do header (partials/header.blade.php) e monta uma barra
   fixa + gaveta lateral. Não altera o header original: só o esconde até 1199px
   (ver menu-mobile.css). Categorias novas do cardápio entram sozinhas.
   ========================================================================== */
(function () {
    'use strict';

    var ICONS = {
        bag: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 7h12l-1 13H7L6 7z"/><path d="M9 7a3 3 0 0 1 6 0"/></svg>',
        close: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>',
        chevron: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>',
        arrow: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>',
        lock: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></svg>'
    };

    function el(tag, cls, html) {
        var n = document.createElement(tag);
        if (cls) n.className = cls;
        if (html) n.innerHTML = html;
        return n;
    }

    function esc(s) {
        var d = document.createElement('div');
        d.textContent = s;
        return d.innerHTML;
    }

    function path(href) {
        var a = document.createElement('a');
        a.href = href;
        return a.pathname.replace(/\/+$/, '') || '/';
    }

    function init() {
        var header = document.querySelector('.main-header');
        if (!header || document.querySelector('.dvm-bar')) return;

        // menu original do desktop (o primeiro .nav-outer do .menu-box)
        var items = header.querySelectorAll('.main-box .menu-box > .nav-outer > .main-menu .navigation > li');
        if (!items.length) return;

        var logoImg = header.querySelector('.main-box .menu-box > .logo img');
        var logoSrc = logoImg ? logoImg.getAttribute('src') : '';
        var homeLink = items[0].querySelector(':scope > a');
        var homeHref = homeLink ? homeLink.href : '/';
        var orderLink = header.querySelector('.outer-box a[title="Faça seu pedido"]');
        var orderHref = orderLink ? orderLink.href : homeHref;
        var adminLink = header.querySelector('.outer-box a[href*="admin"]');

        var here = location.pathname.replace(/\/+$/, '') || '/';
        var homePath = path(homeHref);

        function isActive(href) {
            var p = path(href);
            if (p === homePath) return here === homePath;
            return here === p || here.indexOf(p + '/') === 0;
        }

        /* ---------- barra ---------- */
        var bar = el('header', 'dvm-bar');
        bar.innerHTML =
            '<a class="dvm-logo" href="' + homeHref + '" aria-label="Página inicial">' +
                (logoSrc ? '<img src="' + logoSrc + '" alt="Confeitaria Davilla">' : '') +
            '</a>' +
            '<div class="dvm-actions">' +
                '<a class="dvm-cta" href="' + orderHref + '">' + ICONS.bag + '<span>Pedir</span></a>' +
                '<button type="button" class="dvm-burger" aria-label="Abrir menu" aria-expanded="false" aria-controls="dvm-drawer">' +
                    '<span></span><span></span><span></span>' +
                '</button>' +
            '</div>';

        /* ---------- gaveta ---------- */
        var drawer = el('aside', 'dvm-drawer');
        drawer.id = 'dvm-drawer';
        drawer.setAttribute('role', 'dialog');
        drawer.setAttribute('aria-modal', 'true');
        drawer.setAttribute('aria-label', 'Menu');
        drawer.setAttribute('aria-hidden', 'true');

        var list = '';
        Array.prototype.forEach.call(items, function (li, i) {
            var a = li.querySelector(':scope > a');
            if (!a) return;
            var subLinks = li.querySelectorAll(':scope > ul > li > a');
            var active = isActive(a.href);
            var num = (i + 1 < 10 ? '0' : '') + (i + 1);
            var subId = 'dvm-sub-' + i;

            list += '<li class="dvm-item' + (active ? ' is-active' : '') + '" style="--i:' + i + '">' +
                '<div class="dvm-row">' +
                    '<a class="dvm-link" href="' + a.href + '"' + (active ? ' aria-current="page"' : '') + '>' +
                        '<span class="dvm-num">' + num + '</span>' +
                        '<span class="dvm-label">' + esc(a.textContent.trim()) + '</span>' +
                    '</a>' +
                    (subLinks.length
                        ? '<button type="button" class="dvm-toggle" aria-expanded="false" aria-controls="' + subId + '" aria-label="Ver opções de ' + esc(a.textContent.trim()) + '">' + ICONS.chevron + '</button>'
                        : '') +
                '</div>';

            if (subLinks.length) {
                list += '<div class="dvm-sub" id="' + subId + '"><ul>';
                Array.prototype.forEach.call(subLinks, function (s) {
                    var subActive = !s.hash && path(s.href) === here;
                    list += '<li><a href="' + s.href + '"' + (subActive ? ' class="is-active"' : '') + ' tabindex="-1">' + esc(s.textContent.trim()) + '</a></li>';
                });
                list += '</ul></div>';
            }
            list += '</li>';
        });

        drawer.innerHTML =
            '<div class="dvm-drawer__head">' +
                '<a class="dvm-drawer__brand" href="' + homeHref + '">' +
                    (logoSrc ? '<img src="' + logoSrc + '" alt="">' : '') +
                    '<span><small>Confeitaria</small><em>feito à mão, com carinho</em></span>' +
                '</a>' +
                '<button type="button" class="dvm-close" aria-label="Fechar menu">' + ICONS.close + '</button>' +
            '</div>' +
            '<div class="dvm-drawer__line"></div>' +
            '<nav class="dvm-nav" aria-label="Menu principal"><ul>' + list + '</ul></nav>' +
            '<div class="dvm-drawer__foot">' +
                '<a class="dvm-btn" href="' + orderHref + '">Faça seu pedido ' + ICONS.arrow + '</a>' +
                (adminLink ? '<a class="dvm-admin" href="' + adminLink.href + '">' + ICONS.lock + 'Área restrita</a>' : '') +
            '</div>';

        var overlay = el('div', 'dvm-overlay');
        var spacer = el('div', 'dvm-spacer');

        document.body.insertBefore(drawer, document.body.firstChild);
        document.body.insertBefore(overlay, drawer);
        document.body.insertBefore(spacer, overlay);
        document.body.insertBefore(bar, spacer);

        var root = document.documentElement;
        var burger = bar.querySelector('.dvm-burger');
        var closeBtn = drawer.querySelector('.dvm-close');

        /* ---------- abrir / fechar ---------- */
        function open() {
            root.classList.add('dvm-open', 'dvm-lock');
            bar.classList.remove('is-hidden');
            burger.setAttribute('aria-expanded', 'true');
            burger.setAttribute('aria-label', 'Fechar menu');
            drawer.setAttribute('aria-hidden', 'false');
            setTimeout(function () { closeBtn.focus(); }, 60);
        }

        function close(restoreFocus) {
            if (!root.classList.contains('dvm-open')) return;
            root.classList.remove('dvm-open', 'dvm-lock');
            burger.setAttribute('aria-expanded', 'false');
            burger.setAttribute('aria-label', 'Abrir menu');
            drawer.setAttribute('aria-hidden', 'true');
            if (restoreFocus !== false) burger.focus();
        }

        burger.addEventListener('click', function () {
            root.classList.contains('dvm-open') ? close() : open();
        });
        closeBtn.addEventListener('click', function () { close(); });
        overlay.addEventListener('click', function () { close(); });

        drawer.addEventListener('click', function (e) {
            if (e.target.closest('a')) close(false);
        });

        /* submenus */
        Array.prototype.forEach.call(drawer.querySelectorAll('.dvm-toggle'), function (btn) {
            btn.addEventListener('click', function () {
                var item = btn.closest('.dvm-item');
                var expanded = item.classList.toggle('is-expanded');
                btn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
                Array.prototype.forEach.call(item.querySelectorAll('.dvm-sub a'), function (a) {
                    a.tabIndex = expanded ? 0 : -1;
                });
            });
        });

        /* teclado: Esc fecha, Tab fica preso na gaveta */
        document.addEventListener('keydown', function (e) {
            if (!root.classList.contains('dvm-open')) return;
            if (e.key === 'Escape') { close(); return; }
            if (e.key !== 'Tab') return;
            var focusables = Array.prototype.filter.call(
                drawer.querySelectorAll('a[href], button'),
                function (n) { return n.tabIndex >= 0 && n.offsetParent !== null; }
            );
            if (!focusables.length) return;
            var first = focusables[0], last = focusables[focusables.length - 1];
            if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
            else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
        });

        /* volta pro desktop com o menu aberto */
        var mq = window.matchMedia('(min-width: 1200px)');
        var onMq = function (m) { if (m.matches) close(false); };
        mq.addEventListener ? mq.addEventListener('change', onMq) : mq.addListener(onMq);

        /* barra some ao rolar pra baixo e volta ao rolar pra cima */
        var lastY = window.pageYOffset, ticking = false;
        window.addEventListener('scroll', function () {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(function () {
                var y = window.pageYOffset;
                bar.classList.toggle('is-scrolled', y > 8);
                if (!root.classList.contains('dvm-open')) {
                    bar.classList.toggle('is-hidden', y > lastY && y > 140);
                }
                lastY = y;
                ticking = false;
            });
        }, { passive: true });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
