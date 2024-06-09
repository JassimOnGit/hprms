<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `doctor_list` where id = '{$_GET['id']}'");
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
        display:none !important;
    }
</style>
<div class="container-fluid">
    <dl>
        <dt class="text-muted">Name</dt>
        <dd class='pl-4 fs-4 fw-bold'><?= isset($fullname) ? $fullname : '' ?></dd>
        <dt class="text-muted">Specialization</dt>
        <dd class='pl-4'>
            <p class=""><small><?= isset($specialization) ? html_entity_decode($specialization) : '' ?></small></p>
        </dd>
        <dt class="text-muted">Email</dt>
        <dd class='pl-4 fs-4 fw-bold'><?= isset($email) ? ($email) : "N/A" ?></dd>
        <dt class="text-muted">Contact #</dt>
        <dd class='pl-4 fs-4 fw-bold'><?= isset($contact) ? ($contact) : "N/A" ?></dd>
    </dl>
    <div class="col-12 text-right">
        <button class="btn btn-flat btn-sm btn-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>