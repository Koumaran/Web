// Main initialization
document.addEventListener('DOMContentLoaded', function() {
// Global variables
var video = document.querySelector('video');
//var audio, audioType;
var canvas = document.querySelector('canvas');
var context = canvas.getContext('2d');
// Custom video filters
var iFilter = 0;
var filters = [
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
var streaming = false,
	width = 500,
	height = 0,
	startbutton = document.querySelector('#startbutton');
// Get the video stream from the camera with getUserMedia
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
navigator.mozGetUserMedia || navigator.msGetUserMedia;
window.URL = window.URL || window.webkitURL || window.mozURL || window.msURL;
if (navigator.getUserMedia) {
// Evoke getUserMedia function
navigator.getUserMedia({video: true, audio: false}, onSuccessCallback, onErrorCallback);
function onSuccessCallback(stream) {
// Use the stream from the camera as the source of the video element
video.src = window.URL.createObjectURL(stream) || stream;
// Autoplay
video.play();
/* HTML5 Audio
audio = new Audio();
audioType = getAudioType(audio);
if (audioType) {
audio.src = 'polaroid.' + audioType;
audio.play();
}
*/
}
// Display an error
function onErrorCallback(e) {
var expl = 'An error occurred: [Reason: ' + e.code + ']';
console.error(expl);
alert(expl);
return;
}
} else {
document.querySelector('.container').style.visibility = 'hidden';
document.querySelector('.warning').style.visibility = 'visible';
return;
}
// Draw the video stream at the canvas object
video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

// Add event listener for our Button (to switch video filters)
document.querySelector('canvas').addEventListener('click', function() {
canvas.className = '';
var effect = filters[iFilter++ % filters.length]; // Loop through the filters.
if (effect) {
canvas.classList.add(effect);
}
}, false);
}, false);