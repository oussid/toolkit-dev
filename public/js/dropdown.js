const toggleDropdown = (dropdownId) => {
    let dropdown = document.getElementById(dropdownId)
    
    if(dropdown) { 
        // toggle dropdown
        dropdown.classList.toggle('visible')
        // keep dropdown visible when hovering over it
        dropdown.addEventListener('mouseover', ()=>{
            dropdown.classList.add('visible')
        }) 
        // hide dropdown on hover out (if it supports it)
        if(!dropdown.classList.contains('visibleOnHoverOut')) {
            dropdown.addEventListener('mouseout', ()=>{
                dropdown.classList.remove('visible')
            })
        }
    }
}

const showDropdown = (dropdownId) => {
    let dropdown = document.getElementById(dropdownId)
    
    if(dropdown) {
        // show dropdown
        dropdown.classList.add('visible')
        // keep dropdown visible when hovering over it
        dropdown.addEventListener('mouseover', ()=>{
            dropdown.classList.add('visible')
        }) 
        // hide dropdown on hover out (if it supports it)
        if(!dropdown.classList.contains('visibleOnHoverOut')) {
            dropdown.addEventListener('mouseout', ()=>{
                dropdown.classList.remove('visible')
            })
        }
    }
}

const hideDropdown = (dropdownId) => {
    let dropdown = document.querySelector('#'+dropdownId)
    
    if(dropdown) {
        // keep dropdown visible when hovering over it
        dropdown.addEventListener('mouseover', ()=>{
            dropdown.classList.add('visible')
        }) 
        dropdown.classList.remove('visible')
    }
}

// CLOSE ALL DROPDWONS ON OUTSIDE CLICK
document.addEventListener('click', (event) => {
    const visibleDropdowns = document.querySelectorAll('.dropdown.visible')
    const dropdownBtns =  document.querySelectorAll('.dropdownBtn')
    let isDropdownBtn = false

    // checking that the clicked element is not a button that opens a dropdown
    dropdownBtns.forEach(btn => {
        if(btn.contains(event.target) ){
            isDropdownBtn = true
        }
    });
    
    visibleDropdowns.forEach(dropdown => {
        if(!dropdown.contains(event.target) && !isDropdownBtn ){
            dropdown.classList.remove('visible')
        }
    });
})