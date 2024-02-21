const isContactedField = document.querySelector('#isContacted')
const contactedBySection = document.querySelector('#contactedBy')
const contactedByField = document.querySelector('#contactedByField')

// check if is_contacted is set to true when page is first loaded
if(isContactedField.value == 1 && contactedBySection) {
    contactedBySection.classList.remove('hidden')
} else {
    contactedBySection.classList.add('hidden')
    contactedByField.value = ''
}

// checking on select field change
isContactedField.addEventListener('change', () => {
    if(isContactedField.value == 1 && contactedBySection) {
        contactedBySection.classList.remove('hidden')
    } else {
        contactedBySection.classList.add('hidden')
        contactedByField.value = ''
    }
})
