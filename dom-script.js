const outputArea = document.getElementById("outputArea");

/* =========================
   ADD NODE
========================= */
function addNode() {
  const value = document.getElementById("addInput").value;
  if (value.trim() === "") return;

  const div = document.createElement("div");
  div.className = "node-item";
  div.innerText = value;

  outputArea.appendChild(div);
  document.getElementById("addInput").value = "";
}

/* =========================
   DELETE LAST NODE
========================= */
function deleteNode() {
  const nodes = document.querySelectorAll(".node-item");
  if (nodes.length > 0) {
    nodes[nodes.length - 1].remove();
  }
}

/* =========================
   CHANGE NODE COLOR
========================= */
function changeColor() {
  const nodes = document.querySelectorAll(".node-item");
  nodes.forEach(node => {
    node.style.color = getRandomColor();
  });
}

function getRandomColor() {
  return "#" + Math.floor(Math.random() * 16777215).toString(16);
}


/* =========================
   CLEAR ALL NODES
========================= */
function clearAll() {
  outputArea.innerHTML = "";
}

/* =========================
   QUOTE FUNCTIONS
========================= */
function changeQuoteText() {
  const newQuote = document.getElementById("quoteInput").value;
  if (newQuote.trim() === "") return;

  document.getElementById("quoteText").innerText = newQuote;
  document.getElementById("quoteInput").value = "";
}

function changeQuoteFont() {
  const selectedFont = document.getElementById("fontSelector").value;
  document.getElementById("quoteText").style.fontFamily = selectedFont;
}

function changeQuoteColor() {
  const selectedColor = document.getElementById("quoteColorPicker").value;
  document.getElementById("quoteText").style.color = selectedColor;
}

/* =========================
   IMAGE CONTROL
========================= */
const images = [
  "images/img1.png",
  "images/img2.png",
  "images/img3.png",
  "images/img4.png"
];

let index = 0;
const dynamicImage = document.getElementById("dynamicImage");

function changeImageManual() {
  index = (index + 1) % images.length;
  dynamicImage.style.opacity = 0;

  setTimeout(() => {
    dynamicImage.src = images[index];
    dynamicImage.style.opacity = 1;
  }, 500);
}
