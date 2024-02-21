const accordions = document.querySelectorAll('.accordion')
let isAnyOpen = false

// events
accordions.forEach(accordion => {
    let trigger = accordion.querySelector('.accordion-trigger')
    let panel = accordion.querySelector('.accordion-detail')

    trigger.addEventListener('click', () => toggleAccordion(panel))
});

// functions
const openAccordion = (panel) => {
    panel.style.maxHeight = panel.scrollHeight + "px";
    flipArrow(panel)
}

const closeAccordion = (panel) => {
    panel.style.maxHeight = null;
    flipArrow(panel)
}

const closeAllAccordions = (panel) => {
    let otherPanels = document.querySelectorAll('.accordion-detail')
    otherPanels.forEach(otherPanel => {
        if (otherPanel !== panel && otherPanel.style.maxHeight) closeAccordion(otherPanel)
    });
}

const toggleAccordion = (panel) => {
    if (isPanelOpen(panel)) {
        closeAccordion(panel)
    } 
    
    else {
        openAccordion(panel)
        closeAllAccordions(panel)
    }
}

const isPanelOpen = (panel) => {
    if (panel.style.maxHeight) {
        return true
    } 
    return false
}

const flipArrow = (panel) => {
    // get arrow
    let previousSibling = getPreviousSibling(panel, 'accordion-trigger')
    console.log(previousSibling);
    if (previousSibling) {
        let arrow = previousSibling.querySelector('.trigger-arrow')
        if (isPanelOpen(panel)) {
            arrow.style.transform = 'rotate(-180deg)'
        } else {
            console.log(798);
            arrow.style.transform = 'rotate(0deg)'
        }
    }
}

const getPreviousSibling = (element, className) => {
    var sibling = element.previousSibling;
    while (sibling) {
        // Skip over text nodes and comments
        if (sibling.nodeType === Node.ELEMENT_NODE) {
            // Check if the sibling has the required class
            if (sibling.classList.contains(className)) {
                return sibling;
            }
        }
        // Move to the next sibling
        sibling = sibling.previousSibling;
    }
    return null; // No previous sibling with the specified class was found
}