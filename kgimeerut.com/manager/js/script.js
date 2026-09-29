let toggle_sm = document.querySelector('#toggle-sm');
let main_dashboard = document.querySelector('section.main-dashboard');
	
	main_dashboard?.addEventListener(
		'click',
		function(){
			sidebar.classList.remove('left0');
		}, true)

	toggle_sm?.addEventListener(
		'click',
		function(){
			sidebar.classList.toggle('left0');
		})



let toggle_btn = document.querySelector('#toggle-btn');
let sidebar = document.querySelector('.sidebar-menu-dashboard');

	toggle_btn?.addEventListener(
		'click',
		function(){
			sidebar.classList.toggle('active');
		})

