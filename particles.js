var script = document.createElement("script");
script.src = "https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js";
document.head.appendChild(script);

script.onload = function() {
  particlesJS("particles-js", {
    particles: {
      number: { value: 80 },
      size: { value: 3 },
      move: { speed: 2 },
      line_linked: { enable: true },
    }
  });
};
