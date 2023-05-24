const btn = document.querySelector('menu-btn');
const nav = document.querySelector('menu-items');
const navLinks = nav.querySelectorAll('a');

// 點擊漢堡選單按鈕時切換選單的顯示狀態
btn.addEventListener('click', () => {
  nav.classList.toggle('show');
});

// 點擊選單中的連結時隱藏選單
navLinks.forEach((link) => {
  link.addEventListener('click', () => {
    nav.classList.remove('show');
  });
});
