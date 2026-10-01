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
  var planes = root.querySelector('[data-hero-planes]');
  var leavesLeft = root.querySelector('[data-hero-leaves-left]');
  var leavesRight = root.querySelector('[data-hero-leaves-right]');

  var title = content ? content.querySelector('.hero-scene__title') : null;
  var subtitle = content ? content.querySelector('.hero-scene__subtitle') : null;
  var cta = content ? content.querySelector('.hero-scene__cta') : null;
  var brand = content ? content.querySelector('[data-hero-brand]') : null;
  var copyBits = [brand, title, subtitle, cta].filter(Boolean);

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

  if (planes) {
    entrance.from(
      planes,
      {
        opacity: 0,
        duration: 0.7,
      },
      '-=0.55'
    );

    var frame = root.querySelector('.hero-scene__frame') || root;
    var isDesktop = window.matchMedia('(min-width: 48rem)').matches;

    if (isDesktop) {
      var travelX = Math.max(frame.offsetWidth * 0.72, 320);

      // Keep x and y on one timeline so both always run together.
      gsap.set(planes, { x: 0, y: 0 });

      gsap
        .timeline({
          delay: 0.8,
          repeat: -1,
        })
        .to(planes, {
          x: travelX,
          duration: 28,
          ease: 'none',
        }, 0)
        .to(planes, {
          y: -28,
          duration: 2.8,
          ease: 'sine.inOut',
          yoyo: true,
          repeat: 9, // 10 half-cycles ≈ 28s to match the cruise
        }, 0);
    } else {
      gsap.to(planes, {
        y: '+=8',
        x: '+=12',
        duration: 4.5,
        ease: 'sine.inOut',
        yoyo: true,
        repeat: -1,
        delay: 1.2,
      });
    }
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
