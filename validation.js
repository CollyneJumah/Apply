var course=document.forms['apply']['course'];
var surname=document.forms['apply']['surname'];
var otherName=document.forms['apply']['otherName'];
var identity=document.forms['apply']['identity'];
var birth=document.forms['apply']['birth'];
var phone=document.forms['apply']['phone'];
var email=document.forms['apply']['email'];
var gender=document.forms['apply']['gender'];
var address=document.forms['apply']['address'];
var county=document.forms['apply']['county'];

var primary=document.forms['apply']['pri_school'];
var dateTo_pri_school=document.forms['apply']['dateTo_pri_school'];
var marks=document.forms['apply']['marks'];
var indexPri=document.forms['apply']['priIndex'];
var secondary=document.forms['apply']['sec_school'];
var dateTo_sec_school=document.forms['apply']['dateTo_sec_school'];
var grade=document.forms['apply']['grade'];
var indexSec=document.forms['apply']['secIndex'];

var studyMode=document.forms['apply']['studyMode'];
var feeSource=document.forms['apply']['feeSource'];

//get errors
var surnameErr=document.getElementById('surnameErr');
var otherNameErr=document.getElementById('otherNameErr');
var identityErr=document.getElementById('identityErr');
var birthErr=document.getElementById('birthErr');
var phoneErr=document.getElementById('phoneErr');
var emailErr=document.getElementById('emailErr');
var genderErr=document.getElementById('genderErr');
var addressErr=document.getElementById('addressErr');
var countyErr=document.getElementById('countyErr');

var priSchoolErr=document.getElementById('pri_schoolErr');
var dateToPriErr=document.getElementById('dateTo_pri_schoolErr');
var priIndexErr=document.getElementById('priIndexErr');
var marksErr=document.getElementById('marksErr');
var sec_schoolErr=document.getElementById('sec_schoolErr');
var secYearErr=document.getElementById('secYearErr');
var secIndexErr=document.getElementById('secIndexErr');
var gradeErr=document.getElementById('gradeErr');

var studyModeErr=document.getElementById('studyModeErr');
var feeSourceErr=document.getElementById('feeSourceErr');


//setting the eventListerner
surname.addEventListener("blur",surnameVerify,true);
otherName.addEventListener("blur",othernameVerify,true);
identity.addEventListener("blur",identityVerify,true);
birth.addEventListener("blur",birthVerify,true);
phone.addEventListener("blur",phoneVerify,true);
email.addEventListener('blur',emailVerify,true);
address.addEventListener('blur',addressVerify,true);
county.addEventListener('blur',countyVerify,true);

primary.addEventListener('blur',primaryVerify,true);
dateTo_pri_school.addEventListener('blur',dateTo_pri_schoolVerify,true);
indexPri.addEventListener('blur',indexPriVerify,true);
marks.addEventListener('blur',marksVerify,true);
secondary.addEventListener('blur',secondaryVerify,true);
dateTo_sec_school.addEventListener('blur',dateTo_sec_schoolVerify,true);
indexSec.addEventListener('blur',indexSecVerify,true);
grade.addEventListener('blur',gradeVerify,true);

studyMode.addEventListener('blur',studyModeVerify,true);
feeSource.addEventListener('blur',feeSourceVerify,true);


//validation
function validation() {
    if(surname.value==""){
        surname.style.border="1px solid red";
        surnameErr.textContent="Your surname is required!";
        surnameErr.style.color='red';
        surname.focus();
        return false;
    }
    if(otherName.value==""){
        otherName.style.border="1px solid red";
        otherNameErr.textContent="your other name is required!";
        otherNameErr.style.color='red';
       otherName.focus();
        return false;
    }

    if(identity.value==""){
        identity.style.border="1px solid red";
        identityErr.textContent="We need to capture your identity.Please provide us with one.";
        identityErr.style.color='red';
        identity.focus();
        return false;
    }
    if(birth.value==""){
        birth.style.border="1px solid red";
        birthErr.textContent="Please fill in your date of birth!";
        birthErr.style.color='red';
        birth.focus();
        return false;
    }
    if (phone.value.length != 13) {
        phoneErr.textContent="Please enter a valid phone number.Must be 13 digit length, beginning with +2547..";
        phoneErr.style.color='red';
        return false
    }

    if(email.value==""){
        email.style.border="1px solid red";
        emailErr.textContent="Email field is required!";
        emailErr.style.color='red';
        email.focus();
        return false;
    }
    if(address.value==''){
        address.style.border="1px solid red";
        addressErr.textContent="Your address field is required!";
        addressErr.style.color='red';
        address.focus();
        return false;
    }
    if(county.selectedIndex<1){
        county.style.border="1px solid red";
        countyErr.textContent="Please select your county!";
        countyErr.style.color='red';
        county.focus();
        return false;
    }
    if(primary.value==''){
        primary.style.border="1px solid red";
        prim.textContent="Your address field is required!";
        addressErr.style.color='red';
        address.focus();
        return false;
    }



}
//function event
function surnameVerify() {
    if(username.value !=''){
        surname.style.border="1px solid #5E6E66";
        surnameErr.innerHTML='';
        return true;
    }
}

function regVerify() {
    if(regNumber.value !=''){
        regNumber.style.border="1px solid #5E6E66";
        regNumberErr.innerHTML='';
        return true;
    }
}

function phoneVerify() {
    if(phone.value !=''){
        phone.style.border="1px solid #5E6E66";
        phoneErr.innerHTML='';
        return true;
    }
}
function passwordVerify() {
    if(password.value !=''){
        password.style.border="1px solid #5E6E66";
        passErr.innerHTML='';
        return true;
    }
}
function confirm_passVerify() {
    if (confirm_pass.value != '') {
        confirm_pass.style.border = "1px solid #5E6E66";
        confirm_passErr.innerHTML = '';
        return true;
    }
}

//show pass
function showing() {
    var show=document.getElementById('password');
    if(show.type==='password'){
        show.type='text';
    }else{
        show.type='password';
    }

}
function set() {
    document.getElementById('phone').value='+2547';
}