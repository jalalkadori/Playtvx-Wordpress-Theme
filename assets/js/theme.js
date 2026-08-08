/**
 * Accessible mobile navigation toggle.
 */
document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.ptvx-menu-toggle');
  const navigation = document.querySelector('.ptvx-navigation');

  if (toggle && navigation) {
    toggle.addEventListener('click', () => {
      const isOpen = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!isOpen));
      navigation.classList.toggle('is-open', !isOpen);
    });
  }

  document.querySelectorAll('[data-ptvx-post-slider]').forEach((slider) => {
    const viewport = slider.querySelector('[data-ptvx-slider-viewport]');
    const previous = slider.querySelector('[data-ptvx-slider-prev]');
    const next = slider.querySelector('[data-ptvx-slider-next]');

    if (!viewport || !previous || !next) return;

    const getStep = () => {
      const slide = viewport.querySelector('.ptvx-post-slide');
      if (!slide) return viewport.clientWidth;

      const styles = window.getComputedStyle(viewport);
      const gap = Number.parseFloat(styles.columnGap || styles.gap) || 0;
      return slide.getBoundingClientRect().width + gap;
    };

    const updateControls = () => {
      const maximum = Math.max(0, viewport.scrollWidth - viewport.clientWidth);
      const isStatic = maximum <= 2;

      slider.classList.toggle('is-static', isStatic);
      previous.disabled = isStatic || viewport.scrollLeft <= 2;
      next.disabled = isStatic || viewport.scrollLeft >= maximum - 2;
    };

    const move = (direction) => {
      const maximum = Math.max(0, viewport.scrollWidth - viewport.clientWidth);
      const target = Math.min(maximum, Math.max(0, viewport.scrollLeft + direction * getStep()));
      viewport.scrollLeft = target;
      window.requestAnimationFrame(updateControls);
    };

    previous.addEventListener('click', () => move(-1));
    next.addEventListener('click', () => move(1));
    viewport.addEventListener('keydown', (event) => {
      if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') return;
      event.preventDefault();
      move(event.key === 'ArrowLeft' ? -1 : 1);
    });

    let frame;
    viewport.addEventListener('scroll', () => {
      window.cancelAnimationFrame(frame);
      frame = window.requestAnimationFrame(updateControls);
    }, { passive: true });

    if ('ResizeObserver' in window) {
      new ResizeObserver(updateControls).observe(viewport);
    } else {
      window.addEventListener('resize', updateControls);
    }

    updateControls();
  });
});
