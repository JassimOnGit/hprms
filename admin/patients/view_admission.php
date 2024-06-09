<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT a.*,r.name as room FROM `admission_history` a inner join `room_list` r on a.room_id = r.id where a.id = '{$_GET['id']}'");
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
        <dt class="text-primary"><b>Room</b></dt>
        <dd class="pl-4"><?= isset($room) && !empty($room) ? $room : 'N/A' ?></dd>
        <dt class="text-primary"><b>Admission Date</b></dt>
        <dd class="pl-4"><?= isset($date_admitted) && !empty($date_admitted) ? date("Y-m-d H:i",strtotime($date_admitted)) : 'N/A' ?></dd>
        <dt class="text-primary"><b>Date Discharged</b></dt>
        <dd class="pl-4"><?= isset($date_discharged) && !empty($date_discharged) && strtotime($date_discharged) > 0 ? date("Y-m-d H:i",strtotime($date_discharged)) : 'N/A' ?></dd>
    </dl>
    <div class="col-12 text-right">
        <button class="btn btn-danger btn-flat btn-sm" id="delete_admission"><i class="fa fa-trash"></i> Delete</button>
        <button class="btn btn-primary btn-flat btn-sm" id="edit_admission"><i class="fa fa-edit"></i> Edit</button>
        <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss = 'modal'><i class="fa fa-times"></i> Close</button>
    </div>
</div>

<script>
    $(function(){
        $('#uni_modal #delete_admission').click(function(){
            _conf("Are you sure to delete this patient admission record history?",'delete_admission',['<?= isset($id) ? $id : '' ?>'])
        })
        $('#edit_admission').click(function(){
            uni_modal("Edit Record Details","patients/manage_admission.php?pid=<?= isset($patient_id) ? $patient_id : '' ?>&id=<?= isset($id) ? $id : '' ?>",'mid-large')
        })
    })
    function delete_admission($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_patient_admission",
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