const bulkArea = document.getElementById('bulkArea')
const inputs = document.querySelectorAll('.field')
const name = document.getElementById('name')
const address = document.getElementById('address')
const number = document.getElementById('number')
const niche = document.getElementById('niche')
const notes = document.getElementById('notes')
const website = document.getElementById('website')
const nameErrorField = document.getElementById('nameErrorField')
const numberErrorField = document.getElementById('numberErrorField')
const addressErrorField = document.getElementById('addressErrorField')
const nicheErrorField = document.getElementById('nicheErrorField')
const notesErrorField = document.getElementById('notesErrorField')

let errors = {
    name: '',
    address: '',
    number: '',
    niche: '',
    notes: '',
    website:''
}

const addBusiness = () => {
    // validate input values
    console.log(validateFields());
    if(validateFields()) {
        // preparing business details: name,address,number,niche,website
        let businessInfo = `${name.value}|,|${address.value}|,|${number.value}|,|${niche.value}|,|${website.value}|,|${notes.value}|#|`
        if(bulkArea) {
            bulkArea.innerHTML += businessInfo
            // emptying all inputs except niche 
            inputs.forEach(input => {
                if(input.id != 'niche'){
                    input.value = ''
                }
            })
        } 
    }
}

const validateFields = () => {
    let pass = true

    if(name.value.length === 0) {
        nameErrorField.innerHTML = 'The "name" field is required.'
        pass = false
    }else{
        nameErrorField.innerHTML = ''
    }

    if(address.value.length === 0) {
        addressErrorField.innerHTML = 'The "address" field is required.'
        pass = false
    }else{
        addressErrorField.innerHTML = ''
    }

    if(number.value.length === 0) {
        numberErrorField.innerHTML = 'The "number" field is required.'
        pass = false 
    }else{
        numberErrorField.innerHTML = ''
    }

    if(niche.value.length === 0) {
        nicheErrorField.innerHTML = 'The "niche" field is required.'
        pass = false 
    }else{
        numberErrorField.innerHTML = ''
    }

    return pass;
}