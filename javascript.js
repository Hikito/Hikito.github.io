//Function to validate form
function validateForm() {
    var name = document.forms["myForm"]["fname"].value;
    var email = document.forms["myForm"]["email"].value;
    var gender = document.forms["myForm"]["gender"].value;
    var honorifics = document.forms["myForm"]["honorifics"].value;
    var jobs = document.forms["myForm"]["jobs"].value;
    var expectation1 = document.forms["myForm"]["expectation1"].checked;
    var expectation2 = document.forms["myForm"]["expectation2"].checked;
    var expectation3 = document.forms["myForm"]["expectation3"].checked;
    var expectation4 = document.forms["myForm"]["expectation4"].checked;

    var checkName = "";
    var checkEmail = "";
    var checkGender = "";
    var checkHonorifics = "";
    var checkJobs = "";
    var checkExpectation = "";
    var boolForm = true;
    var results = "";

    if (name == "") {
        checkName = "You did not enter name";
        boolForm = false;
    }

    if (email == "") {
        checkEmail = "You did not enter email";
        boolForm = false;
    }

    if (gender == "") {
        checkGender = "You did not choose any gender";
        boolForm = false;
    }

    if (honorifics == "") {
        checkHonorifics = "You did not choose any honorifics";
        boolForm = false;
    }

    if (jobs == "") {
        checkJobs = "You did not choose any jobs";
        boolForm = false;
    }

    if (expectation1 == false && expectation2 == false && expectation3 == false && expectation4 == false) {
        checkExpectation = "No boxes ticked";
        boolForm = false;
    }

    results = checkName + "\n" + checkEmail + "\n" + checkGender + "\n" + checkHonorifics + "\n" + checkJobs + "\n" + checkExpectation;
    
    if (boolForm == true) {
        alert("Thank you for your patronage, " + honorifics + " " + name + "!");
        return boolForm;
    } else if (boolForm == false) {
        alert(results);
        return boolForm;
    }
}