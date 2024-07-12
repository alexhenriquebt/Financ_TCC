const elementsText = document.querySelectorAll('.card .card-text')
const elementsTitle = document.querySelectorAll('.card h5')
const LIMITtext = 150
const LIMITtitle = 25

for(let cardText of elementsText) {
    const acimaLimitText = cardText.innerHTML.length > LIMITtext
    const trueOrFalseText = acimaLimitText ? '...' : ''
    cardText.innerHTML = cardText.innerHTML.substring(0, LIMITtext) + trueOrFalseText
}

for(let cardTitle of elementsTitle) {
    const acimaLimitTitle = cardTitle.innerHTML.length > LIMITtitle
    const trueOrFalseTitle = acimaLimitTitle ? '...' : ''
    cardTitle.innerHTML = cardTitle.innerHTML.substring(0, LIMITtitle) + trueOrFalseTitle

}