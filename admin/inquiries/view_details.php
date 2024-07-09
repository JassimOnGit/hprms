<?php 
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `message_list` where id ='{$_GET['id']}' ");
    if($qry->num_rows > 0 ){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k=$v;
            }
        }
        if(isset($id) && isset($status) && $status != 1)
        $conn->query("UPDATE `message_list` set status = 1 where id = '{$id}'");
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <dl>
                <dt class="text-primary">Inquirer:</dt>
                <dd class="pl-4"><?= isset($fullname) ? $fullname : "" ?></dd>
                <dt class="text-primary">Gender:</dt>
                <dd class="pl-4"><?= isset($sex) ? $sex : "" ?></dd>
                <dt class="text-primary">Email:</dt>
                <dd class="pl-4"><?= isset($email) ? $email : "" ?></dd>
                <dt class="text-primary">Contact #:</dt>
                <dd class="pl-4"><?= isset($mobile) ? $mobile : "" ?></dd>
                <dt class="text-primary">Message:</dt>
                <dd class="pl-4"><?= isset($message) ? $message : "" ?></dd>
                <dt class="text-primary">Doctor:</dt>
                <dd class="pl-4"><?= isset($doctor_schedule) ? $doctor_schedule : "" ?></dd>
                <dt class="text-primary">Doctor Appointment Date:</dt>
                <dd class="pl-4"><?= isset($doctor_schedule_appointment_date) ? $doctor_schedule_appointment_date : "" ?></dd>
                <dt class="text-primary">Appointment Date:</dt>
                <dd class="pl-4"><?= isset($appointment_date) ? $appointment_date : "" ?></dd>
                <dt class="text-primary">Date Created:</dt>
                <dd class="pl-4"><?= isset($date_created) ? $date_created : "" ?></dd>
            </dl>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
            <button class="btn btn-flat btn-sm btn-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
    </div>
</div>