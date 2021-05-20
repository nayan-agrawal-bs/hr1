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
$result = $conn->query("SELECT * FROM request WHERE uid={$uid} Limit $start,$limit");
$users = $result->fetch_all(MYSQLI_ASSOC);

$result1 = $conn->query("SELECT COUNT(uid) AS 'user_id' FROM request WHERE uid={$uid} ");
$userCount = $result1->fetch_all(MYSQLI_ASSOC);
$total = $userCount[0]['user_id'];
$pages = ceil($total / $limit);

//echo "<script>console.log('<?= $pages')";

if($page==1){
    $Previous=1;
}else{
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
        
        

        <!-- <div class="m-1 py-1">
            <div class="text-center" style="margin-top: 20px; " class="col-md-2">
                <form method="POST" action="">
                    <select name="limit-records" id="limit-records" class="custom-select" style="width:200px">
                        <option disabled="disabled" selected="selected">Limit Records</option>
                        <?php //foreach ([1, 2, 50, 100] as $limit) : ?>
                            <option <?php //if (isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit)
                                      //echo "selected" ?> value=""></option>
                        <?php //endforeach; ?>
                    </select>
                </form>
            </div>
        </div> -->

        <div class="p-3 py-5">
        <table id="" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Id</th>
					<th>Type</th>
					<th>Date</th>
					<th>Time</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user) :  ?>
					<tr>
						<td>
							<?= $user['uid']; ?>
						</td>
						<td>
							<?= $user['type']; ?>
						</td>
						<td>
							<?= $user['date']; ?>
						</td>
						<td>
							<?= $user['time']; ?>
						</td>
						<td>
							<?= $user['status']; ?>
						</td>
						</t>
					<?php endforeach; ?>
			</tbody>
		</table>
        </div>
        <ul class="pagination justify-content-end" >
                <li class="page-item"><a class="page-link" href="request.php?page=<?= $Previous; ?>"><<</a></li>
                <li class="page-item">
                    <?php for ($i = 1; $i < $pages; $i++) : ?>
                <li class="page-item"><a class="page-link" href="request.php?page=<?= $i; ?>"><?= $i; ?></a></li>

            <?php endfor; ?>
            <li class="page-item"><a class="page-link" href="request.php?page=<?= $Next; ?>">>></a></li>
            </ul><br>
    </div>

</div>
<!-- End demo content -->

<script type="text/javascript">
    
    $(document).ready(function() {
			$("#limit-records").change(function() {
			
			 $('form').submit();
			})
		})
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>

</html>