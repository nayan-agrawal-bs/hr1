<?php

session_start();

if (!isset($_SESSION["loggedin"]) && !($_SESSION["loggedin"] === true)) {
    header("location: login.php");
    exit;
}
include('conn.php');
$uid = $_SESSION['uid'];

$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$result = $conn->query("SELECT * FROM attendance WHERE uId={$uid} Limit $start,$limit");
$users = $result->fetch_all(MYSQLI_ASSOC);

$result1 = $conn->query("SELECT COUNT(aId) AS 'user_id' FROM attendance WHERE uId={$uid}");
$userCount = $result1->fetch_all(MYSQLI_ASSOC);
$total = $userCount[0]['user_id'];
$pages = ceil($total / $limit);

//echo "<script>console.log('<?= $pages')";

if ($page == 1) {
    $Previous = 1;
} else {
    $Previous = $page - 1;
}
$Next = $page + 1;


?>

<?php include('head.php'); ?>

<!-- Vertical navbar -->
<?php include('navbar.php'); ?>
<!-- End vertical navbar -->


<!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>

    <div class="container rounded bg-white mt-5 mb-5">

        <div class="row mt-2" style='padding:3%'><br>

            <div class="col-md-6"> <button class="btn btn-primary profile-button" id="checkin" onclick="checkin()">Check In</button></div>
            <div class="col-md-6"><button class="btn btn-primary profile-button" id="checkout" onclick="checkout()">Check Out</button></div>

        </div>

        <br>
    </div>
    <div class="container rounded bg-white mt-5 mb-5">



        <div style="height: 600px; overflow-y: auto;">
        <br>
            <table id="" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) :  ?>
                        <tr>
                            <td>
                                <?= $user['uId']; ?>
                            </td>
                            <td>
                                <?= $user['date']; ?>
                            </td>
                            <td>
                                <?= $user['status']; ?>
                            </td>

                            </t>
                        <?php endforeach; ?>
                </tbody>
            </table>
            <ul class="pagination justify-content-end">
                <li class="page-item"><a class="page-link" href="main.php?page=<?= $Previous; ?>">
                        <<</a> </li> <li class="page-item">
                            <?php for ($i = 1; $i < $pages; $i++) : ?>
                <li class="page-item"><a class="page-link" href="main.php?page=<?= $i; ?>"><?= $i; ?></a></li>

            <?php endfor; ?>
            <li class="page-item"><a class="page-link" href="main.php?page=<?= $Next; ?>">>></a></li>
            </ul><br>


        </div>

    </div>



</div>




</div>
<!-- End demo content -->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#limit-records").change(function() {

            $('form').submit();
        })
    })
</script>
<script type="text/javascript">
    function checkin() {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("txtHint").innerHTML = this.responseText;
                console.log(this.responseText);
            }
        };
        xmlhttp.open("GET", "checkin.php", true);
        xmlhttp.send();
    }

    function checkout() {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("txtHint").innerHTML = this.responseText;
                console.log(this.responseText);
            }
        };
        xmlhttp.open("GET", "checkout.php", true);
        xmlhttp.send();
    }
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>

</html>