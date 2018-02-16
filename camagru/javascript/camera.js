var video = document.getElementById('video'),
		canvas = document.getElementById('canvas'),
		galerie = document.getElementById('galerie'),
		photo = document.getElementById('photo'),
		save = document.getElementById('save_button'),
		streaming = false,
		width = 400,
		height = 300,
		galerie_img = [],
		nb_galerie_img = 0, //pour pagination a faire
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
var tmp_div;

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

function add_file(evt) 
{
	var tgt = evt.target || window.event.srcElement,
		files = tgt.files;

	//fileReader support
	if (FileReader && files &&files.length)
	{
		var reader = new FileReader();
		var image = document.createElement('img');
		image.setAttribute('id', 'image');
		reader.onload = function() {
			if (document.getElementById('video'))
				document.getElementById('photo_booth').removeChild(video);
			image.src = reader.result;
		}
		reader.readAsDataURL(files[0]);
		document.getElementById('photo_booth').appendChild(image);
		document.getElementById('div_file').removeChild(document.getElementById('add_file'));			
		document.getElementById('image').style.width = "400px";
		document.getElementById('image').style.height = "300px";
		var go_back = document.createElement('input');
		go_back.type = 'button';
		go_back.value = 'Webcam';
		go_back.setAttribute('onclick', "window.location='index.php?page=photobooth.php'");
		document.getElementById('div_file').appendChild(go_back);
	}
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
	var p = document.getElementById('photo_booth');
	var p_width = video.offsetWidth;
	var p_height = video.offsetHeight;
	img = document.createElement('img');
	img.setAttribute('src', montage.src);
	img.setAttribute('alt', montage.title);
	img.setAttribute('draggable', 'false');
	img.width = 100;
	img.setAttribute('onmousedown', 'mouseDown()');
	img.setAttribute('onmouseup', 'mouseUp()');
	//on ajoute ici le déplacer la version web mobile (touch)
	img.addEventListener('touchmove', function(event) {
		var touch = event.targetTouches[0];
		var draggable = document.getElementById('montage');
		
		//place element where the finger is
		draggable.style.left = touch.pageX - 60 + 'px';
		draggable.style.top = touch.pageY - 300 + 'px';
		event.preventDefault();
	}, false);
	img.id = 'montage';
	img.style.position = 'absolute';
	document.getElementById('filtre').style.visibility = "visible";
	document.getElementById('capture').style.visibility = "visible";
	document.getElementById('photo_booth').appendChild(img);
}

function mouseDown() {
	var montage = document.getElementById('montage');
	var photo_booth = document.getElementById('photo_booth');
	var left = photo_booth.offsetLeft;
	var top = photo_booth.offsetTop;
	montage.addEventListener('mousemove', mouseDown, true);
	montage.style.left = event.pageX - left - 25 + 'px';
	montage.style.top = event.pageY - top - 25 + 'px';
}

function mouseUp() {
	var montage = document.getElementById('montage');
	montage.removeEventListener('mousemove', mouseDown, true);
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
		canvas.setAttribute('width', width);
		canvas.setAttribute('height', height);
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
		var image = document.getElementById('image');
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
		if (image)
			context.drawImage(image, 0, 0, width, height);
		else
			context.drawImage(video, 0,0, width, height);
		context.drawImage(montage, x, y, width_img, height_img);
		photo.setAttribute('src', canvas.toDataURL('image/png'));
		save.style.visibility = 'visible';
		document.getElementById('filtre').style.visibility = "visible";
		event.preventDefault();
	});

	document.getElementById('filtre').addEventListener('click', function(event) {
		effet = filters[iFilter++ % filters.length];
		var image = document.getElementById('image');
		var montage = document.getElementById('montage');
		/* ajoute le filtre au video selon navigateur */
		if (image && effet) {
			image.style.webkitFilter = effet;
			image.style.mozFilter = effet;
			image.style.filter = effet;
			montage.style.webkitFilter = effet;
			montage.style.mozFilter = effet;
			montage.style.filter = effet;
		}
		else if (effet) {
			video.style.webkitFilter = effet;
			video.style.mozFilter = effet;
			video.style.filter = effet;
			montage.style.webkitFilter = effet;
			montage.style.mozFilter = effet;
			montage.style.filter = effet;
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
			if (xhr.readyState == 4 && xhr.status == 200) {
				var return_data = xhr.responseText;
				if (return_data !== "false") {
					var div_galerie = document.getElementById('galerie');
					if (!div_galerie) {
						div_galerie = document.createElement('div');
						div_galerie.setAttribute('class', 'col-11 scrool');
						div_galerie.setAttribute('id', 'galerie');
						var big_div = document.getElementById('container');
						big_div.appendChild(div_galerie);
					}
					save.style.visibility = 'hidden';
					var new_div = document.createElement("div");
					new_div.setAttribute('class', 'col-s vignette');
					new_div.innerHTML = "<img id='cross_img' width='100%' src='images/"+return_data+"'>\
					<button id='images/"+return_data+"' class='cross' onclick='sub_img(this);'>X</button>";
					div_galerie.insertBefore(new_div, div_galerie.firstChild);
				}
			}
		}
		//envoi de la requete
		xhr.send(tosend);
	});

	//ajout du boutton d'ajout d'image
	var file_getter = document.createElement('input');
	tmp_div = document.createElement('div');
	tmp_div.setAttribute('id', 'div_file');
	file_getter.setAttribute('id', 'add_file');
	file_getter.setAttribute('type', 'file');
	file_getter.setAttribute('accept', '.png, .jpeg, .gif');
	file_getter.setAttribute('onchange', 'add_file(this)');
	tmp_div.setAttribute('class', 'col-12');
	tmp_div.appendChild(file_getter);
	document.getElementById('container').insertBefore(tmp_div, document.getElementById('button_box'));
}
else {
	alert("La Webcam n'est pas supporté par votre navigateur !");
	tmp_div = document.createElement('div');
	var file_getter = document.createElement('input');
	file_getter.setAttribute('id', 'add_file');
	file_getter.setAttribute('type', 'file');
	file_getter.setAttribute('accept', '.png, .jpeg, .gif');
	file_getter.setAttribute('onchange', 'add_file(this)');
	document.getElementById('photo_booth').removeChild(video);
	tmp_div.setAttribute('class', 'col-12');
	tmp_div.appendChild(file_getter);
	document.getElementById('container').insertBefore(tmp_div, document.getElementById('button_box'));
};


