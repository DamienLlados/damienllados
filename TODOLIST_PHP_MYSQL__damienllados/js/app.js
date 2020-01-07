const divtag = document.createElement('div');
divtag.style = 'backgroud: red; height: 50px; width:50px';
const bttag = document.querySelector('button');
bttag.onclick = document.body.appendChild(divtag);