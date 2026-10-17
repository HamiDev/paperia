/**
 * Quantity stepper on the single product page.
 */
(function () {
  document.addEventListener('click', function (event) {
    var target = event.target;

    if (!(target instanceof Element)) {
      return;
    }

    var button = target.closest('[data-qty-step]');

    if (!button) {
      return;
    }

    var wrap = button.closest('.quantity');
    var input = wrap ? wrap.querySelector('input.qty') : null;

    if (!(input instanceof HTMLInputElement) || input.readOnly || input.disabled) {
      return;
    }

    var direction = parseFloat(button.getAttribute('data-qty-step') || '0');
    var current = parseFloat(input.value);
    var step = parseFloat(input.step);
    var min = input.min === '' ? 1 : parseFloat(input.min);
    var max = input.max === '' ? Infinity : parseFloat(input.max);
    var next = (Number.isNaN(current) ? 0 : current) + direction * (Number.isNaN(step) || step <= 0 ? 1 : step);

    if (Number.isNaN(min)) {
      min = 1;
    }

    if (next < min) {
      next = min;
    }

    if (!Number.isNaN(max) && next > max) {
      next = max;
    }

    input.value = String(next);
    input.dispatchEvent(new Event('change', { bubbles: true }));
  });
})();
