const menuButtonOpen = document.getElementById("menuButtonOpen");
const menuButtonClose = document.getElementById("menuButtonClose");
const navbar = document.getElementById("navbar");

function openav() {
    if (!navbar) return;
    const isHidden = window.getComputedStyle(navbar).display === 'none';
    navbar.style.display = isHidden ? 'block' : 'none';
    if (menuButtonClose) menuButtonClose.style.display = isHidden ? 'block' : 'none';
    if (menuButtonOpen) menuButtonOpen.style.display = isHidden ? 'none' : 'block';
}