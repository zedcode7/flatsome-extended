document.querySelectorAll('.before-after-container').forEach(container => {
    const slider = container.querySelector('.slider-inp');
    const textBefore = container.querySelector('.text-before');
    const textAfter = container.querySelector('.text-after');

    if (slider) {
        slider.addEventListener('input', (e) => {
            const value = parseFloat(e.target.value);
            container.style.setProperty('--position', `${value}%`);

            if (value < 35) {
                textBefore.style.opacity = '0';
                textBefore.style.pointerEvents = 'none';
                textAfter.style.opacity = '1';
                textAfter.style.pointerEvents = 'auto';
            } else if (value > 70) {
                textBefore.style.opacity = '1';
                textBefore.style.pointerEvents = 'auto';
                textAfter.style.opacity = '0';
                textAfter.style.pointerEvents = 'none';
            } else {
                textBefore.style.opacity = '1';
                textBefore.style.pointerEvents = 'auto';
                textAfter.style.opacity = '1';
                textAfter.style.pointerEvents = 'auto';
            }
        });
    }
});



/*       document.querySelectorAll('.before-after-container').forEach(container => {
    const slider = container.querySelector('.slider-inp');
    if (slider) {
        slider.addEventListener('input', (e) => {
            container.style.setProperty('--position', `${e.target.value}%`);
        });
    }
}); */
