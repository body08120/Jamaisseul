const slideContainer = document.querySelector('.head-slider')
const img = slideContainer.querySelector('img')
const images = ['02.jpg','03.jpg','05.jpg','15.jpg']
const imagesCount = images.length 

let currentSlide = 0

function Slide(delay) {
    setInterval(()=> {
        img.style.opacity = "0"
        setTimeout(() => {
            img.style.opacity = "0.5"
            nextSlide()
        },1000)
    }, delay)
}

function nextSlide() {
    currentSlide = currentSlide++ >= imagesCount - 1 ? 0 : currentSlide++
    img.src = `img/${images[currentSlide]}`
}

Slide(4000)