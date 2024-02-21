
const showModal = (modalId) => {
    let modal = document.getElementById(modalId)
    
    if(modal) {
        let modalBox = modal.querySelector('.modal-box')
        // stop the event from bubbling up to the container
        modalBox.addEventListener('click', () => {
            event.stopPropagation()
        })
        // show modal
        modal.classList.add('visible')
        // hide modal on outside click
        modal.addEventListener('click', ()=>{
            hideModal(modalId)
        }) 
    }
}

const hideModal = (modalId) => {
    event.preventDefault()
    let modal = document.getElementById(modalId)
    
    if(modal) {
        modal.classList.remove('visible') 
    }
}

window.addEventListener('call-show-modal', function (event) {
    showModal(event.detail.modalId); 
});

window.addEventListener('call-hide-modal', function (event) {
    hideModal(event.detail.modalId); 
});