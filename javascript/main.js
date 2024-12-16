function toggleNav() {
  const nav = document.querySelector(".nav");
  nav.style.display = nav.style.display === "flex" ? "none" : "flex";
  nav.style.backgroundColor = "white";
  nav.style.flexDirection = "column";
  nav.style.alignItems = "center";
}

function toggleSidebar() {
  const sidebar = document.querySelector(".sidebar");
  sidebar.classList.toggle("collapsed");
}

function loadContent(page) {
  const iframe = document.getElementById("content-frame");
  iframe.src = `../php/load_content.php?page=${page}`;
}

let currentSlide = 0;

function showSlide(index) {
  const slides = document.querySelectorAll(".carousel-slide");
  if (index >= slides.length) {
    currentSlide = 0;
  } else if (index < 0) {
    currentSlide = slides.length - 1;
  } else {
    currentSlide = index;
  }
  const offset = -currentSlide * 100;
  document.querySelector(".carousel-images").style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
  showSlide(currentSlide + 1);
}

function prevSlide() {
  showSlide(currentSlide - 1);
}

function toggleForm() {
  const signinForm = document.getElementById("signin-form");
  const signupForm = document.getElementById("signup-form");
  if (signinForm.style.display === "none") {
    signinForm.style.display = "block";
    signupForm.style.display = "none";
  } else {
    signinForm.style.display = "none";
    signupForm.style.display = "block";
  }
}

document.addEventListener("DOMContentLoaded", () => {
  showSlide(currentSlide);
});

document.addEventListener("DOMContentLoaded", function () {
        if (localStorage.getItem("signupSuccess") === "true") {
          const toast = document.getElementById("toast");
          toast.classList.add("show");
          setTimeout(() => {
            toast.classList.remove("show");
            localStorage.removeItem("signupSuccess");
          }, 3000);
        }
      });

 document.addEventListener("DOMContentLoaded", function () {
        if (localStorage.getItem("signupSuccess") === "true") {
          const toast = document.getElementById("toast-success");
          toast.classList.add("show");
          setTimeout(() => {
            toast.classList.remove("show");
            localStorage.removeItem("signupSuccess");
          }, 3000);
        }
        if (localStorage.getItem("signinFail") === "true") {
          const toast = document.getElementById("toast-fail");
          toast.classList.add("show");
          setTimeout(() => {
            toast.classList.remove("show");
            localStorage.removeItem("signinFail");
          }, 3000);
        }
      });
      document.getElementById('datetime').addEventListener('input', function () {
            const inputDate = new Date(this.value);
            const now = new Date();
            if (inputDate < now) {
                alert('The selected date and time cannot be in the past.');
                this.value = '';
            }
        });