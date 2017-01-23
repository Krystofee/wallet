
/*
*	Name: 		functions.js
*	Author: 	Krystofee
*	Created: 	2.1.2017
*	Desc: 		file containing all javascript background functions and event listeners
*
*	function get(elementID) : element;
*	function write(string) : boolean;
*	function alphanumeric(str) : boolean;
*	function allLetter(str) : boolean;
*	function destroySession() : AJAX;
*	function cookiesAccepted(val) : AJAX;
*	function createWallet() : AJAX;
*	
*	+ document onload events
*/

/*
*	To do list:
*					- Improve form validating in register event and in createWallet() function
*					  with form walidation functions
*/



// ------------ Functions ----------------

/*
*	get(elementID) : element;
*/
function get(elementID) {
	return document.getElementById(elementID);
}

/*
*	write(string) to the document
*/
function write(string) {
	return document.write(string);
}

/*
*	alphanumeric(str) is used in input validation
*/
function alphanumeric(str) {   
	
	var letters = /^[0-9a-zA-Z]+$/;  

	if(str.match(letters)) {  
		return true;  
	}  
	else {  
		return false;  
	}  
}  

/*
*	allLetter(str) is used in input validation
*/
function allLetter(str) {   

	var letters = /^[A-Za-z]+$/;  

	if(ustr.match(letters)) {  
		return true;  
	}  
	else {   
		return false;  
	}  
}  

/*
*	destroySession() is used to erase everything from PHP session
*/
function destroySession() {
	postData = [{'destroy' : true}];

	postData = JSON.stringify(postData);

	$.ajax({
		method: 'POST',
		datatype: 'json',
		url: 'session_AJAX.php',
		data: {myData:postData},
		success: function(out) {
			console.log(out);
			return true;
		},
		error: function(xhr, ajaxOptions, thrownError){
			console.log(xhr.status);
			return false;
		},
	});
}

/*
*	cookiesAccepted(val) is used to tell the session that cookies are accepted
*/
function cookiesAccepted(val) {
	postData = [{'name' : 'cookies_accepted', 'status': true}];

	postData = JSON.stringify(postData);

	$.ajax({
		method: 'POST',
		datatype: 'json',
		url: 'session_AJAX.php',
		data: {myData:postData},
		success: function(out) {
			console.log(out);
		},
		error: function(xhr, ajaxOptions, thrownError){
			console.log(xhr.status);
		},
	});
}

/*
*	createWallet() gets its contebt from inputs, listens to the popup button
*/
function createWallet() {
	var name = $('#new-wallet-name').val();

	// simple input validation
	// needs to be improved with validating functions
	if (name == '') {
		alert('Prázné pole název peněženky');
		return false;
	}

	var chars = ['"', "'", "/", "*", ";", ".", ",", "!", "@", "#", "&", "|"];
	if (name.includes(chars)) {
		alert('Používejte pouze písmena a číslice');
		return false;
	}



	var postData = {walletname : name};

	postData = JSON.stringify(postData); 

	$.ajax({
		method: 'POST',
		datatype: 'json',
		url: 'wallet_AJAX.php',
		data: {myData:postData},
		success: function(out) {
			console.log(out);
		},
		error: function(xhr, ajaxOptions, thrownError){
			console.log(xhr.status);
		},
	});
}

// --------------- On Load -------------------

console.log('vole');

$('#submit-register').on('click', function() {
	var username = $('#register-username').val().toLowerCase();
	var password = $('#register-password').val();
	var password2 = $('#register-password2').val();
	var email = $('#register-email').val().toLowerCase();
	var den = $('#day').val();
	var mesic = $('#month').val();
	var rok = $('#year').val();


	// needs to be improved!!

	if (username == '') {
		alert('Prázdné pole username');
		return false;
	}

	else if (email == '') {
		alert('Prázdné pole email.');
		return false;
	}

	else if (!(email.includes('@') && email.includes('.'))) {
		alert('Neplatná emailová adresa')
	}

	else if (password == '') {
		alert('Prázdné pole password');
		return false;
	}

	else if (password2 == '') {
		alert('Prázdné pole password check');
		return false;
	}

	else if (den == null) {
		alert('Prázdné pole den.');
		return false;
	}

	else if (mesic == null) {
		alert('Prázdné pole mesic.');
		return false;
	}

	else if (rok == null) {
		alert('Prázdné pole rok.');
		return false;
	}


	else if (password == password2) {
		var postData = {
			"username" : username,
			"password" : password,
			"email" : email,
			"day" : den,
			"month" : mesic,
			"year" : rok
		}

		postData = JSON.stringify(postData);

		console.log(postData);

		$.ajax({
			type: 'POST',
			datatype: 'json',
			url: 'register_AJAX.php',
			data: {myData:postData},
			success: function(html) {
				console.log(html);
				if (html[0] == '1') {
					alert('Uživatelské jméno již existuje!');
				}
				else if (html[0] == '2') {
					alert('Tento email je již registrován!')
				} 
				else if (html[0] == '0') {
					console.log('registrace proběhla úspěšně');
					$('#register-form-content').empty().html('<div class="alert alert-success"><strong>Úspěšná registrace</strong><br>Nyní se můžete přihlásit v pravém sloupci</div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError){
				console.log(xhr.status);
			},
		});
	} else {
		console.log('password != password2.');
	}
});

$('#submit-login').on('click', function() {
	var username = $('#login-username').val().toLowerCase();
	var password = $('#login-password').val();

	var postData = {
		'username' : username,
		'password' : password
	};

	postData = JSON.stringify(postData);

	$.ajax({
		type: 'POST',
		datatype: 'json',
		url: 'login_AJAX.php',
		data: {myData:postData},
		success: function(html) {
			console.log('AJAX Login sent successful!');
			console.log(html);
			if (html.includes('logged_in')) {
				$('#login-form-content').empty().html('<div class="alert alert-success"><strong>Úspěšné přihlášení</strong><br>Budete přesměrováni do uživatelského rozhraní</div>');
				window.location = 'main.php';
			} else {
				destroySession();
				$('#login-form-content').empty().html('<div class="alert alert-danger"><strong>Přihlášení nebylo úsppěšné</strong><br>Zkuste to prosím znovu, nebo si založte účet</div>');
				location.reload();
			}
		},
		error: function(xht, ajaxOptions, thrownError) {
			console.log(xhr.status);
		}
	});
});

$('[data-toggle="popover"]').popover(); 
