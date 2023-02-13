
let tel = document.querySelector('#tel')
let reg = /[^a-az-я0-9_]/gi;
tel.oninput = function () {
    this.value = this.value.replace(reg, '');
}
/*let tel = document.querySelector('#tel')
var regex = /[^a-аz-я0-9_]/gi;
function lettersOrNumbersOnly() {
    tel.value = input.value.replace(regex, "");
}*/
function lettersOnly(input) {
    var regex = /[^a-аz-я]/gi;
    input.value = input.value.replace(regex, "");
}