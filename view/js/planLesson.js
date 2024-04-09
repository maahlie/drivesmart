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

function filterLessons(img) {
    img.parentNode.removeChild(img);
    changeDatepicker();
}

function sure() {
    return confirm("Les annuleren?");
}