



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

        //password
        const userpassword = document.createElement('input');
        userpassword.className = 'text';
        userpassword.type = 'password';
        userpassword.name = 'password';
        userpassword.maxLength = 40;

        const passwordlabel = document.getElementById('password');

        // Pridať <input> element pod <label> element
        if (passwordlabel) {
            passwordlabel.parentNode.insertBefore(userpassword, passwordlabel.nextSibling);
        }else{
            console.log("passwordlabel nexistuj")
        }

        //repeat password, password

        const userpassword2 = document.createElement('input');
        userpassword2.className = 'text';
        userpassword2.type = 'password';
        userpassword2.name = 'password2';
        userpassword2.maxLength = 40;

        const passwordlabel2 = document.getElementById('password2');

        // Pridať <input> element pod <label> element
        if (passwordlabel2) {
            passwordlabel2.parentNode.insertBefore(userpassword2, passwordlabel2.nextSibling);
        }else{
            console.log("passwordlabel nexistuj")
        }
    }
}