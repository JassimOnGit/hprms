<style>
    #cover-img{
        object-fit:cover;
        object-position:center center;
        width: 100%;
        height: 100%;
    }
</style>
<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<hr class="border-info">
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-th-list"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Room Types</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `room_type_list` where delete_flag =0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-door-open"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Total Rooms</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `room_list` where delete_flag = 0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-info elevation-1"><i class="fas fa-user-md"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Doctors</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `doctor_list` where delete_flag = 0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-info elevation-1"><i class="fas fa-user-nurse"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Nurses</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `nurse_list` where delete_flag = 0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-user-injured"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Patients</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `patient_list`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<hr>
<div class="w-100" style="height:50vh">
    <img src="<?= validate_image($_settings->info('cover')) ?>" alt="System Cover Image" id="cover-img" class="img-fluid h-100 bg-gradient-dark">
</div>