(function() {  //IIFE pour eviter les variables globales
function hasGetUserMedia() {
	return !!(navigator.getUserMedia ||
			  navigator.webkitGetUserMedia ||
			  navigator.mozGetUserMedia || 
			  navigator.msGetUserMedia);
}
//fonction pour la creation de l'objet XMLHttpRequest Ajax
//multiverification IE, SAFARIE, CHROME.....
function getXMLHttpRequest() {
	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	
	return xhr;
}

function sub_img(objet)
{
	var id = objet.id;
	var parent = objet.parentNode;
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
		{
			if (xhr.responseText == 'yes')
			{
				parent.parentNode.removeChild(parent);
			}
			else if (xhr.responseText == 'no')
			{
				window.scrollTo(0,0);
				alert('une erreur s\'est produite!');
			}
		}
	}
	xhr.open("POST", "htdocs/delete_img.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('id='+id);
}

if (hasGetUserMedia()) {
	var video = document.getElementById('video'),
		canvas = document.getElementById('canvas'),
		gallerie = document.getElementById('gallerie'),
		context = canvas.getContext('2d'),
		photo = document.getElementById('photo'),
		save = document.getElementById('save_button'),
		streaming = false,
		width = 400,
		height = 300,
		gallerie_img = "",
		nb_gallerie_img = 0,
		iFilter = 0,
		filters = [
		'grayscale',
		'sepia',
		'blur',
		'brightness',
		'contrast',
		'hue-rotate',
		'hue-rotate2',
		'hue-rotate3',
		'saturate',
		'invert',
		'none'
		];
		vendorUrl = window.URL || window.webkitURL;

	navigator.getUserMedia =	navigator.getUserMedia ||
							navigator.webkitGetUserMedia ||
							navigator.mozGetUserMedia ||
							navigator.msGetUserMedia;

	navigator.getUserMedia({
		video: true,
		audio: false
	}, function(stream) {
		video.src = vendorUrl.createObjectURL(stream);
		video.play();
	}, function(error) {
		alert("La Webcam est bloqué par votre navigateur !");
		window.location.href = "index.php?page=compte.php";
	});

	video.addEventListener('canplay', function(ev)
	{
		if (!streaming)
		{
			video.setAttribute('width', width);
			video.setAttribute('height', height);
			canvas.setAttribute('width', width);
			canvas.setAttribute('height', height);
			streaming = true;
		}
	}, false);

	document.getElementById('capture').addEventListener('click', function() {
		context.drawImage(video, 0, 0, width, height);
		photo.setAttribute('src', canvas.toDataURL('image/png'));
		save.style.visibility = 'visible';
		document.getElementById('filtre').style.visibility = "visible";
	});

	document.getElementById('filtre').addEventListener('click', function() {
		video.className = '';
		video.classList.add('pictured');
		var effet = filters[iFilter++ % filters.length];
		if (effet) {
			video.classList.add(effet);
		}
	});

	save.addEventListener('click', function() {
		var dataURL = photo.src;
		var tosend = 'data=' + dataURL;
		var xhr = getXMLHttpRequest();	//create object XHR go up for function
		xhr.open("POST", "htdocs/save_to_img.php", true); //true pour asynchrone
		//si methode POST modifier le type MIME avec la ligne suivante
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function() {
			if (xhr.readyState < 4) {
				save.value = "Enregistrement en Cours";
			}
			else if (xhr.readyState == 4 && xhr.status == 200) {
				var return_data = xhr.responseText;
				if (return_data !== "false") {
					alert(return_data);
					save.style.visibility = 'hidden';
					var balise = "<div class='col-6 vignette'><img id='cross_img'\
					 width='100%' src='"+dataURL+"'><button id='"+return_data+"'\
					  class='cross' onclick='sub_img(this)'>X</button></div>";
					gallerie_img += balise;
					gallerie.innerHTML = gallerie_img;
				}
			}
		}
		//envoi de la requete
		xhr.send(tosend);
		nb_gallerie_img++;
	});

}
else {
	alert("getUserMedia() n'est pas supporté par votre navigateur !");
	window.location.href = "index.php?page=compte.php";
}
})();