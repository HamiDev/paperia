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
 * Mobile primary nav toggle.
 */
(function () {
  const toggle = document.querySelector('[data-nav-toggle]');
  const nav = document.querySelector('[data-site-nav]');

  if (!toggle || !nav) {
    return;
  }

  toggle.addEventListener('click', function () {
    const isOpen = !nav.hasAttribute('hidden');

    if (isOpen) {
      nav.setAttribute('hidden', '');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', toggle.getAttribute('data-label-open') || 'Open menu');
    } else {
      nav.removeAttribute('hidden');
      toggle.setAttribute('aria-expanded', 'true');
      toggle.setAttribute('aria-label', toggle.getAttribute('data-label-close') || 'Close menu');
    }
  });
})();
