$(document).ready(() => {

    // move focus to first text box
    $("#email").focus();

    $(":radio").change(() => {
        const radioButton = $(":radio:checked").val();

        if (radioButton == "corporate") {
            $("#company_name").prop("disabled", false);
            $("#company_name").next().text("*");
        } else {
            // radioButton is individual
            $("#company_name").prop("disabled", true);
            $("#company_name").next().text("");
        }
    });

    $("#member_form").submit((event) => {
        let isValid = true;

        // validate the emaail entry with regular expressions
        const emailPattern =
            /\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b/;
        const email = $("#email").val();

        if (email == "") {
            $("#email").next().text("This field is required.");
            isValid = false;
        } else if (!emailPattern.test(email)) {
            $("#email").next().text("Must be a valid email address.");
            isValid = false;
        } else {
            // accepted email address
            $("#email").next().text("");
        }

        // Slide 30 - 31
        // password field validation
        const password = $("#password").val();
        if (password.length < 6) {
            $("#password").next().text("Must be 6 or more characters.");
            isValid = false;
        } else {
            $("#password").next().text("");
        }

        if ($("#company_name").prop("disabled") == false) {
            // then validate company name

            // if company name is empty, display an error
            // and set isValid flag
            // otherwise clear error
        }



        // prevent submittions if any entries are invalid
        if (isValid == false) {
            event.preventDefault();
        }

    });

});// JavaScript source code
