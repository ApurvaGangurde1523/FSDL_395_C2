let username = document.getElementById("username");
let email = document.getElementById("email");
let phone = document.getElementById("phone");
let zip = document.getElementById("zip");
let password = document.getElementById("password");

// Real-time validation
function validateInput(input, pattern, errorId, message) {
    let error = document.getElementById(errorId);

    input?.addEventListener("input", function() {
        if(pattern.test(input.value)){
            input.classList.remove("invalid");
            input.classList.add("valid");
            error.innerHTML="";
        } else {
            input.classList.remove("valid");
            input.classList.add("invalid");
            error.innerHTML=message;
        }
    });
}

validateInput(username,/^[a-zA-Z0-9_]{3,}$/,"userError","Min 3 characters");
validateInput(email,/^[^ ]+@[^ ]+\.[a-z]{2,3}$/,"emailError","Invalid Email");
validateInput(phone,/^[0-9]{10}$/,"phoneError","10 digit phone required");
validateInput(zip,/^[0-9]{6}$/,"zipError","Invalid Zip");
validateInput(password,/^.{6,}$/,"passError","Minimum 6 characters");

// Password strength
password?.addEventListener("input",function(){
    let bar=document.getElementById("strengthBar");
    let val=password.value;

    if(val.length<6){
        bar.style.width="30%";
        bar.style.background="red";
    }
    else if(val.match(/[A-Z]/)&&val.match(/[0-9]/)){
        bar.style.width="100%";
        bar.style.background="#10b981";
    }
    else{
        bar.style.width="60%";
        bar.style.background="orange";
    }
});

// Submit
document.getElementById("loginForm")?.addEventListener("submit",function(e){
    e.preventDefault();

    if(document.querySelectorAll(".invalid").length===0){
        $("#loader").fadeIn();
        setTimeout(function(){
            $("#loader").fadeOut();
            $("#toast").text("Login Successful 🚀").fadeIn().delay(1500).fadeOut();
            window.location.href="success.html";
        },2000);
    } else {
        $("#toast").text("Fix errors first.").fadeIn().delay(2000).fadeOut();
    }
});

// DOM LAB FUNCTIONS
function changeText(){
    document.getElementById("domTitle").innerHTML="Text Changed Successfully!";
}

function changeStyle(){
    let p=document.getElementsByClassName("textNode");
    p[0].style.color="yellow";
    p[0].style.position="relative";
    p[0].style.left="20px";
}

function swapImage(){
    document.getElementById("myImage").src="https://via.placeholder.com/200/3b82f6/ffffff";
}

function addNode(){
    let newNode=document.createElement("p");
    let text=document.createTextNode("New Node Added!");
    newNode.appendChild(text);
    document.body.appendChild(newNode);
}

function deleteNode(){
    let elements=document.getElementsByTagName("p");
    if(elements.length>0){
        elements[elements.length-1].remove();
    }
}

// jQuery operations
$(document).ready(function(){

    $("#jqBtn").click(function(){
        $(this).text("Text Changed via jQuery");
    });

    $("body").css("background-image",
        "linear-gradient(135deg,#1e293b,#0f172a)");

    $("#jqBtn").attr("title","jQuery Button Tooltip");

});


/* ===============================
   SAFE PARTICLES (No Conflict)
================================ */

(function(){
  const canvas = document.getElementById("particles");
  if(!canvas) return;

  const ctx = canvas.getContext("2d");
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  let particles = [];

  for(let i=0;i<60;i++){
    particles.push({
      x: Math.random()*canvas.width,
      y: Math.random()*canvas.height,
      size: Math.random()*3 + 1,
      speed: Math.random()*1 + 0.5
    });
  }

  function animate(){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    ctx.fillStyle="rgba(255,255,255,0.3)";

    particles.forEach(p=>{
      p.y += p.speed;
      if(p.y > canvas.height){
        p.y = 0;
        p.x = Math.random()*canvas.width;
      }
      ctx.beginPath();
      ctx.arc(p.x,p.y,p.size,0,Math.PI*2);
      ctx.fill();
    });

    requestAnimationFrame(animate);
  }

  animate();
})();


