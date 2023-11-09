const hamburguerMenu = document.querySelector('.hamburguer-menu');
const navBar = document.querySelector('.nav-bar');
const menu = document.querySelector('.nav-bar div');
const loginButton = document.querySelector('.log-in-btn');
// const signupBUtton = document.querySelector('.sign-up-btn');

const loginSection = document.querySelector('#login-section');
const loginForm = document.querySelector('.form__container');
// const signupSection = document.querySelector('#signup-section');


hamburguerMenu.addEventListener('click', () => {
  menu.classList.toggle('active');
  menu.classList.toggle('inactive');
});

loginButton.addEventListener('click', () => {
  loginSection.classList.toggle('active');
  loginSection.classList.toggle('inactive');
  menu.classList.toggle('active');
  menu.classList.toggle('inactive');
}
);

loginSection.addEventListener('click', (event) => {
  if (event.target === loginSection) {
    loginSection.classList.toggle('active');
    loginSection.classList.toggle('inactive');
  }
}
);