//approveDonation
function approveDonation() {
if(confirm("Are you sure you want to approve?")) {
document.frmUser.action = "setApproveDonation.php";
document.frmUser.submit();
}
}

//disapproveDonation
function disapproveDonation() {
if(confirm("Are you sure you want to disapprove?")) {
document.frmUser.action = "";
document.frmUser.submit();
}
}

//activateUser
function activateUser() {
if(confirm("Are you sure you want to activated?")) {
document.frmUser.action = "setActivateUser.php";
document.frmUser.submit();
}
}

//blockUser
function blockUser() {
if(confirm("Are you sure you want to block user(s)?")) {
document.frmUser.action = "setBlockUser.php";
document.frmUser.submit();
}
}

//makeAdmin
function setUserAdmin() {
if(confirm("Are you sure you want to make user(s) Admin?")) {
document.frmUser.action = "setUserAdmin.php";
document.frmUser.submit();
}
}

//setUserUsr
function setUserUsr() {
if(confirm("Are you sure you?")) {
document.frmUser.action = "setUserUsr.php";
document.frmUser.submit();
}
}

//setUserSubAdmin
function setUserSubAdmin() {
if(confirm("Are you sure you want to make user a Sub Admin?")) {
document.frmUser.action = "setUserSubAdmin.php";
document.frmUser.submit();
}
}
