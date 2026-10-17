/**
 * Brand Lottie marks in the header and the homepage banner.
 *
 * Each player stays on the first frame when the user prefers reduced motion,
 * and pauses while the tab is in the background.
 */
(function () {
  const players = document.querySelectorAll('[data-lottie]');

  if (!players.length || typeof window.lottie === 'undefined') {
    return;
  }

  const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  const animations = [];

  function prefersReducedMotion() {
    return motionQuery.matches;
  }

  function syncPlayback() {
    animations.forEach(function (animation) {
      if (prefersReducedMotion() || document.hidden) {
        animation.pause();
        return;
      }

      animation.play();
    });
  }

  players.forEach(function (player) {
    const src = player.getAttribute('data-src');

    if (!src) {
      return;
    }

    const animation = window.lottie.loadAnimation({
      container: player,
      renderer: 'svg',
      loop: true,
      autoplay: !prefersReducedMotion(),
      path: src,
    });

    animation.addEventListener('DOMLoaded', function () {
      if (prefersReducedMotion()) {
        animation.goToAndStop(0, true);
      }
    });

    animations.push(animation);
  });

  document.addEventListener('visibilitychange', syncPlayback);

  if (typeof motionQuery.addEventListener === 'function') {
    motionQuery.addEventListener('change', function () {
      animations.forEach(function (animation) {
        if (prefersReducedMotion()) {
          animation.goToAndStop(0, true);
          return;
        }

        animation.play();
      });
    });
  }
})();
