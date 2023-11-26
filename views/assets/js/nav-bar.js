
const hamburguerMenu = document.querySelector('.hamburguer-menu');
const menu = document.querySelector('.nav-bar ul');
const profileImg = document.querySelector('#user-profile-img');

const customer = JSON.parse(localStorage.getItem('customer'));
if (customer) {
  const idCustomer = customer.id_customer;
  localStorage.setItem('idCustomer', idCustomer);
  profileImg.style.backgroundImage = `url('${customer.img_profile}')`;
}


hamburguerMenu.addEventListener('click', (e) => {
  const isClickInsideButton = hamburguerMenu.contains(e.target) || e.target === hamburguerMenu;
  
  if (isClickInsideButton) {
    menu.classList.toggle('active');
    menu.classList.toggle('inactive');
  }
});

document.addEventListener('click', (event) => {
  const isClickInsideMenu = menu.contains(event.target) || event.target === hamburguerMenu || hamburguerMenu.contains(event.target);
  
  if (!isClickInsideMenu) {
    menu.classList.remove('active');
    menu.classList.add('inactive');
  }
});

