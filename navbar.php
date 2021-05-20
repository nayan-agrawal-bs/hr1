<div class="vertical-nav bg-white" id="sidebar">
  <div class="py-4 px-3 mb-4 bg-light">
    <div class="media d-flex align-items-center">
      <img loading="lazy" src="download.jpeg" alt="..." width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
      <div class="media-body">
        <h4 class="m-0">Company</h4>
        <p class="font-weight-normal text-muted mb-0">Web Project</p>
      </div>
    </div>
  </div>

  <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Dashboard</p>

  <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
      <a href="main.php" class="nav-link text-dark bg-light">
        <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
        Home
      </a>
    </li>
    <li class="nav-item">
      <a href="profile.php" class="nav-link text-dark bg-light">
        <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
        Profile
      </a>
    </li>
    <li class="nav-item">
      <a href="userinput.php" class="nav-link text-dark">
        <i class="fa  fa-users mr-3 text-primary fa-fw"></i>
        Users Sign-Up
      </a>
    </li>
    <li class="nav-item">
      <a href="search.php" class="nav-link text-dark">
        <i class="fa fa-search mr-3 text-primary fa-fw"></i>
        Search User
      </a>
    </li>
    
    <li class="nav-item">
      <a href="request.php" class="nav-link text-dark">
        <i class="fa fas fa-circle-o mr-3 text-primary fa-fw"></i>
        Requests
      </a>
    </li>
    <li class="nav-item">
      <a href="leave.php" class="nav-link text-dark">
        <i class="fa fas  fa-calendar-plus-o mr-3 text-primary fa-fw"></i>
        Leave/EW
      </a>
    </li>
    <li class="nav-item">
      <a href="approval.php" class="nav-link text-dark">
        <i class="fa fas fa-check-circle-o mr-3 text-primary fa-fw"></i>
        Approval
      </a>
    </li>
    <li class="nav-item">
      <a href="login.php" class="nav-link text-dark" onclick="signout()">
        <i class="fa fa-sign-out mr-3 text-primary fa-fw"></i>
        Sign-out
      </a>
    </li>
  </ul>


</div>
<script type="text/javascript">

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
</script>