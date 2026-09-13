// CompassDialUp Master Client Script
document.addEventListener('DOMContentLoaded', () => {
  // 1. Mobile Drawer Synchronization
  const mobileToggle = document.getElementById('mobile-toggle');
  const mobileDrawer = document.getElementById('mobile-drawer');

  if (mobileToggle && mobileDrawer) {
    mobileToggle.addEventListener('click', () => {
      mobileDrawer.classList.toggle('active');
      mobileToggle.classList.toggle('active');
    });

    mobileDrawer.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        mobileDrawer.classList.remove('active');
        mobileToggle.classList.remove('active');
      });
    });
  }

  // 2. Interactive FAQs Accordion
  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(item => {
    const question = item.querySelector('.faq-question');
    if (question) {
      question.addEventListener('click', () => {
        const isActive = item.classList.contains('active');
        faqItems.forEach(i => i.classList.remove('active'));
        if (!isActive) {
          item.classList.add('active');
        }
      });
    }
  });

  // 3. Interactive Solar Compass & Azimuth Bearing Calculator
  const hemisphereSelect = document.getElementById('calc-hemisphere');
  const localTimeInput = document.getElementById('calc-localtime');
  const declinationInput = document.getElementById('calc-declination');
  const resultAzimuth = document.getElementById('calc-azimuth-val');
  const resultHourAngle = document.getElementById('calc-hourangle-val');
  const resultTrueNorth = document.getElementById('calc-truenorth-val');

  function updateCompassCalculations() {
    if (!hemisphereSelect || !localTimeInput || !declinationInput) return;
    const hemi = hemisphereSelect.value;
    const timeVal = localTimeInput.value || "14:30";
    const declination = parseFloat(declinationInput.value) || 0;

    const parts = timeVal.split(':');
    const hours = parseInt(parts[0], 10) || 12;
    const minutes = parseInt(parts[1], 10) || 0;
    const totalHours = hours + minutes / 60.0;

    // Hour angle of the watch hour hand (0° at 12 o'clock, 30° per hour)
    const hourHandDegrees = (totalHours % 12) * 30;

    // In Northern Hemisphere: bisect the angle between hour hand pointed at sun and 12 o'clock marker to find South.
    // In Southern Hemisphere: bisect angle between 12 o'clock pointed at sun and hour hand to find North.
    let trueNorthAzimuth = 0;
    if (hemi === 'northern') {
      const southBearing = hourHandDegrees / 2.0;
      trueNorthAzimuth = (southBearing + 180 + declination + 360) % 360;
    } else {
      trueNorthAzimuth = (hourHandDegrees / 2.0 + declination + 360) % 360;
    }

    const cardinalLetter = getCardinal(trueNorthAzimuth);

    if (resultAzimuth) resultAzimuth.textContent = `${Math.round(trueNorthAzimuth)}° ${cardinalLetter}`;
    if (resultHourAngle) resultHourAngle.textContent = `${Math.round(hourHandDegrees)}° (Hour Mark)`;
    if (resultTrueNorth) resultTrueNorth.textContent = `${cardinalLetter} (${(trueNorthAzimuth).toFixed(1)}° True)`;
  }

  function getCardinal(deg) {
    const directions = ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW'];
    const index = Math.round(deg / 22.5) % 16;
    return directions[index];
  }

  if (hemisphereSelect && localTimeInput && declinationInput) {
    [hemisphereSelect, localTimeInput, declinationInput].forEach(el => {
      el.addEventListener('change', updateCompassCalculations);
      el.addEventListener('input', updateCompassCalculations);
    });
    updateCompassCalculations();
  }
});
