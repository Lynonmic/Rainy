const WIN_RESIZED = 'move_resized_divs';

window[WIN_RESIZED] = []; // init the window's array
const tags = []; // Define tags array
for (var i in tags) {      
  window[WIN_RESIZED].push(tags[i]);
}
window.addEventListener('resize', function(e){
  for (var i in window[WIN_RESIZED]) {
    doOnResize(window[WIN_RESIZED][i]);
  }
});

let root = document.documentElement;
let spliter = document.querySelector('.spliter__div');
let rowDiv = document.querySelector('.row__divs');
let cd1 = document.getElementById('cd-1');
let cd2 = document.getElementById('cd-2');
let isDown = false;
let isHover = false;
const MIN_WIDTH = 400;
const MAX_WIDTH = 1200;
const OFFSET = 3.5;
const MIN_WIDTH_FACTOR = 3.7;
const MAX_WIDTH_OFFSET = 22;
const ROOT_OFFSET = 9.5;

function setPosition() {
    var cl = document.querySelector('.sidebar');
    if (cl) {
        root.style.setProperty('--m-x', (cl.offsetWidth+100 + OFFSET) + 'px');
    }
    minWidth = (parseInt(rowDiv.clientWidth / 10) * MIN_WIDTH_FACTOR) + MAX_WIDTH_OFFSET;
    maxWidth = parseInt(rowDiv.clientWidth - minWidth);
}

function moveTo(e) {
    if (e.clientX > minWidth && e.clientX < maxWidth) {
        if (cd1.classList.contains('col-div-flex')) {
            cd1.classList.remove('col-div-flex');
        }
        cd1.style.width = e.clientX  + 'px';
        cd2.style.width = (rowDiv.clientWidth - cd1.width-100) + 'px';
       root.style.setProperty('--m-x', (e.clientX + ROOT_OFFSET) + 'px');
    }
}

window.addEventListener('DOMContentLoaded', function (e) {
    setPosition();
});

window.addEventListener('resize', function (e) {
    setPosition();
});

root.addEventListener('mousedown', function (e) {
    if (isHover) {
        isDown = true;
    }
}, true);

document.addEventListener('mouseup', function (e) {
    isDown = false;
    if (isHover) {
        //...
    }
}, true);

document.addEventListener('mousemove', function (e) {
    if (isDown) {
        moveTo(e);
    }
});

spliter.addEventListener('mouseenter', function (e) {
    isHover = true;
    spliter.style.cursor = 'col-resize';
});

spliter.addEventListener('mouseout', function (e) {
    isHover = false;
});

