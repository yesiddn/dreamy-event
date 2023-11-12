const hamburguerMenu = document.querySelector('.hamburguer-menu');
const menu = document.querySelector('.nav-bar div');

hamburguerMenu.addEventListener('click', () => {
  menu.classList.toggle('active');
  menu.classList.toggle('inactive');
});

document.addEventListener('click', (event) => {
  const isClickInsideMenu = menu.contains(event.target) || event.target === hamburguerMenu;
  if (!isClickInsideMenu) {
    menu.classList.remove('active');
    menu.classList.add('inactive');
  }
});
