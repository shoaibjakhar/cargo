<div class="container-fluid">
  <div class="row">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3><?php echo getTotalSuppliers(); ?></h3>
          <p>Total Suppliers</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?php echo base_url('admin/suppliers/suppliers_list') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3><?php echo getTotalCustomers(); ?></h3>

          <p>Total Customers</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?php echo base_url('admin/customers/customers_list') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box" style="background: olive">
        <div class="inner text-white">
          <h3><?php echo getTotalDrivers(); ?></h3>

          <p>Total Driver</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="<?php echo base_url('admin/drivers/drivers_list') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div> 
 <div class="row">
    <section class="col-lg-7 connectedSortable">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Sales
          </h3>
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item">
                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="card-body">
          <div class="tab-content p-0">
           
            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
              <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
            </div>
            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
              <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
            </div>
          </div>
        </div>
      </div>
     
    </section>
    <section class="col-lg-5 connectedSortable">

     
      <div class="card bg-gradient-success">
        <div class="card-header border-0">

          <h3 class="card-title">
            <i class="far fa-calendar-alt"></i>
            Calendar
          </h3>
          <div class="card-tools">
            <div class="btn-group">
              <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-bars"></i></button>
              <div class="dropdown-menu float-right" role="menu">
                <a href="#" class="dropdown-item">Add new event</a>
                <a href="#" class="dropdown-item">Clear events</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">View calendar</a>
              </div>
            </div>
            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body pt-0">
          <div id="calendar" style="width: 100%"></div>
        </div>
      </div>
    </section>
  </div>
</div>

