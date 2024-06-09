<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `patient_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
                $$k = $v;
        }

        $details = $conn->query("SELECT * FROM `patient_details` where patient_id ='{$id}' ");
        while($row = $details->fetch_assoc()){
            ${$row['meta_field']} = $row['meta_value'];
        }
    }else{
        echo "<script> alert('Unknown Patient ID.'); location.href = './?page=patients';</script>";
    }
}else{
    echo "<script> alert('Patient ID is required.'); location.href = './?page=patients';</script>";
}

$doctors_arr = [];
$doctors_qry = $conn->query("SELECT * FROM `doctor_list` where id in (SELECT doctor_id FROM `patient_history` where patient_id ='{$id}') ");
if($doctors_qry->num_rows > 0)
$doctors_arr = array_column($doctors_qry->fetch_all(MYSQLI_ASSOC),'fullname','id');

$room_arr = [];
$room_qry = $conn->query("SELECT * FROM `room_list` where id in (SELECT room_id FROM `admission_history` where patient_id ='{$id}') ");
if($room_qry->num_rows > 0)
$room_arr = array_column($room_qry->fetch_all(MYSQLI_ASSOC),'name','id');
?>
<div class="content py-3">
    <div class="card card-teal card-outline shadow rounded-0">
        <div class="card-header rounded-0">
            <h3 class="card-title"><b><span class="text-muted">Patient Code:</span> <span><?= isset($code) ? $code : "N/A" ?></span></b></h3>
        </div>
        <div class="card-body rounded-0">
            <div class="container-fluid">
                <fieldset>
                    <div class="row">
                        <div class="col-4 border bg-gradient-primary text-white">Patient Code</div>
                        <div class="col-8 border"><?= isset($code) ? $code : '' ?></div>
                        <div class="col-4 border bg-gradient-primary text-white">Patient Fullname</div>
                        <div class="col-8 border"><?= isset($fullname) ? $fullname : '' ?></div>
                        <div class="col-3 border bg-gradient-primary text-white">Gender</div>
                        <div class="col-3 border"><?= isset($gender) ? $gender : '' ?></div>
                        <div class="col-3 border bg-gradient-primary text-white">Birthday</div>
                        <div class="col-3 border"><?= isset($dob) ? date("M d, Y", strtotime($dob)) : '' ?></div>
                        <div class="col-3 border bg-gradient-primary text-white">Address</div>
                        <div class="col-9 border"><?= isset($address) ? $address : '' ?></div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-primary border-bottom">History</legend>
                            <div class="col-12 text-right">
                                <button class="btn btn-primary btn-sm btn-flat" type="button" id="add_history"><i class="fa fa-plus"></i> Add Record</button>
                            </div>
                            <table class="table table-striped table-bordered">
                                <colgroup>
                                    <col width="20%">
                                    <col width="35%">
                                    <col width="25%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr class="bg-gradient-dark">
                                        <th class="px-2 py-1">Date</th>
                                        <th class="px-2 py-1">Diagnosis</th>
                                        <th class="px-2 py-1">Doctor</th>
                                        <th class="px-2 py-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $history = $conn->query("SELECT * FROM `patient_history` where patient_id = '{$id}' order by unix_timestamp(date_created) asc");
                                        while($row = $history->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td class="px-2 py-1"><?= date("Y-m-d",strtotime($row['date_created'])) ?></td>
                                        <td class="px-2 py-1"><p class="m-0 truncate-1"><?= $row['diagnosis'] ?></p></td>
                                        <td class="px-2 py-1"><p class="m-0 truncate-1"><?= isset($doctors_arr[$row['doctor_id']]) ? $doctors_arr[$row['doctor_id']] : "N/A" ?></p></td>
                                        <td class='px-2 py-1 text-center'><a href="javascript:void(0)" data-id='<?= $row['id'] ?>' class="view_history text-dark"><i class="fa fa-eye text-dark"></i> View</a></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                    <fieldset>
                            <legend class="text-primary border-bottom">Admission History</legend>
                            <div class="col-12 text-right">
                                <button class="btn btn-primary btn-sm btn-flat" type="button" id="add_admission"><i class="fa fa-plus"></i> Add Record</button>
                            </div>
                            <table class="table table-striped table-bordered">
                                <colgroup>
                                    <col width="20%">
                                    <col width="35%">
                                    <col width="25%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr class="bg-gradient-dark">
                                        <th class="px-2 py-1">Admission Date</th>
                                        <th class="px-2 py-1">Room ID</th>
                                        <th class="px-2 py-1">Date Discharge</th>
                                        <th class="px-2 py-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $admission = $conn->query("SELECT * FROM `admission_history` where patient_id = '{$id}' order by unix_timestamp(date_created) asc");
                                        while($row = $admission->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td class="px-2 py-1"><?= date("Y-m-d",strtotime($row['date_admitted'])) ?></td>
                                        <td class="px-2 py-1"><p class="m-0 truncate-1"><?= isset($room_arr[$row['room_id']]) ? $room_arr[$row['room_id']] : "N/A" ?></p></td>
                                        <td class="px-2 py-1"><?= isset($row['date_discharged']) && strtotime($row['date_discharged']) > 0 ? date("Y-m-d",strtotime($row['date_discharged'])) : "N/A" ?></td>
                                        <td class='px-2 py-1 text-center'><a href="javascript:void(0)" data-id='<?= $row['id'] ?>' class="view_admission text-dark"><i class="fa fa-eye text-dark"></i> View</a></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#add_history').click(function(){
            uni_modal("Add New Record","patients/manage_history.php?pid=<?= isset($id) ? $id : '' ?>",'mid-large')
        })
        $('#add_admission').click(function(){
            uni_modal("Add New Admission","patients/manage_admission.php?pid=<?= isset($id) ? $id : '' ?>",'mid-large')
        })
        $('.view_history').click(function(){
            uni_modal("Record Details","patients/view_history.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('.view_admission').click(function(){
            uni_modal("Admission Details","patients/view_admission.php?id="+$(this).attr('data-id'))
        })
    })
</script>