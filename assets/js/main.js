const perfil_menu = document.getElementById('profile_menu');
const perfil_despegable = document.querySelector('.profile__menu');
const icon_menu = document.querySelector('.icon__menu');
perfil_menu.addEventListener("click", ()=> {
	perfil_despegable.classList.toggle('active');
	if (perfil_despegable.classList.contains('active')) {
		icon_menu.classList.remove('bx-chevron-down');
		icon_menu.classList.add('bx-chevron-up');
	} 
	else {
		icon_menu.classList.remove('bx-chevron-up');
		icon_menu.classList.add('bx-chevron-down');
	}
})

const menu_lateral = document.getElementById('desplegar');
const desplegable = document.querySelector('.nav__lateral');
const icon_lateral = document.querySelector('.icon__lateral');
menu_lateral.addEventListener("click", ()=> {
	desplegable.classList.toggle('open');
	if (desplegable.classList.contains('open')) {
		icon_lateral.classList.remove('bx-chevron-right');
		icon_lateral.classList.add('bx-chevron-left');
	} 
	else {
		icon_lateral.classList.remove('bx-chevron-left');
		icon_lateral.classList.add('bx-chevron-right');
	}
})
