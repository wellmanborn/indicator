function generatePassword(target){
    if(target == undefined)
        target = $("#use-password").data("target");
    let mul = 1;
    if(target == "client_secret")
        mul = 2;

    let n = [0,1,2,3,4,5,6,7,8,9];
    let Us = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    let Ls = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
    let sym = ['&','*','^','@','!'];

    let passwd = [];

    let randn = getRndInteger(mul,3 * mul);
    let randUs = getRndInteger(mul,3 * mul);
    let randsym = getRndInteger(mul,3 * mul);
    let randLs = getRndInteger(10 * mul,12 * mul) - (randn + randsym + randUs);
    for(let i = 0; i < randn; i++){
        passwd.push(n[getRndInteger(0,9)])
    }
    for(let i = 0; i < randUs; i++){
        passwd.push(Us[getRndInteger(0,25)])
    }
    for(let i = 0; i < randsym; i++){
        passwd.push(sym[getRndInteger(0,4)])
    }
    for(let i = 0; i < randLs; i++){
        passwd.push(Ls[getRndInteger(0,25)])
    }
    let password = shuffleArray(passwd).join('');
    $("#generated-password").val(password);
    $("#use-password").data("target", target);
}
function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1) ) + min;
}
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}
