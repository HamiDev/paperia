/**
 * Front-page hero slider.
 *
 * Keeps one slide visible, updates dots, and supports prev/next.
 * With a single slide the controls are omitted in PHP, so this is a no-op.
 */
(function () {
  const root = document.querySelector('[data-hero-slider]');

  if (!root) {
    return;
  }

  const slides = Array.prototype.slice.call(root.querySelectorAll('[data-hero-slide]'));
  const dots = Array.prototype.slice.call(root.querySelectorAll('[data-hero-dot]'));
  const prev = root.querySelector('[data-hero-prev]');
  const next = root.querySelector('[data-hero-next]');

  if (slides.length < 2) {
    return;
  }

  let index = 0;
  let timer = null;
  const intervalMs = 6000;

  function setActive(nextIndex) {
    index = (nextIndex + slides.length) % slides.length;

    slides.forEach(function (slide, i) {
      const active = i === index;
      slide.classList.toggle('is-active', active);
      if (active) {
        slide.removeAttribute('hidden');
      } else {
        slide.setAttribute('hidden', '');
      }
    });

    dots.forEach(function (dot, i) {
      const active = i === index;
      dot.classList.toggle('is-active', active);
      dot.setAttribute('aria-current', active ? 'true' : 'false');
    });
  }

  function go(delta) {
    setActive(index + delta);
    restart();
  }

  function restart() {
    if (timer) {
      window.clearInterval(timer);
    }
    timer = window.setInterval(function () {
      setActive(index + 1);
    }, intervalMs);
  }

  if (prev) {
    prev.addEventListener('click', function () {
      go(-1);
    });
  }

  if (next) {
    next.addEventListener('click', function () {
      go(1);
    });
  }

  dots.forEach(function (dot) {
    dot.addEventListener('click', function () {
      const target = parseInt(dot.getAttribute('data-hero-dot'), 10);
      if (!Number.isNaN(target)) {
        setActive(target);
        restart();
      }
    });
  });

  root.addEventListener('mouseenter', function () {
    if (timer) {
      window.clearInterval(timer);
      timer = null;
    }
  });

  root.addEventListener('mouseleave', function () {
    restart();
  });

  restart();
})();
