 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
 	<!-- Brand Logo -->
 	<a href="#" class="brand-link">
 		<img src="<?php echo isset(generalSettings()->logo)?base_url('assets/images'.'/'.generalSettings()->logo): base_url('assets/images/AdminLTELogo.png') ?>" alt="AdminLTE Logo"
 		class="brand-image img-circle elevation-3" style="opacity: .8">
 		<span class="brand-text font-weight-light"><?php echo isset(generalSettings()->title) ? generalSettings()->title:'ULT'?></span>
 	</a>
 	<!-- Sidebar -->
	<div class="sidebar">
 		<!-- Sidebar user panel (optional) -->
 		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
 			<div class="image">
 				<a href="<?php echo base_url('admin/profile/profile') ?>">
 					<img src="<?php echo base_url('assets/images') ?>/<?php echo isset(getProfilePicture($this->current_user_id)->image) ? getProfilePicture($this->current_user_id)->image:'user2-160x160.jpg'?>" class="img-circle elevation-2" alt="User Image">
 				</a>
 			</div>
 			<div class="info">
 				<a href="<?php echo base_url('admin/profile/profile') ?>" class="d-block"><?php echo isset(getProfilePicture($this->current_user_id)->first_name) ? getProfilePicture($this->current_user_id)->first_name:''?></a>
 			</div>
 		</div>
	 	<!-- Sidebar Menu -->
	 	<nav class="mt-2">
	 		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	 			<li class="nav-item has-treeview <?php echo (isset($active) && $active == 'dashboard') ? 'active':''; ?>">
	 				<a href="<?php echo base_url('admin/dashboard') ?>" class="nav-link <?php echo (isset($active) && $active == 'dashboard') ? 'active':''; ?>">
	 					<i class="nav-icon fas fa-tachometer-alt"></i>
	 					<p>
	 						Dashboard
	 					</p>
	 				</a>
	 			</li>
	 			<li class="nav-item has-treeview <?php echo (isset($active) && ($active == 'suppliers_list' || $active == 'add_suppliers')) ? 'active menu-open':''; ?>">
	 				<a href="#" class="nav-link <?php echo (isset($active) && ($active == 'suppliers_list' || $active == 'add_suppliers')) ? 'active':''; ?>">
	 					<i class="nav-icon fas fa-users"></i>
	 					<p> Suppliers <i class="fas fa-angle-left right"></i> </p>
	 				</a>
	 				<ul class="nav nav-treeview">
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/suppliers/suppliers_list') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'suppliers_list') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Suppliers List</p>
	 						</a>
	 					</li>
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/suppliers/add_suppliers') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'add_suppliers') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Add Supplier</p>
	 						</a>
	 					</li>
	 				</ul>
	 			</li>
	 			<li class="nav-item has-treeview <?php echo (isset($active) && ($active == 'customers_list' || $active == 'add_customers')) ? 'active menu-open':''; ?>">
	 				<a href="#" class="nav-link <?php echo (isset($active) && ($active == 'customers_list' || $active == 'add_customers')) ? 'active':''; ?>">
	 					<i class="nav-icon fas fa-users"></i>
	 					<p> Customers <i class="fas fa-angle-left right"></i> </p>
	 				</a>
	 				<ul class="nav nav-treeview">
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/customers/customers_list') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'customers_list') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Customers List</p>
	 						</a>
	 					</li>
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/customers/add_customers') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'add_customers') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Add Customer</p>
	 						</a>
	 					</li>
	 				</ul>
	 			</li>
	 			<li class="nav-item has-treeview <?php echo (isset($active) && ($active == 'expenses_head_list' || $active == 'expenses_list')) ? 'active menu-open':''; ?>">
	 				<a href="#" class="nav-link <?php echo (isset($active) && ($active == 'expenses_head_list' || $active == 'expenses_list')) ? 'active':''; ?>">
	 					<i class="nav-icon fas fa-users"></i>
	 					<p> Expenses <i class="fas fa-angle-left right"></i> </p>
	 				</a>
	 				<ul class="nav nav-treeview">
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/expenses/expenses_head_list') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'expenses_head_list') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Expenses Head</p>
	 						</a>
	 					</li>
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/expenses/expenses_list') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'expenses_list') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Add Expense</p>
	 						</a>
	 					</li>
	 				</ul>
	 			</li>
	 			<li class="nav-item has-treeview <?php echo (isset($active) && ($active == 'drivers_list' || $active == 'add_drivers')) ? 'active menu-open':''; ?>">
	 				<a href="#" class="nav-link <?php echo (isset($active) && ($active == 'drivers_list' || $active == 'add_drivers')) ? 'active':''; ?>">
	 					<i class="nav-icon fas fa-users"></i>
	 					<p> Drivers <i class="fas fa-angle-left right"></i> </p>
	 				</a>
	 				<ul class="nav nav-treeview">
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/drivers/drivers_list') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'drivers_list') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Drivers List</p>
	 						</a>
	 					</li>
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/drivers/add_drivers') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'add_drivers') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Add Driver</p>
	 						</a>
	 					</li>
	 				</ul>
	 			</li>
	 			<li class="nav-item has-treeview <?php echo (isset($active) && ($active == 'create_booking' || $active == 'booking')) ? 'active menu-open':''; ?>">
	 				<a href="#" class="nav-link <?php echo (isset($active) && ($active == 'create_booking' || $active == 'booking')) ? 'active':''; ?>">
	 					<i class="nav-icon fas fa-users"></i>
	 					<p> Booking <i class="fas fa-angle-left right"></i> </p>
	 				</a>
	 				<ul class="nav nav-treeview">
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/orders/booking') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'booking') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>All Booking</p>
	 						</a>
	 					</li>
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/orders/create_booking') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'create_booking') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Create Booking</p>
	 						</a>
	 					</li>
	 				</ul>
	 			</li>
	 			<li class="nav-item has-treeview <?php echo (isset($active) && ($active == 'receive_truck' || $active == 'order_list')) ? 'active menu-open':''; ?>">
	 				<a href="#" class="nav-link <?php echo (isset($active) && ($active == 'receive_truck' || $active == 'order_list')) ? 'active':''; ?>">
	 					<i class="nav-icon fas fa-users"></i>
	 					<p> Truck <i class="fas fa-angle-left right"></i> </p>
	 				</a>
	 				<ul class="nav nav-treeview">
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/orders/index') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'receive_truck') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Receive Truck</p>
	 						</a>
	 					</li>
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/orders/order_list') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'order_list') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Receive Truck List</p>
	 						</a>
	 					</li>
	 				</ul>
	 			</li>
	 			<li class="nav-item has-treeview <?php echo (isset($active) && ($active == 'assigned_deliveries' || $active == 'riders_list' || $active == 'add_riders' || $active == 'assign_delivery' || $active == 'all_deliveries')) ? 'active menu-open':''; ?>">
	 				<a href="#" class="nav-link <?php echo (isset($active) && ($active == 'assigned_deliveries' || $active == 'riders_list' || $active == 'add_riders' || $active == 'assign_delivery' || $active == 'all_deliveries')) ? 'active':''; ?>">
	 					<i class="nav-icon fas fa-users"></i>
	 					<p> Delivery Section <i class="fas fa-angle-left right"></i> </p>
	 				</a>
	 				<ul class="nav nav-treeview">
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/riders/riders_list') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'riders_list') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Riders (Delivery Boy)</p>
	 						</a>
	 					</li>
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/riders/add_riders') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'add_riders') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Add Riders (Delivery Boy)</p>
	 						</a>
	 					</li>
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/orders/all_deliveries') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'all_deliveries') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>All deliveries</p>
	 						</a>
	 					</li>
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/riders/assign_delivery') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'assign_delivery') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Assign new deliveries</p>
	 						</a>
	 					</li>
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/riders/assigned_deliveries') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'assigned_deliveries') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Assigned deliveries</p>
	 						</a>
	 					</li>
	 				</ul>
	 			</li>
	 			<li class="nav-item has-treeview <?php echo (isset($active) && ($active == 'payment')) ? 'active menu-open':''; ?>">
	 				<a href="#" class="nav-link <?php echo (isset($active) && ($active == 'payment')) ? 'active':''; ?>">
	 					<i class="nav-icon fas fa-users"></i>
	 					<p> Payment Section <i class="fas fa-angle-left right"></i> </p>
	 				</a>
	 				<ul class="nav nav-treeview">
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/payments/index') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'payment') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Payment</p>
	 						</a>
	 					</li>
	 				</ul>
	 			</li>
	 			<li class="nav-item has-treeview <?php echo (isset($active) && ($active == 'cash_book')) ? 'active menu-open':''; ?>">
	 				<a href="#" class="nav-link <?php echo (isset($active) && ($active == 'cash_book')) ? 'active':''; ?>">
	 					<i class="nav-icon fas fa-users"></i>
	 					<p> Reports <i class="fas fa-angle-left right"></i> </p>
	 				</a>
	 				<ul class="nav nav-treeview">
	 					<li class="nav-item">
	 						<a href="<?php echo base_url('admin/reports/cash_book') ?>"
	 							class="nav-link <?php echo (isset($active) && $active == 'cash_book') ? 'active':''; ?>">
	 							<i class="far fa-circle nav-icon"></i>
	 							<p>Cash Book</p>
	 						</a>
	 					</li>
	 				</ul>
	 			</li>
	 			<li class="nav-item has-treeview <?php echo (isset($active) && $active == 'general_settings') ? 'active':''; ?>">
	 				<a href="<?php echo base_url('admin/generalSettings/general_settings') ?>" class="nav-link <?php echo (isset($active) && $active == 'general_settings') ? 'active':''; ?>">
	 					<i class="nav-icon fas fa-cog"></i>
	 					<p>
	 						General Settings
	 					</p>
	 				</a>
	 			</li>
	 			<li class="nav-item">
	 				<a href="<?php echo base_url('login/logout') ?>" class="nav-link">
	 					<i class="nav-icon fas fa-hand-point-up"></i>
	 					<p>
	 						Log out
	 					</p>
	 				</a>
	 			</li>
	 		</ul> 
	 	</nav>
	 	<!-- /.sidebar-menu -->
	</div>
 <!-- /.sidebar -->
</aside>
