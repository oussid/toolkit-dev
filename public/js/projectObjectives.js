const hiddenInput = document.querySelector('#hiddenObjectives')
const objectivesArea = document.querySelector('#objectivesArea')
const objectiveField = document.querySelector('#objectiveField')
let objectives = []

// creates an objective object and adds it to the array of objectives
const addObjective = () => {
    event.preventDefault()
    if (objectiveField) {
        let objective = objectiveField.value
        if(objective.length != 0) {
            objectives = [...objectives, {id: uniqueId(), text:objective}]
            objectiveField.value = ''
            setHiddenInput()
        }
    }
}

// removes the objective from the array 
const removeObjective = (id) => {
    event.preventDefault()
    objectives = objectives.filter(obj => obj.id != id)
    setHiddenInput()
    console.log(objectives);
}

// sets the value of the hidden input
const setHiddenInput = () => {
    console.log(objectives);
    let content = ''
    objectives.forEach(obj => {
        content += obj.text + '|#|'
    })
    hiddenInput.value = content
    checkObjectivesLength()
    updateObjectivesArea()
}

// checks the length of the objectives array adds/removes the 'center' class from the objectives area
const checkObjectivesLength = () => {
    if(objectives.length == 0) {
        objectivesArea.classList.add('center')
    }else{
        objectivesArea.classList.remove('center')
    }
}

// update objectives area (html) function. called after adding or removing an item
const updateObjectivesArea = () => {
    const createDashedAreaItem= (obj) => {
        let areaWidth = objectivesArea.offsetWidth
        let opening = `<div class="dashed-area-item" style="max-width: calc(${areaWidth}px - 1rem);"><span class="hashtag">#</span>`
        let closing = `<button class="dashed-area-delete-btn" onclick="removeObjective('${obj.id}')"><i class="fa-solid fa-trash"></i></button></div>`
        return opening + obj.text + closing
    }

    let htmlContent = ''

    objectives.forEach(obj => {
        htmlContent += createDashedAreaItem(obj)
    })

    objectivesArea.innerHTML = htmlContent
    checkObjectivesLength()
}

// generates a unique string
function uniqueId() {
    return Math.random().toString(36).substring(2) + (new Date()).getTime().toString(36);
}

// initialize
if( hiddenInput.value.length != 0 ) {
    let items = hiddenInput.value.split('|#|').filter(item => item != '')
    items.forEach(item => {
        objectives = [...objectives, {id: uniqueId(), text:item}]
    });
    updateObjectivesArea()
}
