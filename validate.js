function validate() {
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
    var marital=document.forms['apply']['marital'];
    var primary=document.forms['apply']['pri_school'];
    var dateFrom_pri_school=document.forms['apply']['dateFrom_pri_school'];
    var dateTo_pri_school=document.forms['apply']['dateTo_pri_school'];
    var marks=document.forms['apply']['marks'];
    var secondary=document.forms['apply']['sec_school'];
    var dateFrom_sec_school=document.forms['apply']['dateFrom_sec_school'];
    var dateTo_sec_school=document.forms['apply']['dateTo_sec_school'];
    var grade=document.forms['apply']['grade'];
    var studyMode=document.forms['apply']['studyMode'];
    var feeSource=document.forms['apply']['feeSource'];
    

    if(course.selectedIndex <1) {
        window.alert('Please select your course!');
        course.focus();
        document.getElementById('course').style.borderColor = 'red';
        return false;
    }
    else {
        document.getElementById('course').style.borderColor = "green";
    }
    if(surname.value == '') {
        window.alert("Please Enter your last name");
        document.getElementById('surname').style.borderColor = 'red';
        surname.focus();
        return false;
    }
    else {
        document.getElementById('surname').style.borderColor = "green";
    }
    if(otherName.value==''){
        window.alert("THis field is required!");
        document.getElementById('otherName').style.borderColor = 'red';
        otherName.focus();
        return false;
    }
    else {
        document.getElementById('otherName').style.borderColor = "green";
    }
    if(identity.value==''){
        window.alert("YOur identity is required!");
        document.getElementById('identity').style.borderColor = 'red';
        identity.focus();
        return false;
    }
    else {
        document.getElementById('identity').style.borderColor = "green";
    }
    if(birth.value==''){
        window.alert("Enter your date of birth.");
        document.getElementById('birth').style.borderColor = 'red';
        birth.focus();
        return false;
    }
    else {
        document.getElementById('birth').style.borderColor = "green";
    }
    if(phone.value==''){
        window.alert("Enter your Phone Number.");
        document.getElementById('phone').style.borderColor = 'red';
        phone.focus();
        return false;
    }
    else {
        document.getElementById('phone').style.borderColor = "green";
    }
    if(email.value==''){
        window.alert("Enter your email address.");
        document.getElementById('email').style.borderColor = 'red';
        email.focus();
        return false;
    }
    else {
        document.getElementById('email').style.borderColor = "green";
    }
    if(address.value==''){
        window.alert("Enter your contact address.");
        document.getElementById('address').style.borderColor = 'red';
        address.focus();
        return false;
    }
    else {
        document.getElementById('address').style.borderColor = "green";
    }
    if(county.selectedIndex<1){
        window.alert("Please select your County.");
        document.getElementById('county').style.borderColor = 'red';
        county.focus();
        return false;
    }
    else {
        document.getElementById('county').style.borderColor = "green";
    }
    if(marital.selectedIndex<1){
        window.alert("Select your marital status.");
        document.getElementById('marital').style.borderColor = 'red';
        marital.focus();
        return false;
    }
    else {
        document.getElementById('marital').style.borderColor = "green";
    }
    if(primary.value==''){
        window.alert("Please enter your primary school name.");
        document.getElementById('pri_school').style.borderColor = 'red';
        primary.focus();
        return false;
    }
    else {
        document.getElementById('pri_school').style.borderColor = "green";
    }
    if(dateFrom_pri_school.value==''){
        window.alert("Year you joined primary school.");
        document.getElementById('dateFrom_pri_school').style.borderColor = 'red';
        dateFrom_pri_school.focus();
        return false;
    }
    else {
        document.getElementById('dateFrom_pri_school').style.borderColor = "green";
    }
    if(dateTo_pri_school.value==''){
        window.alert("Your final year in primary.");
        document.getElementById('dateTo_pri_school').style.borderColor = 'red';
        dateTo_pri_school.focus();
        return false;
    }
    else {
        document.getElementById('dateTo_pri_school').style.borderColor = "green";
    }
    if(marks.value==''){
        window.alert("Please enter your marks scored.");
        document.getElementById('marks').style.borderColor = 'red';
        marks.focus();
        return false;
    }
    else {
        document.getElementById('marks').style.borderColor = "green";
    }
    if(secondary.value==''){
        window.alert("Please enter your secondary school name.");
        document.getElementById('sec_school').style.borderColor = 'red';
        secondary.focus();
        return false;
    }
    else {
        document.getElementById('sec_school').style.borderColor = "green";
    }
    if(dateFrom_sec_school.value==''){
        window.alert("Date joined seconday.");
        document.getElementById('dateFrom_sec_school').style.borderColor = 'red';
        dateFrom_sec_school.focus();
        return false;
    }
    else {
        document.getElementById('dateFrom_sec_school').style.borderColor = "green";
    }
    if(dateTo_sec_school.value==''){
        window.alert("Final year in secondary.");
        document.getElementById('dateTo_sec_school').style.borderColor = 'red';
        dateTo_sec_school.focus();
        return false;
    }
    else {
        document.getElementById('dateTo_sec_school').style.borderColor = "green";
    }
    if(grade.selectedIndex<1){
        window.alert("Select Grade scored after secondary education.");
        document.getElementById('grade').style.borderColor = 'red';
        grade.focus();
        return false;
    }
    else {
        document.getElementById('grade').style.borderColor = "green";
    }
    if(studyMode.selectedIndex <1){
        window.alert("Select your study mode.");
        document.getElementById('studyMode').style.borderColor = 'red';
        studyMode.focus();
        return false;
    }
    else {
        document.getElementById('studyMode').style.borderColor = "green";
    }
    if(feeSource.selectedIndex <1){
        window.alert("Select your source of fees.");
        document.getElementById('feeSource').style.borderColor = 'red';
        feeSource.focus();
        return false;
    }
    else {
        document.getElementById('feeSource').style.borderColor = "green";
    }
    return true;

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

var course=document.forms['name']['phone'];

if(course.selectedIndex <1){
    window.alert('');
    course.focus();
    document.getElementById('id').style.borderColor='red';

}