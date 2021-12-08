<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<!-- <div class="page-breadcrumb">
		<div class="row">
			<div class="col-5 align-self-center">
				<h4 class="page-title">Dashboard</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin'; ?>">Home</a></li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="col-7 align-self-center">
				<div class="d-flex no-block justify-content-end align-items-center">
					<div class="mr-2">
						<div class="lastmonth"></div>
					</div>
					<div class=""><small>LAST MONTH</small>
						<h4 class="text-info mb-0 font-medium"><i class="fas fa-rupee-sign"></i>
							<?php
							if ($last_amt != '') {
								$last_amt = $last_amt;
							} else {
								$last_amt = '0';
							}
							?>
							<?php echo number_format($last_amt, 2); ?>
						</h4>
					</div>
					<div class="mr-2">
						<div class="lastmonth"></div>
					</div>
					<div class=""><small>Total Earnings</small>
						<h4 class="text-info mb-0 font-medium"><i class="fas fa-rupee-sign"></i>
							<?php echo number_format($total_amt, 2); ?>
						</h4>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- <div class="container-fluid">
		<div class="total-user">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body border-top">
							<div class="row mb-0">
								
								<div class="col-lg-3 col-md-6">
									<div class="user-total">
										<div class="d-flex align-items-center">

											<div><span>Total Users</span>
												<h3 class="font-medium mb-0"><?php echo $users; ?></h3>
											</div>
											<div class="ml-auto"><span class="text-orange display-5"><i class="fas fa-users"></i></span></div>
										</div>
									</div>
								</div>
								
								<div class="col-lg-3 col-md-6">
									<div class="user-total">
										<div class="d-flex align-items-center">

											<div><span>Total Vendors</span>
												<h3 class="font-medium mb-0"><?php echo $vendors; ?></h3>
											</div>
											<div class="ml-auto"><span class="text-cyan display-5"><i class=" fas fa-user-plus"></i></span></div>
										</div>
									</div>
								</div>
								
								<div class="col-lg-3 col-md-6">
									<div class="user-total">
										<div class="d-flex align-items-center">

											<div><span>Total Product</span>

												<h3 class="font-medium mb-0"><?php echo $products; ?></h3>
											</div>
											<div class="ml-auto"><span class="text-info display-5"><i class="fas fa-cubes"></i></span></div>
										</div>
									</div>
								</div>
								
								<div class="col-lg-3 col-md-6">
									<div class="user-total">
										<div class="d-flex align-items-center">

											<div><span>Total Orders</span>
												<h3 class="font-medium mb-0"><?php echo $orders; ?></h3>
											</div>
											<div class="ml-auto"><span class="text-primary display-5"><i class="fas fa-clipboard-list"></i></span></div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card ">
					<div class="card-body">
						<div class="sales-summry">
							<div class="row">
								<div class="col-md-6 col-lg-6">
									<h4 class="card-title">Sales Summary</h4>
									<h5 class="card-subtitle">Overview of Latest Month</h5>
								</div>
								<div class="col-md-6 col-lg-6">
									<form method="GET" action="<?php echo base_url() . 'admin/dashboard'; ?>" style="display: flex; align-content: center; line-height: 35px;">
										<input type="date" value="<?php if (isset($_GET['start_date'])) {
																		echo $_GET['start_date'];
																	} ?>" name="start_date" id="start_date" class="form-control" placeholder="Start Date">To
										<input type="date" value="<?php if (isset($_GET['end_date'])) {
																		echo $_GET['end_date'];
																	} ?>" name="end_date" id="end_date" class="form-control" placeholder="End Date">
										<button type="submit" class="btn btn-primary">Search</button>
									</form>
								</div>
							</div>
						</div>
						<div class="order-sum">
							<div class="row">

								
								<div class="col-lg-4">
									`
									<h1 class="mb-0 mt-4"><i class="fas fa-rupee-sign"></i> <?php echo number_format($current_tot, 2); ?></h1>
									<h6 class="font-light text-muted">Current Month Earnings</h6>
									<h3 class="mt-4 mb-0"><?php echo $current_order; ?></h3>
									<h6 class="font-light text-muted">Current Month Sales</h6>
									<a class="btn btn-info mt-3 p-15 pl-4 pr-4 mb-3" href="<?php echo base_url(); ?>admin/orders">View all orders</a>
								</div>
								
								<div class="col-lg-8">
									<div class="campaign ct-charts"></div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-lg-8">
				<div class="card">
					<div class="card-body">
						<div class="sales-summry">
							
							<div class="d-md-flex align-items-center">
								<div>
									<h4 class="card-title">Today's Top Orders</h4>
									<h5 class="card-subtitle">Overview of Latest Month</h5>
								</div>
							</div>
							
							<div class="table-responsive scrollable mt-2">
								<table class="table v-middle">
									<thead>
										<tr>
											<th class="border-top-0">Order ID</th>
											<th class="border-top-0">User</th>
											<th class="border-top-0">Status</th>
											<th class="border-top-0">Payment</th>
											<th class="border-top-0">Amount</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (count($data) > 0) {
											foreach ($data as $key => $value) {
												if ($value['chr_status'] == 'P') {
													$status_cls = 'label-info';
													$status_lbl = 'Pending';
												} else if ($value['chr_status'] == 'W') {
													$status_cls = 'label-warning';
													$status_lbl = 'In Progress';
												} else if ($value['chr_status'] == 'R') {
													$status_cls = 'label-danger';
													$status_lbl = 'Rejected';
												} else if ($value['chr_status'] == 'C') {
													$status_cls = 'label-success';
													$status_lbl = 'Completed';
												} else if ($value['chr_status'] == 'A') {
													$status_cls = 'label-success';
													$status_lbl = 'Accepted';
												}
										?>
												<tr>
													<td><a href="<?php echo base_url() . 'admin/orders/viewDetails/' . base64_encode($value['int_glcode']); ?>"># <?php echo $value['order_id']; ?></a></td>
													<td><?php echo $value['var_name']; ?></td>
													<td><span class="label <?php echo $status_cls; ?>"><?php echo $status_lbl; ?></span></td>
													<td><?php echo $value['var_payment_mode']; ?></td>
													<td class="font-medium"><i class="fas fa-rupee-sign"></i> <?php echo $value['var_payable_amount']; ?></td>
												</tr>
											<?php }
										} else { ?>
											<td class="font-medium">No Data Found.</td>
										<?php } ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="card">
					<div id="donut-chart"></div>
					<div class="card-body border-bottom">
						<h4 class="card-title">Order Stats</h4>
						<h5 class="card-subtitle">Overview of orders</h5>
					</div>

				</div>
			</div>
		</div>
	</div> -->
</div>
<script src="<?php echo base_url(); ?>public/dist/js/pages/c3-chart/bar-pie/c3-donut.js"></script>
<script type="text/javascript">
	$(function() {
		"use strict";
		// ============================================================== 
		// Newsletter
		// ============================================================== 

		var chart = new Chartist.Line('.campaign', {
			labels: ['<?php echo $w1_title; ?>', '<?php echo $w2_title; ?>', '<?php echo $w3_title; ?>', '<?php echo $w4_title; ?>', '<?php echo $w5_title; ?>'],
			series: [
				[<?php echo $week1 . ' , ' . $week2 . ' , ' . $week3 . ' , ' . $week4 . ' , ' . $week5; ?>],
			]
		}, {
			low: 0,
			high: 28,

			showArea: true,
			fullWidth: true,
			plugins: [
				Chartist.plugins.tooltip()
			],
			axisY: {
				onlyInteger: true,
				scaleMinSpace: 40,
				offset: 20,
				labelInterpolationFnc: function(value) {
					return (value / 1) + 'k';
				}
			},

		});
	});
</script>
<script type="text/javascript">
	$(function() {
		var o = c3.generate({
			bindto: "#donut-chart",
			color: {
				pattern: ["#ffaf0e", "#f62d51", "#2ea08c"]
			},
			data: {
				columns: [
					["option1", 30],
					["option2", 120]
				],
				type: "donut",
				onclick: function(o, n) {
					console.log("onclick", o, n)
				},
				onmouseover: function(o, n) {
					console.log("onmouseover", o, n)
				},
				onmouseout: function(o, n) {
					console.log("onmouseout", o, n)
				}
			},
			donut: {
				title: "Total Orders"
			}
		});
		setTimeout(function() {
				o.load({
					columns: [
						["Success", '<?php echo $status_success; ?>'],
						["Pending", '<?php echo $status_pending; ?>'],
						["Failed", '<?php echo $status_failed; ?>']
					]
				})
			}, 1500),
			setTimeout(function() {
				o.unload({
					ids: "option1"
				}), o.unload({
					ids: "option2"
				})
			}, 2500)
	});
</script>