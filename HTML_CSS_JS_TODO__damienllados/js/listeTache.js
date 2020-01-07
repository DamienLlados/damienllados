
const formAjoutTodos = document.querySelector('#formAddTodos');
const nomAjoutTache = document.querySelector('#nomTodos');
const tacheAjoute = document.querySelector('#todos');
const divPopUpTag = document.querySelector('.confirm-popup');
let tabCheckbosCoche = "";

formAjoutTodos.addEventListener('submit', function (event) {
	event.preventDefault();
	tacheAjoute.innerHTML += '<div class="todo"><input class="box" type="checkbox" onclick="check()"><p name="tacheCreee">' + nomAjoutTache.value + '</p><button onclick="deleteTodo(this.parentNode)">&times;</button></div>';
	nomAjoutTache.value = '';
	localStorage.setItem('nomAjoutTaches', tacheAjoute.innerHTML);
	window.location.reload();
}, false);

let saved = localStorage.getItem('nomAjoutTaches');

if (saved) {
	tacheAjoute.innerHTML = saved;
}

tabCheckbosCoche = JSON.parse(localStorage.getItem('checked')) || [];
tabCheckbosCoche.forEach(function(checked, i) {
	$('.box').eq(i).prop('checked', checked);
});

let todoToDelete = null;

function deleteTodo(todoTag){
	if (todoTag && !todoTag.firstElementChild.checked){
		tacheAjoute.removeChild(todoTag);
	} else if (todoTag) {
		divPopUpTag.style.display = 'block';
		todoToDelete = todoTag;
	} else {
		tacheAjoute.removeChild(todoToDelete);
		closePopup();
	}
	localStorage.setItem('nomAjoutTaches', tacheAjoute.innerHTML);
	check();
	document.reload();
}


function check(){
	tabCheckbosCoche = $('.box').map(function() {
		return this.checked;
	}).get();

	localStorage.setItem("checked", JSON.stringify(tabCheckbosCoche));
}


function closePopup(){
	divPopUpTag.style.display = '';
}
