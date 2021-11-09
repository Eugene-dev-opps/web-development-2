//approveTransNow
function approveTransact() {
if(confirm("Are you sure you want to approve?")) {
document.frmUser.action = "setApproveDonation2.php";
document.frmUser.submit();
}
}

//setCancelTransaction
function cancelTransact() {
if(confirm("Are you sure you want to cancel?")) {
document.frmUser.action = "setCancelTransaction.php";
document.frmUser.submit();
}
}

//setCancelTransactionBlock
function cancelTransactBlock() {
if(confirm("Are you sure you want to cancel and block Donor?")) {
document.frmUser.action = "setCancelTransactionBlock.php";
document.frmUser.submit();
}
}