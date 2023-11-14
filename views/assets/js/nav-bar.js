const hamburguerMenu = document.querySelector('.hamburguer-menu');
const menu = document.querySelector('.nav-bar div');
const profileImg = document.querySelector('#user-profile-img');

const user = JSON.parse(localStorage.getItem('user'));
if (user) {
  profileImg.style.backgroundImage = `url(${user.img_user})`;
}

hamburguerMenu.addEventListener('click', (e) => {
  const isClickInsideButton = hamburguerMenu.contains(e.target) || e.target === hamburguerMenu;
  console.log(isClickInsideButton);
  if (isClickInsideButton) {
    menu.classList.toggle('active');
    menu.classList.toggle('inactive');
    console.log(menu.classList);
  }
});

document.addEventListener('click', (event) => {
  const isClickInsideMenu = menu.contains(event.target) || event.target === hamburguerMenu || hamburguerMenu.contains(event.target);
  if (!isClickInsideMenu) {
    menu.classList.remove('active');
    menu.classList.add('inactive');
  }
});
