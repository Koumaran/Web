
var xhr = getXMLHttpRequest();
/* var user_id = get_user_id();
var img_tab = get_img(); */

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

// pagination infinit
/* function get_img() {
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
		{
			$result = xhr.responseText;
			img_tab = JSON.parse($result);
			if (img_tab)
				print_img(0, img_tab.length);
		}
	}
	xhr.open("GET", "htdocs/gestion_img.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send();
}

function create_div(class_name, id_name) {
	let new_div = document.createElement('div');
	new_div.setAttribute('class', class_name);
	new_div.setAttribute('id', id_name);
	return new_div;
}

function print_img(start_number, end_number)
{
	if (start_number < end_number)
	{
		let i = 0;
		let div_big_img_box;		
		while (start_number < end_number && img_tab[start_number]) {
			if (i % 3 == 0) {
				div_big_img_box = create_div('col-12', 'big_img_box');
				document.getElementById('container').appendChild(div_big_img_box);
			}
			i++;
			let div_img_box = create_div('col-3 margin_d', 'img_box');
			let up_gallerie = create_div('booth', 'up_galerie');
			let pic_galerie = create_div('pic_galerie', 'pic_galerie');
			let img = document.createElement('img');
			img.setAttribute('src', img_tab[start_number].img);
			up_gallerie.appendChild(img);
			up_gallerie.appendChild(pic_galerie);
			div_img_box.appendChild(up_gallerie);
			div_big_img_box.appendChild(div_img_box);
			start_number++;
		}
	}
}
 */

// fonction opposer de insertBefor 
function insertAfter(newElement,targetElement) {
    var parent = targetElement.parentNode;

    if (parent.lastChild == targetElement) {
        parent.appendChild(newElement);
    } else {
        parent.insertBefore(newElement, targetElement.nextSibling);
    }
}

function get_like(objet) {
	var img_id = objet.id;
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
		{
			$result = xhr.responseText;
			if ($result !== 'fasle')
			{
				if (objet.classList == 'not_like') {
					objet.classList = '';
					objet.classList = 'like';
					objet.value = $result;
				} else if (objet.classList == 'like') {
					objet.classList = '';
					objet.classList = 'not_like';
					objet.value = "Like";
				}
			}
			else
				console.log('erreur sur like::'+xhr.responseText);
		}
	}
	xhr.open("POST", "htdocs/gestion_like.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('img='+img_id);
}

function add_comment(objet) {
	var img_id = objet.id;
	var value = objet.value;
	if (value !== '') {
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
			{
				var response = xhr.responseText;
				if (response !== 0) {
					info = response.split('|');
					var new_div = document.createElement("div");
					new_div.setAttribute('class', 'dialogbox');
					new_div.setAttribute('id', info[0]);
					new_div.innerHTML = "<span>"+info[1]+"</span><div class='message'><span>"+value+"</span></div><button class='cross' onclick='sub_comment(this);'>X</button>";
					parent.insertAfter(new_div, objet);
				}
			}
		}
	xhr.open("POST", "htdocs/gestion_comment.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("img_id="+img_id+"&value="+value+"&state=1");
	}
	objet.value = '';
}

function sub_comment(objet) {
	var parent = objet.parentNode;
	var id = parent.id;
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
		{
			if (xhr.responseText == 'no')
			{
				window.scrollTo(0,0);
				alert('une erreur s\'est produite!');
			}
			else
				parent.remove();
		}
	}
	xhr.open("POST", "htdocs/gestion_comment.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('id_comment='+id+"&state=2");
}

