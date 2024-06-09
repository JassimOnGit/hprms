<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT p.*,d.fullname as doctor FROM `patient_history` p inner join `doctor_list` d on p.doctor_id = d.id where p.id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
    <dl>
        <dt class="text-primary"><b>Illness</b></dt>
        <dd class="pl-4"><?= isset($illness) && !empty($illness) ? $illness : 'N/A' ?></dd>
        <dt class="text-primary"><b>Diagnosis</b></dt>
        <dd class="pl-4"><?= isset($diagnosis) && !empty($diagnosis) ? $diagnosis : 'N/A' ?></dd>
        <dt class="text-primary"><b>Treatment</b></dt>
        <dd class="pl-4"><?= isset($treatment) && !empty($treatment) ? $treatment : 'N/A' ?></dd>
        <dt class="text-primary"><b>Assigned Doctor</b></dt>
        <dd class="pl-4"><?= isset($doctor) && !empty($doctor) ? $doctor : 'N/A' ?></dd>
        <dt class="text-primary"><b>Remarks</b></dt>
        <dd class="pl-4"><?= isset($remarks) && !empty($remarks) ? $remarks : 'N/A' ?></dd>
    </dl>
    <div class="col-12 text-right">
        <button class="btn btn-danger btn-flat btn-sm" id="delete_history"><i class="fa fa-trash"></i> Delete</button>
        <button class="btn btn-primary btn-flat btn-sm" id="edit_history"><i class="fa fa-edit"></i> Edit</button>
        <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss = 'modal'><i class="fa fa-times"></i> Close</button>
    </div>
</div>

<script>
    $(function(){
        $('#uni_modal #delete_history').click(function(){
            _conf("Are you sure to delete this patient record history?",'delete_history',['<?= isset($id) ? $id : '' ?>'])
        })
        $('#edit_history').click(function(){
            uni_modal("Edit Record Details","patients/manage_history.php?pid=<?= isset($patient_id) ? $patient_id : '' ?>&id=<?= isset($id) ? $id : '' ?>",'mid-large')
        })
    })
    function delete_history($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_patient_history",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>