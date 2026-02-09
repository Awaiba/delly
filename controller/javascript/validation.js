function validation() {
    var name = document.forms["form"]["name"].value;
    var nameformat = /^[a-zA-Z\s]*$/;
    if (name.trim() == "") {

        return false;
    } else if (!nameformat.test(name)) {

        return false;
    }
    var uname = document.forms["form"]["username"].value;
    if (uname.trim() == "") {

        return false;
    }
    var pass = document.forms["form"]["password"].value;
    if (pass.trim() == "") {

        return false;
    }
    var cpass = document.forms["form"]["confirmpassword"].value;
    if (cpass != pass) {

        return false;
    }
    var email = document.forms["form"]["email"].value;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (email.trim() == "") {

        return false;
    } else if (!mailformat.test(email)) {

        return false;
    }
    var phone = document.forms["form"]["phone"].value;
    var phoneformat = /^([8-9]{2})*([0-9]{8})*$/;
    if (phone.trim() == "") {

        return false;
    } else if (!phoneformat.test(phone)) {

        return false;

    }
    var address = document.forms["form"]["address"].value;
    if (address.trim() == "") {

        return false;
    }
}