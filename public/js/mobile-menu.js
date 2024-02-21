import { isClickOutside, isNodeElement } from "./helpers.js"

const menu = document.querySelector('.header-mobile')
const hamburger = document.querySelector('#mobile-trigger')
let isOpen = false

// events
document.addEventListener('click', (event) => {
    if (isNodeElement(menu) && isNodeElement(hamburger)) {
        if (hamburger.contains(event.target)) {
            toggleMenu(menu, isOpen)
        }
        else if (isClickOutside([menu], event)){
            console.log(15);
            closeMenu(menu)
        }
    }
})


// function
const switchBurger = (hamburger, isOpen) => {
    if(isOpen) {
        hamburger.querySelector('.lines-container')?.classList.add('open')
    } else {
        hamburger.querySelector('.lines-container')?.classList.remove('open')
    }
}

const toggleMenu = (menu, isOpen) => {
    if (isOpen) {
        return closeMenu(menu)
    }else {
        return openMenu(menu)
    }
}

const openMenu = (menu) => {
    menu.classList.add('open')
    isOpen = true
    switchBurger(hamburger, isOpen)
}

const closeMenu = (menu) => {
    menu.classList.remove('open')
    isOpen = false
    switchBurger(hamburger, isOpen)
}
