console.log('ascasc');
let file = document.getElementById('upload');
let button = document.getElementsByTagName('button');
let progress = document.querySelector('progress');
let p_i = document.querySelector('.progress-indicator');
let load  = 0;
let process = '';


file.oninput = ()=> {
    let filename = file.files[0].name;
    let extention = filename.split('.').pop();
    let filesize = file.files[0].size;

    if (filesize <= 1000000) {
        filesize = (filesize/1000).toFixed(2) + 'kb';
    }

    if (filesize == 1000000 || filesize <= 1000000000) {
        filesize = (filesize/1000000).toFixed(2) + 'mb';
    }

    if (filesize == 1000000000 || filesize <= 1000000000000) {
        filesize = (filesize/1000000000).toFixed(2) + 'gb';
    }
    document.querySelector('lable').innerHTML = filename;
    document.querySelector('.ex').innerHTML = extention;
    document.querySelector('.size').innerHTML = filesize;
    console.log('sddw');
}
