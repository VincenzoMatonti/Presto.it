function makeInterval(ElementHTML, maxNumber, timer) {
    let counter = 0;
    let id_interval = setInterval( () => {
        if (counter < maxNumber) {
            counter ++;
            ElementHTML.innerHTML = counter;

        } else {
            clearInterval(id_interval);
        }
    }, timer );

}

let checkRipetition = 'true';

let observe = new IntersectionObserver ( entries => {
 entries.forEach(entrie => {
    if (entrie.isIntersecting && checkRipetition == 'true' ) {
        makeInterval(number1, 112,200);
        makeInterval(number2, 221, 100);
        makeInterval(number3, 174, 100);
        checkRipetition = 'false';
    }
 });
}

);

observe.observe(number3);