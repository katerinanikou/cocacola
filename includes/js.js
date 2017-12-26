window.addEventListener("load", function () {

 
    var b = 0;
    var n = 1;
    
    var slider = document.querySelector('.startpage_slider .sliderPic');
    var button = document.querySelectorAll(".buttons");
    var arrows = document.querySelectorAll(".arrows span");
    
    document.addEventListener("keyup", arrowHandler);
    for (var i=0; i<arrows.length; i++) {
        arrows[i].addEventListener("click", clickArrow);
    }
    
    
    
    // Ändra setInterval till en funktion som återställer timern varje gång den
    // 'ropas på'!!!!!
    // Då löser vi problemet med att bilden hoppar förbi en bild!
    setInterval(changePic, 4000);
    
    function changePic() {
        button[b].classList.toggle("buttonActive");
        if (n == 4) {
            n = 1;
        }
        if(b == 3) {
            b = 0;
        }
        else {
            n++;
            b++;
        }
        button[b].classList.toggle("buttonActive");
        slider.src="img/slider/slider"+n+".jpg";
    }
    
    function arrowHandler(e) {
        if(e.keyCode == 37) {
            if(n <= 1) {
                n = 4;
                console.log(n);
                slider.src="img/slider/slider"+n+".jpg";
            }
            if(b <= 0) {
                button[b].classList.toggle("buttonActive");
                b = 3;
                button[b].classList.toggle("buttonActive");
            }
            else {
                button[b].classList.toggle("buttonActive");
                n--;
                b--;
                button[b].classList.toggle("buttonActive");
                slider.src="img/slider/slider"+n+".jpg"; 
            } 
                
        }
        if(e.keyCode == 39) {
            if(n >= 4) {
                n = 1;
                slider.src="img/slider/slider"+n+".jpg";
            }
            if(b >= 3) {
                button[b].classList.toggle("buttonActive");
                b = 0;
                button[b].classList.toggle("buttonActive");
            }
            else {
                button[b].classList.toggle("buttonActive");
                b++;
                n++;
                button[b].classList.toggle("buttonActive");
                slider.src="img/slider/slider"+n+".jpg"; 
            } 
                
        }
    }
    
    function clickArrow(e) {
        if(e.target == arrows[0]) {
            if(n <= 1) {
                n = 4;
                console.log(n);
                slider.src="img/slider/slider"+n+".jpg";
            }
            if(b <= 0) {
                button[b].classList.toggle("buttonActive");
                b = 3;
                button[b].classList.toggle("buttonActive");
            }
            else {
                button[b].classList.toggle("buttonActive");
                n--;
                b--;
                button[b].classList.toggle("buttonActive");
                slider.src="img/slider/slider"+n+".jpg"; 
            }
        }
        if(e.target == arrows[1]) {
            if(n >= 4) {
                n = 1;
                slider.src="img/slider/slider"+n+".jpg";
            }
            if(b >= 3) {
                button[b].classList.toggle("buttonActive");
                b = 0;
                button[b].classList.toggle("buttonActive");
            }
            else {
                button[b].classList.toggle("buttonActive");
                b++;
                n++;
                button[b].classList.toggle("buttonActive");
                slider.src="img/slider/slider"+n+".jpg"; 
            }
        }
    }
    
    var elems = document.getElementsByClassName("foobar");
    console.log(elems);
    //Lägga en lysnare till varje knapp / knappen i varje rad.
    for(var i = 0; i < elems.length; i++) {
        elems[i].addEventListener("click", changeColor);
    }
    function changeColor(e) {
        console.log(e);

        e.target.style.backgroundColor = "#25BA2F";
        e.target.innerHTML = "UPPDATERAT!";
    }
    
});
