var testName;
function validateform(){
    event.preventDefault();
    var user=document.getElementById("username").value;
    var pass=document.getElementById("password").value;
    if(user=="sunil" && pass=="rec"){
        window.location.href="hist.html";
        document.getElementById("username").value="";
        document.getElementById("password").value="";
    }
    else{
        window.alert("Invalid username or password");
        document.getElementById("username").value="";
        document.getElementById("password").value="";
    }
}
function compreset(){
    document.getElementById("complaintForm").reset();
}
function clearModalContent() {
    document.getElementById("name").value = "";
    document.getElementById("ph").value = "";
    document.querySelector(".display").innerHTML = "";
}
function test_Name(button){
    testName = button.parentElement.querySelector('h3').textContent.trim();
    document.getElementById("test").value=testName;
}
function test_Name1(button){
    testName = button.parentElement.querySelector('p').textContent.trim();
    document.getElementById("test").value=testName;
}
// Add smooth scrolling functionality
document.querySelectorAll('nav a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        if (targetId === 'home') {
            window.scrollTo({
                top:0,
                behavior:"smooth"
            }); // Scroll to the very top of the page
        } else {
            const targetElement = document.getElementById(targetId);
            const navbarHeight = document.querySelector('nav').offsetHeight;
            const targetOffset = targetElement.offsetTop - navbarHeight;
            window.scrollTo({
                top: targetOffset,
                behavior: 'smooth'
            });
        }
    });
});