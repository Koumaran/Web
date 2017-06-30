
var xhr = getXMLHttpRequest();

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

// fonction opposer de insertBefor 
function insertAfter(newElement,targetElement) {
    // target is what you want it to go after. Look for this elements parent.
    var parent = targetElement.parentNode;

    // if the parents lastchild is the targetElement...
    if (parent.lastChild == targetElement) {
        // add the newElement after the target element.
        parent.appendChild(newElement);
    } else {
        // else the target has siblings, insert the new element between the target and it's next sibling.
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
	var value = objet.value;
	var img_id = objet.id;
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





