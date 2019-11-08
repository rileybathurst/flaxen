// mini menu
let miniMenu = document.getElementById("minimenu");

function touchMenu() {
	miniMenu.classList.toggle("minimenu-open");
}

// click outside the minimenu to remove it
function remover() {
	if (miniMenu.classList.contains('minimenu-open')) {
		miniMenu.classList.remove("minimenu-open");
	}
}