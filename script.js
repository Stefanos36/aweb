
function registraionformular(){

    window.onload = function() {
        var honeypot = document.createElement('input');
        honeypot.type = 'text';
        honeypot.name = 'lastname';
        honeypot.className= 'text';
        // honeypot.style.display = 'none';
        document.getElementById('myForm').appendChild(honeypot);
        }
}