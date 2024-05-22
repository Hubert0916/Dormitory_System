document.addEventListener("DOMContentLoaded", function() {
	const dropdown = document.querySelector('.dropdown');
	const dropdownMenu = document.querySelector('.dropdown-menu');

	dropdown.addEventListener('click', function(event) {
		dropdownMenu.classList.toggle('show');
	});

	document.addEventListener('click', function(event) {
		if (!dropdown.contains(event.target)) {
			dropdownMenu.classList.remove('show');
		}
	});

});