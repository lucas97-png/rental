function smoothScroll(element) {
    document.querySelector(element).scrollIntoView({
        behavior: 'smooth'
    });
}

window.onscroll = function() {
    scroll();
}

function scroll() {
    if(document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
        document.getElementById('up-button').style.display = "block";
    } else {
        document.getElementById('up-button').style.display = "none";
    }
}

function reserve(car) {
    let select = document.getElementById('car');
    
    let optionsSelected = document.querySelectorAll('option[selected');
    optionsSelected.forEach(function(option) {
        option.removeAttribute("selected");
    })
    
    let option = select.querySelector('option[value="'+car+'"]');
    option.setAttribute('selected','selected');
    smoothScroll('#reservation');
}

function calculate(price){
    let result = document.getElementById('amount');
    result.innerHTML = '';
    let days = document.getElementById('days').value;
    let hours = document.getElementById('hours').value;
    let cost = (days * 24 * price) + (hours * price);
    result.innerHTML = cost;

}
function calculate_price(price){
    document.getElementById('days').addEventListener('change',function(){
        calculate(price)
    })
    document.getElementById('hours').addEventListener('change',function(){
        calculate(price);
    })
}