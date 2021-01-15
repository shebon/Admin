<?php
include('top.php');

$sql = "select order_master.*,order_status.order_status as order_status_str,order_status.id as status_id from order_master,order_status where order_master.order_status=order_status.id order by order_master.id desc";
$res = mysqli_query($con, $sql);

?>
<div class="card">
	<div class="card-body">
		<h1 class="grid_title">Order Master</h1>
		<div class="row grid_box">

			<div class="col-12">
				<div class="table-responsive">
					<table id="order-listing" class="table">
						<thead>
							<tr>
								<th width="5%">Order Id</th>
								<th width="20%">Name/Email/Mobile</th>
								<th width="20%">Address/Zipcode</th>
								<th width="5%">Price</th>
								<th width="10%">Payment Status</th>
								<th width="10%">Order Status</th>
								<th width="15%">Added On</th>
							</tr>
						</thead>
						<tbody>
							<?php if (mysqli_num_rows($res) > 0) {
								$i = 1;
								while ($row = mysqli_fetch_assoc($res)) {
							?>
									<tr>
										<td>
											<div class="div_order_id">
												<a href="order_detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a>
											</div>
										</td>
										<td>
											<p><?php echo $row['name'] ?></p>
											<p><?php echo $row['email'] ?></p>
											<p><?php echo $row['mobile'] ?></p>
										<td>
											<p><?php echo $row['address'] ?></p>
											<p><?php echo $row['zipcode'] ?></p>
										</td>
										<td><?php echo $row['total_price'] ?></td>
										<td>
											<div class="payment_status payment_status_<?php echo $row['payment_status'] ?>"><?php echo ucfirst($row['payment_status']) ?></div>
										</td>
										<td>
											<div class="payment_status order_status_<?php echo $row['status_id'] ?>"><?php echo ucfirst($row['order_status_str']) ?></div>
										</td>
										<td>
											<?php
											$dateStr = strtotime($row['added_on']);
											echo date('d-m-Y h:s', $dateStr);
											?>
										</td>

									</tr>
								<?php
									$i++;
								}
							} else { ?>
								<tr>
									<td colspan="5">No data found</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>