var video = document.getElementById('video'),
		canvas = document.getElementById('canvas'),
		gallerie = document.getElementById('gallerie'),
		photo = document.getElementById('photo'),
		save = document.getElementById('save_button'),
		streaming = false,
		width = 400,
		height = 300,
		gallerie_img = [],
		nb_gallerie_img = 0, //pour pagination a faire
		i = 0, //compteur multiusage
		effet = 0,
		iFilter = 0,
		filters = [
		'blur(2px)',
		'brightness(2)',
		'contrast(200%)',
		'grayscale(50)',
		'hue-rotate(90deg)',
		'invert(75%)',
		'opacity(50%)',
		'saturate(50)',
		'sepia(80%)',
		'none'],
		vendorUrl = window.URL || window.webkitURL;

function hasGetUserMedia() {
	return !!(navigator.getUserMedia ||
			  navigator.webkitGetUserMedia ||
			  navigator.mozGetUserMedia || 
			  navigator.msGetUserMedia);
};
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
};

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
	xhr.send('photo='+id);
};

function add_montage(montage) 
{
	var img;
	if (img = document.getElementById('montage'))
	{
		if (img.src == montage.src)
		{
			img.parentNode.removeChild(img);
			img = false;
			document.getElementById('filtre').style.visibility = 'hidden';
			document.getElementById('capture').style.visibility = 'hidden';
			return;
		}
		else
		{
			img.parentNode.removeChild(img);
			img = false;
		}
	}
	img = document.createElement('img');
	img.setAttribute('src', montage.src);
	img.setAttribute('alt', montage.title);
	img.setAttribute('draggable', 'true');
//	img.setAttribute('onclick', 'drag_montage(this)');
	img.id = 'montage';
	img.style.position = 'absolute';
	img.style.top = '0px';
	document.getElementById('filtre').style.visibility = "visible";
	document.getElementById('capture').style.visibility = "visible";
	document.getElementById('photo_booth').appendChild(img);
}

if (hasGetUserMedia()) {

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

	document.getElementById('capture').addEventListener('click', function(event) {
		var context = canvas.getContext('2d');
		var montage = document.getElementById('montage');
		var width_img = montage.width;
		var height_img = montage.height;
		var x = montage.offsetLeft;
		var y = montage.offsetTop;
		/* ajoute le filtre au canvas selon le navigateur */
		if (effet) {
			context.webkitFilter = effet;
			context.mozFilter = effet;
			context.filter = effet;
		}
		else
			context.filter = 'none';
		context.drawImage(video, 0,0, width, height);
		context.drawImage(montage, x, y, width_img, height_img);
		photo.setAttribute('src', canvas.toDataURL('image/png'));
		save.style.visibility = 'visible';
		document.getElementById('filtre').style.visibility = "visible";
		event.preventDefault();
	});

	document.getElementById('filtre').addEventListener('click', function(event) {
		effet = filters[iFilter++ % filters.length];
		/* ajoute le filtre au video selon navigateur */
		if (effet) {
			video.style.webkitFilter = effet;
			video.style.mozFilter = effet;
			video.style.filter= effet;
		}
		event.preventDefault();
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
					var div_gallerie = document.getElementById('gallerie');
					if (!div_gallerie) {
						div_gallerie = document.createElement('div');
						div_gallerie.setAttribute('class', 'col-11 scrool');
						div_gallerie.setAttribute('id', 'gallerie');
						var big_div = document.getElementById('container');
						big_div.appendChild(div_gallerie);
					}
					save.style.visibility = 'hidden';
					var new_div = document.createElement("div");
					new_div.setAttribute('class', 'col-s vignette');
					new_div.innerHTML = "<img id='cross_img' width='100%' src='images/"+return_data+"'>\
					<button id='images/"+return_data+"' class='cross' onclick='sub_img(this);'>X</button>";
					div_gallerie.insertBefore(new_div, div_gallerie.firstChild);
				}
			}
		}
		//envoi de la requete
		xhr.send(tosend);
	});

	//ajout du boutton d'ajout d'image
	var file_getter = document.createElement('input');
	file_getter.setAttribute('id', 'add_file');
	file_getter.setAttribute('type', 'file');
	file_getter.setAttribute('accept', '.png, .jpeg, .gif');
	document.getElementById('container').insertBefore(file_getter, gallerie);
}
else {
	alert("La Webcam n'est pas supporté par votre navigateur !");
	var file_getter = document.createElement('input');
	file_getter.setAttribute('id', 'add_file');
	file_getter.setAttribute('type', 'file');
	file_getter.setAttribute('accept', '.png, .jpeg, .gif');
	document.getElementById('photo_booth').removeChild(video);
	document.getElementById('photo_booth').appendChild(file_getter);
};

add_file.addEventListener('change', function() {
	var file = document.getElementById('add_file').files[0];
	var reader = new FileReader();
	reader.onloadend = function() {
		var ext = file.name.match(/\.([^\.]+)$/)[1];
		switch (ext) {
			case 'pgn':
			case 'jpeg':
			case 'gif':
				break;
			default:
				return;
		}
		if (document.getElementById('video'))
			document.getElementById('photo_booth').removeChild(video);
		var image = document.createElement('img');
		image.setAttribute('id', 'image');
		var img_dl = reader.result;
		img_dl.width = "400px";
		img_dl.height = "300px";
		image.src = 'url('+img+')';
		document.getElementById('photo_booth').removeChild(document.getElementById('add_file'));
		document.getElementById('photo_booth').appendChild(image);

	}
});


