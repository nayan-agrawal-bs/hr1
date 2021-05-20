$(function() { 
    $('#sidebarCollapse').on('click', function() {
      $('#sidebar, #content').toggleClass('active');
    });
  });
  
  

function signout(){
  var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
   
  if (this.readyState == 4 && this.status == 200) {
    //document.getElementById("txtHint").innerHTML = this.responseText;
    console.log(this.responseText);
  }
};
xmlhttp.open("GET", "signout.php", true);
xmlhttp.send();
}