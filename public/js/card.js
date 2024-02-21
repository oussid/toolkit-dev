toastr.options.progressBar = true;
toastr.options.timeOut = 1200;

const copyToClipboard = (text) => {
    if(text) {
        navigator.clipboard.writeText(text);
        toastr.success('Text coppied to clipboard.')
    }
}

const openUrl = (url) => {
    window.open(url, "_blank");
}

// RESPONSIVENESS
const cards = document.querySelectorAll('.card')
let screenWidth = window.screen.width;
const resizeCards = (cards, screenWidth) => {
    if (screenWidth<=600){
        cards.forEach(card => {
            card.style.width = `calc(${screenWidth}px - 2rem)`;
            console.log(card.style.width);
        });
    }
}

resizeCards(cards, screenWidth)

window.addEventListener('resize', function() {
    console.log('yep');
    resizeCards(cards, screenWidth)
});

