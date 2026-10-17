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
    var bounds = root.querySelector('[data-hero-planes]') || root;

    function wrapDegrees(degrees) {
      return degrees - 360 * Math.floor((degrees + 180) / 360);
    }

    /**
     * Nose angle of the artwork after an optional horizontal mirror.
     * The PNGs point up-right; mirroring turns that into up-left so the
     * plane can turn around without flying upside down.
     */
    function artworkNose(naturalDegrees, facingLeft) {
      if (!facingLeft) {
        return naturalDegrees;
      }

      var radians = (naturalDegrees * Math.PI) / 180;
      return (Math.atan2(Math.sin(radians), -Math.cos(radians)) * 180) / Math.PI;
    }

    /**
     * One point on a closed spiral, in fractions of the banner.
     * Radius breathes in and out over whole turns so the loop is seamless.
     */
    function spiralPoint(progress, config) {
      var turns = config.turns;
      var cycle = progress - Math.floor(progress);
      var scaled = cycle * turns;
      var lap = Math.floor(scaled);
      var fraction = scaled - lap;

      var warped = fraction + config.glide * Math.sin(fraction * Math.PI * 2);
      var along = (lap + warped) / turns;
      var angle = config.direction * along * turns * Math.PI * 2 + config.phase;
      var breathe = 0.5 - 0.5 * Math.cos(cycle * Math.PI * 2 * config.breaths);
      var radius = config.inner + (1 - config.inner) * breathe;
      var localX = Math.cos(angle) * config.rx * radius;
      var localY = Math.sin(angle) * config.ry * radius;
      var tiltCos = Math.cos(config.tilt);
      var tiltSin = Math.sin(config.tilt);
      var wander = cycle * Math.PI * 2 * config.wanderTurns;

      return {
        x:
          config.cx +
          (localX * tiltCos - localY * tiltSin) +
          Math.sin(wander + config.phase * 0.5) * config.wanderX,
        y:
          config.cy +
          (localX * tiltSin + localY * tiltCos) +
          Math.cos(wander + config.phase) * config.wanderY,
      };
    }

    /**
     * Glide one plane on its own spiral. It first flies in from outside
     * the banner, then loops the spiral without changing that path.
     */
    function flyPlane(el, config) {
      if (!el) {
        return;
      }

      function render(x, y, deltaX, deltaY, bank) {
        var width = bounds.offsetWidth;
        var height = bounds.offsetHeight;

        if (!width || !height) {
          return 0;
        }

        var facingLeft = deltaX < 0;

        if (Math.abs(deltaX) < width * 0.004) {
          facingLeft = el.dataset.heroFacing === 'left';
        }

        el.dataset.heroFacing = facingLeft ? 'left' : 'right';

        var heading = wrapDegrees((Math.atan2(deltaY, deltaX) * 180) / Math.PI);
        var tilt = Math.max(-18, Math.min(18, bank || 0));

        gsap.set(el, {
          top: 0,
          left: 0,
          xPercent: 0,
          yPercent: 0,
          x: x * width - el.offsetWidth / 2,
          y: y * height - el.offsetHeight / 2,
          rotation: wrapDegrees(heading - artworkNose(config.nose, facingLeft) + tilt),
          scaleX: facingLeft ? -1 : 1,
          transformOrigin: '50% 50%',
        });

        return heading;
      }

      function place(progress) {
        var width = bounds.offsetWidth;
        var height = bounds.offsetHeight;
        var here = spiralPoint(progress, config);
        var ahead = spiralPoint(progress + 0.012, config);
        var further = spiralPoint(progress + 0.024, config);
        var deltaX = (ahead.x - here.x) * width;
        var deltaY = (ahead.y - here.y) * height;
        var nextHeading = wrapDegrees(
          (Math.atan2((further.y - ahead.y) * height, (further.x - ahead.x) * width) * 180) / Math.PI
        );
        var heading = wrapDegrees((Math.atan2(deltaY, deltaX) * 180) / Math.PI);
        var bank = wrapDegrees(nextHeading - heading) * config.bank;

        return render(here.x, here.y, deltaX, deltaY, bank);
      }

      function entryPoint(amount, target) {
        var from = config.from;
        var dx = target.x - from.x;
        var dy = target.y - from.y;
        var length = Math.sqrt(dx * dx + dy * dy) || 1;
        var bow = Math.sin(amount * Math.PI) * config.enterArc;

        return {
          x: from.x + dx * amount + (-dy / length) * bow,
          y: from.y + dy * amount + (dx / length) * bow,
        };
      }

      function beginSpiral() {
        var proxy = { t: 0 };

        place(0);

        gsap.to(proxy, {
          t: 1,
          duration: config.duration,
          ease: 'none',
          repeat: -1,
          onUpdate: function () {
            place(proxy.t);
          },
        });
      }

      var spiralStart = spiralPoint(0, config);
      var entryProxy = { amount: 0 };

      render(
        config.from.x,
        config.from.y,
        (spiralStart.x - config.from.x) * bounds.offsetWidth,
        (spiralStart.y - config.from.y) * bounds.offsetHeight,
        0
      );

      gsap.to(entryProxy, {
        amount: 1,
        duration: config.enter,
        delay: config.delay,
        ease: 'power2.out',
        onUpdate: function () {
          var amount = entryProxy.amount;
          var here = entryPoint(Math.min(amount, 1), spiralStart);
          var probe = amount + 0.04;
          var ahead = probe <= 1 ? entryPoint(probe, spiralStart) : spiralPoint((probe - 1) * 0.25, config);
          var width = bounds.offsetWidth;
          var height = bounds.offsetHeight;
          var deltaX = (ahead.x - here.x) * width;
          var deltaY = (ahead.y - here.y) * height;

          if (amount > 0.72) {
            var mix = (amount - 0.72) / 0.28;
            var spiralAhead = spiralPoint(0.012, config);
            deltaX += ((spiralAhead.x - spiralStart.x) * width - deltaX) * mix;
            deltaY += ((spiralAhead.y - spiralStart.y) * height - deltaY) * mix;
          }

          render(here.x, here.y, deltaX, deltaY, 0);
        },
        onComplete: beginSpiral,
      });
    }

    // Three different spirals: tall clockwise, tight counter-clockwise, wide low glide.
    flyPlane(planeYellow, {
      cx: 0.4,
      cy: 0.46,
      rx: 0.26,
      ry: 0.3,
      inner: 0.36,
      turns: 2,
      direction: 1,
      breaths: 1,
      phase: 0.4,
      tilt: -0.35,
      wanderTurns: 1,
      wanderX: 0.05,
      wanderY: 0.035,
      glide: 0.08,
      bank: 1.4,
      nose: -43,
      duration: 24,
      delay: 0.15,
      from: { x: 0.32, y: -0.28 },
      enter: 2.4,
      enterArc: 0.08,
    });

    flyPlane(planeBlue, {
      cx: 0.66,
      cy: 0.5,
      rx: 0.2,
      ry: 0.26,
      inner: 0.32,
      turns: 3,
      direction: -1,
      breaths: 2,
      phase: 2.2,
      tilt: 0.55,
      wanderTurns: 2,
      wanderX: 0.04,
      wanderY: 0.04,
      glide: -0.09,
      bank: 1.5,
      nose: -38,
      duration: 18,
      delay: 0.35,
      from: { x: -0.28, y: 0.16 },
      enter: 2.2,
      enterArc: -0.07,
    });

    flyPlane(planePink, {
      cx: 0.5,
      cy: 0.62,
      rx: 0.3,
      ry: 0.2,
      inner: 0.5,
      turns: 2,
      direction: 1,
      breaths: 1,
      phase: 1.1,
      tilt: 0.2,
      wanderTurns: 1,
      wanderX: 0.03,
      wanderY: 0.06,
      glide: 0.06,
      bank: 1.1,
      nose: -38,
      duration: 28,
      delay: 0.55,
      from: { x: 1.28, y: 0.68 },
      enter: 2.6,
      enterArc: 0.06,
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
