
var timesClicked = 0;

$("#shop_link").click(function() {
    timesClicked++;

    if (timesClicked>1) {
    window.location='anp.test/shop';
    } else {
    window.location='anp.test/instructions';
    }
})

document.getElementById("#shop_link").innerHTML = afefa;
