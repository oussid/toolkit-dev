export const isNodeElement = (element) => {
    if(element && element.nodeType  === Node.ELEMENT_NODE) {
        return true
    }
    console.log(element + ' type is not Node.ELEMENT_NODE');
    return false
}

export const isClickOutside = (elements, event) => {
    console.log(555);
    return elements.every(element => !element.contains(event.target));
}

