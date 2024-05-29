
//mam tu generovanie html elementov skrz js, pretoze niektori boti nevedia citat js
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


//pridam login formular


function loginformular(){
    window.onload = function() {
        console.log("loginformular");

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




    }


    const userpassword = document.createElement('input');
    userpassword.className = 'text';
    userpassword.type = 'password';
    userpassword.name = 'password';
    userpassword.maxLength = 40;

    const passwordlabel = document.getElementById('password');

    // Pridať <input> element pod <label> element
    if (passwordlabel) {
        passwordlabel.parentNode.insertBefore(userpassword, passwordlabel.nextSibling);
    }
}


function commentelement(){
    window.onload = function() {
        // userpassword
        const commetninput = document.createElement('textarea');
        commetninput.className = 'textarea';
        //userpassword.type = 'password';
        commetninput.name = 'comment';
        commetninput.maxLength = 200;
        commetninput.rows=3;
        commetninput.style="width:100%";

        const commentlabel = document.getElementById('comment');

        // Pridať <input> element pod <label> element
        if (commentlabel) {
            // document.createElement("br");
            commentlabel.parentNode.insertBefore(commetninput, commentlabel.nextSibling);
            commentlabel.parentNode.insertBefore(document.createElement("br"), commentlabel.nextSibling);
            
        }

    }
}


