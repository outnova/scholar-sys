document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".counter");

    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute("data-target");
            const count = +counter.innerText;
            const increment = Math.ceil(target / 100); // ajusta la velocidad

            if (count < target) {
                counter.innerText = count + increment;
                setTimeout(updateCount, 20); // ajusta el tiempo
            } else {
                counter.innerText = target;
            }
        };

        updateCount();
    });
});