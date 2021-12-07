var showin = document.querySelector(".visin");

var showup = document.querySelector(".visup");

var message =
    document.querySelector(".message");

changein = () => {
    if (showin.innerText == "visibility_off") {
        showin.innerText = "visibility";
        document.querySelector('.pswrdin').setAttribute("type", "password");
    } else if (showin.innerText == "visibility") {
        showin.innerText = "visibility_off";
        document.querySelector('.pswrdin').setAttribute("type", "text");
    }
}


changeup = () => {
    if (showup.innerText == "visibility_off") {
        showup.innerText = "visibility";
        document.querySelector('.pswrdup').setAttribute("type", "password");
    } else if (showup.innerText == "visibility") {
        showup.innerText = "visibility_off";
        document.querySelector('.pswrdup').setAttribute("type", "text");
    }
}

showsin = () => {
    document.querySelector(".signinc").style.display = "flex";
    document.querySelector(".signini").style.display = "flex";
    document.querySelector(".signupc").style.display = "none";
    document.querySelector(".signupi").style.display = "none";
};
showsup = () => {
    document.querySelector(".signinc").style.display = "none";
    document.querySelector(".signini").style.display = "none";
    document.querySelector(".signupc").style.display = "flex";
    document.querySelector(".signupi").style.display = "flex";
};

reset = () => {
    document.querySelector(".login").style.opacity = "1";
    document.querySelector(".message").style.opacity = "0";
    document.querySelector(".formin").reset();
    document.querySelector(".formup").reset();
};