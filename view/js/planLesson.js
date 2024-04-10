//change which open lessons are shown based on what date is picked
function changeDatepicker() {
    let lessons = document.getElementsByName('block');
    let currentDay = document.getElementById("date").value;

    for(let lesson of lessons){
        if(lesson.id != currentDay){
            lesson.style.display = "none";
        }else{
            lesson.style.display = "block";
        }
    }
}

//same as above, this function is executed when a dummy element is loaded
//due to templating a body onload was not possible, therefore hacky solution
function filterLessons(img) {
    img.parentNode.removeChild(img);
    changeDatepicker();
}

//confirmation box when deleting and changing lesson.
function sure() {
    return confirm("Weet u het zeker?");
}