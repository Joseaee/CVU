const btn_left = document.getElementById('btn_left');
const btn_center = document.getElementById('btn_center');
const btn_right = document.getElementById('btn_right');
const slider_left = document.querySelector('.slider__left');
const slider_center = document.querySelector('.slider__center');
const slider_right = document.querySelector('.slider__right');

btn_left.addEventListener('click', ()=> {
	slider_center.classList.add('hidden');
	slider_right.classList.add('hidden');
	slider_left.classList.remove('hidden');
	btn_center.classList.remove('active');
	btn_right.classList.remove('active');
	btn_left.classList.add('active');
})

btn_center.addEventListener('click', ()=> {
	slider_left.classList.add('hidden');
	slider_right.classList.add('hidden');
	slider_center.classList.remove('hidden');
	btn_left.classList.remove('active');
	btn_right.classList.remove('active');
	btn_center.classList.add('active');
})

btn_right.addEventListener('click', ()=> {
	slider_left.classList.add('hidden');
	slider_center.classList.add('hidden');
	slider_right.classList.remove('hidden');
	btn_left.classList.remove('active');
	btn_center.classList.remove('active');
	btn_right.classList.add('active');
})
