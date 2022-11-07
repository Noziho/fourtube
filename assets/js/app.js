import '../css/style.css';
const video = document.querySelectorAll('.video_container');

for (let i = 0; i < video.length; i++) {
    video[i].addEventListener('mouseover', ()=> {
        video[i].style.transform = "scale(1.2)";
        video[i].style.zIndex = "90";
        video[i-1].style.zIndex = "10";
        video[i+1].style.zIndex = "10";
    })

    video[i].addEventListener('mouseleave', ()=> {
        video[i].style.transform = "scale(1)";
        video[i-1].style.zIndex = "10";
        video[i+1].style.zIndex = "10";

    })
}