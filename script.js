



//zle som to zamyslel
//dam tam username

//spravit to univerzalne? asi ne
//pre signup
function registraionformular(){

    window.onload = function() {
            // var honeypot = document.createElement('input');
            // honeypot.type = 'text';
            // honeypot.name = 'forename';
            // honeypot.className= 'text';
            // // honeypot.style.display = 'none';
            // document.getElementById('myForm').appendChild(honeypot);

            const userinput = document.createElement('input');
            userinput.className = 'text';
            userinput.type = 'text';
            userinput.name = 'username';
            userinput.maxLength = 25;

            const userlabel = document.getElementById('username');

        // Pridať <input> element pod <label> element
        if (userlabel) {
            userlabel.parentNode.insertBefore(userinput, userlabel.nextSibling);
        }

        const userpassword = document.createElement('input');
        userpassword.className = 'text';
        userpassword.type = 'text';
        userpassword.name = 'password';
        userpassword.maxLength = 40;

        const passwordlabel = document.getElementById('password');

        // Pridať <input> element pod <label> element
        if (passwordlabel) {
            passwordlabel.parentNode.insertBefore(userpassword, passwordlabel.nextSibling);
        }else{
            console.log("passwordlabel nexistuj")
        }


    }
}