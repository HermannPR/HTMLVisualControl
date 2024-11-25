// script.js

// Load the header
fetch('src/components/header/header.html')
    .then(response => response.text())
    .then(data => {
        document.getElementById('header-placeholder').innerHTML = data;
    })
    .catch(error => console.error('Error loading header:', error));

// Load the footer
fetch('src/components/footer/footer.html')
    .then(response => response.text())
    .then(data => {
        document.getElementById('footer-placeholder').innerHTML = data;
    })
    .catch(error => console.error('Error loading footer:', error));

// Load the background
fetch('background.html')
    .then(response => response.text())
    .then(data => {
        document.body.insertAdjacentHTML('afterbegin', data);
    })
    .catch(error => console.error('Error loading background:', error));

// Smooth scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Intersection Observer for animations
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        } else {
            entry.target.classList.remove('visible');
        }
    });
}, {
    threshold: 0.1
});

document.querySelectorAll('section').forEach(section => {
    observer.observe(section);
});

// Update animation state based on scroll position
window.addEventListener('scroll', () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrollProgress = (scrollTop / scrollHeight) * 100;

    document.documentElement.style.setProperty('--scroll-progress', `${scrollProgress}px`);
});

// Existing script code for color-changing logo
// ... (include your existing code here)

function generateGradientColors(startColor, endColor, steps) {
    const start = hexToRgb(startColor);
    const end = hexToRgb(endColor);
    const stepFactor = 1 / (steps - 1);
    const gradientColors = [];

    for (let i = 0; i < steps; i++) {
        const r = Math.round(lerp(start.r, end.r, stepFactor * i));
        const g = Math.round(lerp(start.g, end.g, stepFactor * i));
        const b = Math.round(lerp(start.b, end.b, stepFactor * i));
        gradientColors.push(rgbToHex(r, g, b));
    }

    return gradientColors;
}

function hexToRgb(hex) {
    const bigint = parseInt(hex.slice(1), 16);
    const r = (bigint >> 16) & 255;
    const g = (bigint >> 8) & 255;
    const b = bigint & 255;
    return { r, g, b };
}

function rgbToHex(r, g, b) {
    return `#${((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1)}`;
}

function lerp(start, end, t) {
    return start + (end - start) * t;
}

const steps = 100;
const blueToPink = generateGradientColors('#1500ff', '#ff00ff', steps);
const pinkToPearl = generateGradientColors('#ff00ff', '#eae0c8', steps);
const pearlToBlue = generateGradientColors('#eae0c8', '#1500ff', steps);
const colors = [...blueToPink, ...pinkToPearl, ...pearlToBlue].map(color => [color, color]);

let currentIndex = 0;

function changeColors() {
    const root = document.documentElement;
    root.style.setProperty('--color1', colors[currentIndex][0]);
    root.style.setProperty('--color6', colors[currentIndex][1]);
    currentIndex = (currentIndex + 1) % colors.length;
}

setInterval(changeColors, 200); // Change colors every 200 milliseconds