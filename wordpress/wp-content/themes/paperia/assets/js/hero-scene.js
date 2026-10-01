/**
 * Homepage hero scene — GSAP entrance, ambient drift, subtle parallax.
 *
 * Uses gsap.from so layers stay visible if JS never runs (progressive enhancement).
 * Depends on: gsap, ScrollTrigger (enqueued before this file).
 */
(function () {
  'use strict';

  var root = document.querySelector('[data-hero-scene]');
  if (!root || typeof gsap === 'undefined') {
    return;
  }

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduceMotion) {
    root.classList.add('is-reduced-motion');
    return;
  }

  if (typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);
  }

  var bg = root.querySelector('[data-hero-bg] img');
  var content = root.querySelector('[data-hero-content]');
  var notebooks = root.querySelector('[data-hero-notebooks]');
  var products = root.querySelector('[data-hero-products]');
  var planeYellow = root.querySelector('[data-hero-plane="yellow"]');
  var planeBlue = root.querySelector('[data-hero-plane="blue"]');
  var planePink = root.querySelector('[data-hero-plane="pink"]');
  var leavesLeft = root.querySelector('[data-hero-leaves-left]');
  var leavesRight = root.querySelector('[data-hero-leaves-right]');

  var title = content ? content.querySelector('.hero-scene__title') : null;
  var subtitle = content ? content.querySelector('.hero-scene__subtitle') : null;
  var cta = content ? content.querySelector('.hero-scene__cta') : null;
  var brand = content ? content.querySelector('[data-hero-brand]') : null;
  var copyBits = [brand, title, subtitle, cta].filter(Boolean);
  var planes = [planeYellow, planeBlue, planePink].filter(Boolean);

  var entrance = gsap.timeline({
    defaults: { ease: 'power2.out' },
  });

  if (copyBits.length) {
    entrance.from(copyBits, {
      opacity: 0,
      y: 24,
      duration: 0.75,
      stagger: 0.12,
    });
  }

  if (notebooks) {
    entrance.from(
      notebooks,
      {
        opacity: 0,
        x: -28,
        y: 16,
        duration: 0.85,
      },
      '-=0.35'
    );
  }

  if (products) {
    entrance.from(
      products,
      {
        opacity: 0,
        x: 28,
        y: 16,
        duration: 0.85,
      },
      '-=0.7'
    );
  }

  if (planes.length) {
    var frame = root.querySelector('.hero-scene__frame') || root;
    var isDesktop = window.matchMedia('(min-width: 48rem)').matches;
    var travelX = Math.max(frame.offsetWidth * 1.2, isDesktop ? 360 : 280);

    /**
     * Fly one plane across the banner on its own path.
     * Progress drives x + y together so cruise and bob never fight.
     */
    function flyPlane(el, config) {
      if (!el) {
        return;
      }

      var duration = config.duration;
      var fade = Math.min(1.2, duration * 0.08);
      var proxy = { t: 0 };

      gsap.set(el, {
        x: config.startX,
        y: config.startY,
        rotation: config.rotation || 0,
        opacity: 0,
      });

      var flight = gsap.timeline({
        delay: config.delay,
        repeat: -1,
      });

      flight.to(
        el,
        {
          opacity: 1,
          duration: fade,
          ease: 'power1.out',
        },
        0
      );

      flight.to(
        proxy,
        {
          t: 1,
          duration: duration,
          ease: 'none',
          onUpdate: function () {
            var t = proxy.t;
            var x = config.startX + (config.endX - config.startX) * t;
            var baseY = config.startY + (config.endY - config.startY) * t;
            var bob = Math.sin(t * Math.PI * config.bobCycles * 2) * config.bob;
            gsap.set(el, { x: x, y: baseY + bob });
          },
        },
        0
      );

      flight.to(
        el,
        {
          opacity: 0,
          duration: fade,
          ease: 'power1.in',
        },
        duration - fade
      );
    }

    // Same cross-banner flights on mobile and desktop; lanes/timing scale slightly.
    flyPlane(planeYellow, {
      startX: 0,
      startY: isDesktop ? 0 : 8,
      endX: travelX,
      endY: isDesktop ? -18 : -24,
      duration: isDesktop ? 26 : 18,
      delay: 0.35,
      bob: isDesktop ? 14 : 18,
      bobCycles: 5,
      rotation: -4,
    });

    flyPlane(planeBlue, {
      startX: isDesktop ? -40 : -24,
      startY: isDesktop ? 36 : 48,
      endX: travelX * 1.05,
      endY: isDesktop ? -48 : -20,
      duration: isDesktop ? 32 : 22,
      delay: isDesktop ? 4.5 : 2.2,
      bob: isDesktop ? 22 : 26,
      bobCycles: 4,
      rotation: 2,
    });

    flyPlane(planePink, {
      startX: isDesktop ? -80 : -36,
      startY: isDesktop ? -10 : 20,
      endX: travelX * 1.1,
      endY: isDesktop ? 42 : 56,
      duration: isDesktop ? 20 : 14,
      delay: isDesktop ? 8 : 4.5,
      bob: isDesktop ? 18 : 22,
      bobCycles: 6,
      rotation: -8,
    });
  }

  if (leavesLeft || leavesRight) {
    entrance.from(
      [leavesLeft, leavesRight].filter(Boolean),
      {
        opacity: 0,
        y: 20,
        duration: 0.8,
        stagger: 0.08,
      },
      '-=0.6'
    );
  }

  if (leavesLeft) {
    gsap.to(leavesLeft, {
      rotation: -9,
      x: '+=10',
      y: '+=16',
      duration: 3.2,
      ease: 'sine.inOut',
      yoyo: true,
      repeat: -1,
      delay: 1.4,
      transformOrigin: 'bottom left',
    });
  }

  if (leavesRight) {
    gsap.to(leavesRight, {
      rotation: 9,
      x: '-=10',
      y: '+=14',
      duration: 3.6,
      ease: 'sine.inOut',
      yoyo: true,
      repeat: -1,
      delay: 1.6,
      transformOrigin: 'bottom right',
    });
  }

  if (bg && typeof ScrollTrigger !== 'undefined') {
    gsap.to(bg, {
      yPercent: 12,
      ease: 'none',
      scrollTrigger: {
        trigger: root,
        start: 'top top',
        end: 'bottom top',
        scrub: true,
      },
    });
  }
})();
