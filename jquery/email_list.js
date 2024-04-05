// Slide 25 - 27
$(document).ready(() => {

    // handle click on 'Join List' button
    $("#email_form").submit(event => {
        const email = $("#email").val();
        let isValid = true;

        // validate the email address
        if (email === "") {
            $("#email").next().text("This field is required.");
            isValid = false;
        } else {
            $("#email").next().text("");
        }

        // submit the form if all entries are valid
        if (isValid) {
            $("#email_form").submit();
        } else {
            event.preventDefault();
        }
    });

    // handle click on Reset form button
    $("#reset_button").click(() => {
        // clear all text boxes
        $("#email").val("");
        // reset span elements
        $("#email").next().text("*");
        $("#email").focus();
    });

    $("#email").focus();
});