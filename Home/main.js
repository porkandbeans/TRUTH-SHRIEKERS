function getScreenSize(){
    var disp = document.getElementById("pgcont");
    var head = document.getElementById("pghed");

    console.log("Screen resized");
    if(window.innerWidth < 1000){
        disp.style.width = "750px";
        head.style.width = "1000px";
    }else{
        disp.style.width = "75%";
        head.style.width = "100%";
    }
}

//I feel like I shouldn't have to grab the element every time the window is resized,
//but it doesn't know wtf the variable is if I don't... it has to do with the page being
//loaded in chunks, and it can't grab the variable before it's loaded.