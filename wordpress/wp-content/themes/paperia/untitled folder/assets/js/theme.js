/**
 * Light / dark theme toggle.
 *
 * Saves preference in localStorage and sets data-theme on <html>.
 * Values: light | dark | system
 */
(function () {
  const storageKey = 'paperia-color-scheme';
  const root = document.documentElement;
  const toggle = document.querySelector('[data-theme-toggle]');

  function getStored() {
    return window.localStorage.getItem(storageKey);
  }

  function apply(scheme) {
    root.setAttribute('data-theme', scheme);
  }

  function nextScheme(current) {
    if (current === 'light') {
      return 'dark';
    }
    if (current === 'dark') {
      return 'system';
    }
    return 'light';
  }

  const stored = getStored();
  if (stored === 'light' || stored === 'dark' || stored === 'system') {
    apply(stored);
  }

  if (!toggle) {
    return;
  }

  toggle.addEventListener('click', function () {
    const current = root.getAttribute('data-theme') || 'system';
    const next = nextScheme(current);
    apply(next);
    window.localStorage.setItem(storageKey, next);
  });
})();

/**
 * Sticky header: thinner after the page scrolls.
 */
(function () {
  const header = document.querySelector('[data-site-header]');

  if (!header) {
    return;
  }

  const scrollThreshold = 12;

  function updateScrolledState() {
    const isScrolled = window.scrollY > scrollThreshold;
    header.classList.toggle('is-scrolled', isScrolled);
  }

  updateScrolledState();
  window.addEventListener('scroll', updateScrolledState, { passive: true });
})();

/**
 * Mobile primary nav toggle.
 */
(function () {
  const toggle = document.querySelector('[data-nav-toggle]');
  const nav = document.querySelector('[data-site-nav]');
  const searchToggle = document.querySelector('[data-search-toggle]');
  const searchPanel = document.querySelector('[data-search-panel]');

  if (!toggle || !nav) {
    return;
  }

  function closeSearch() {
    if (!searchToggle || !searchPanel) {
      return;
    }
    searchPanel.setAttribute('hidden', '');
    searchToggle.setAttribute('aria-expanded', 'false');
  }

  function closeNav() {
    nav.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute(
      'aria-label',
      toggle.getAttribute('data-label-open') || 'Open menu'
    );
  }

  toggle.addEventListener('click', function () {
    const isOpen = nav.classList.contains('is-open');

    closeSearch();

    if (isOpen) {
      closeNav();
      return;
    }

    nav.classList.add('is-open');
    toggle.setAttribute('aria-expanded', 'true');
    toggle.setAttribute(
      'aria-label',
      toggle.getAttribute('data-label-close') || 'Close menu'
    );
  });

  window.addEventListener('resize', function () {
    if (window.matchMedia('(min-width: 48rem)').matches) {
      closeNav();
    }
  });
})();

/**
 * Header search panel toggle.
 * Closes on Escape, scroll, or click outside the panel/button.
 */
(function () {
  const toggle = document.querySelector('[data-search-toggle]');
  const panel = document.querySelector('[data-search-panel]');
  const nav = document.querySelector('[data-site-nav]');
  const navToggle = document.querySelector('[data-nav-toggle]');
  const input = panel ? panel.querySelector('input[type="search"]') : null;

  if (!toggle || !panel) {
    return;
  }

  function isSearchOpen() {
    return !panel.hasAttribute('hidden');
  }

  function closeSearch() {
    if (!isSearchOpen()) {
      return;
    }
    panel.setAttribute('hidden', '');
    toggle.setAttribute('aria-expanded', 'false');
  }

  function closeNav() {
    if (!nav || !navToggle) {
      return;
    }
    nav.classList.remove('is-open');
    navToggle.setAttribute('aria-expanded', 'false');
    navToggle.setAttribute(
      'aria-label',
      navToggle.getAttribute('data-label-open') || 'Open menu'
    );
  }

  toggle.addEventListener('click', function () {
    closeNav();

    if (isSearchOpen()) {
      closeSearch();
      return;
    }

    panel.removeAttribute('hidden');
    toggle.setAttribute('aria-expanded', 'true');

    if (input) {
      input.focus();
    }
  });

  document.addEventListener('click', function (event) {
    if (!isSearchOpen()) {
      return;
    }

    const target = event.target;
    if (!(target instanceof Node)) {
      return;
    }

    // Keep open when interacting with the button or the form itself.
    if (toggle.contains(target) || panel.contains(target)) {
      return;
    }

    closeSearch();
  });

  window.addEventListener(
    'scroll',
    function () {
      closeSearch();
    },
    { passive: true }
  );

  document.addEventListener('keydown', function (event) {
    if (event.key !== 'Escape' || !isSearchOpen()) {
      return;
    }
    closeSearch();
    toggle.focus();
  });
})();
