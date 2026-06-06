function iniciarCarrusel(trackId, prevBtnId, nextBtnId) {

    const track = document.getElementById(trackId);
    const prevBtn = document.getElementById(prevBtnId);
    const nextBtn = document.getElementById(nextBtnId);

    if (!track || !prevBtn || !nextBtn) return;

    nextBtn.addEventListener("click", () => {
        track.scrollBy({
            left: 250,
            behavior: "smooth"
        });
    });

    prevBtn.addEventListener("click", () => {
        track.scrollBy({
            left: -250,
            behavior: "smooth"
        });
    });

}

// Libros
iniciarCarrusel(
    "carouselTrackLibros",
    "prevBtnLibros",
    "nextBtnLibros"
);

// Mangas
iniciarCarrusel(
    "carouselTrackMangas",
    "prevBtnMangas",
    "nextBtnMangas"
);

// Comics
iniciarCarrusel(
    "carouselTrackComics",
    "prevBtnComics",
    "nextBtnComics"
);