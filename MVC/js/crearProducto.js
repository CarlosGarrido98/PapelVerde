

const selector = document.getElementById('tipoProducto');

const libro = document.getElementById('camposLibro');
const comic = document.getElementById('camposComic');
const manga = document.getElementById('camposManga');

selector.addEventListener('change', () => {

    libro.style.display = 'none';
    comic.style.display = 'none';
    manga.style.display = 'none';

    if(selector.value === 'libro'){
        libro.style.display = 'block';
    }

    if(selector.value === 'comic'){
        comic.style.display = 'block';
    }

    if(selector.value === 'manga'){
        manga.style.display = 'block';
    }

});
