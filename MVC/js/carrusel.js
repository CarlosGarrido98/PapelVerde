const track = document.getElementById("carouselTrack");

document.getElementById("nextBtn").addEventListener("click", () => {

    track.scrollBy({
        left: 250,
        behavior: "smooth"
    });

});

document.getElementById("prevBtn").addEventListener("click", () => {

    track.scrollBy({
        left: -250,
        behavior: "smooth"
    });

});