/**
 * About page: count the figures up when they enter the viewport.
 *
 * The printed number stays in the markup, so the figures are correct
 * if GSAP never runs. Depends on: gsap, ScrollTrigger.
 */
(function () {
  'use strict';

  var section = document.querySelector('.about-stats');
  if (!section || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    return;
  }

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    return;
  }

  var figures = section.querySelectorAll('.about-stat__value[data-count]');
  if (!figures.length) {
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  var timeline = gsap.timeline({
    scrollTrigger: {
      trigger: section,
      start: 'top 80%',
      once: true,
    },
  });

  figures.forEach(function (figure, index) {
    var target = parseInt(figure.getAttribute('data-count'), 10);
    if (Number.isNaN(target)) {
      return;
    }

    var counter = { value: 0 };

    timeline.to(
      counter,
      {
        value: target,
        duration: 1.45,
        ease: 'power2.out',
        onStart: function () {
          figure.textContent = '0';
        },
        onUpdate: function () {
          figure.textContent = String(Math.round(counter.value));
        },
      },
      index * 0.1
    );
  });
})();
