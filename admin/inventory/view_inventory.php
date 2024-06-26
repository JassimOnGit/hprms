<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT r.*,rt.equipment from `inventory` r inner join equipment_type_list rt on r.equipment_type_id = rt.id where r.id = '{$_GET['id']}'");
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
        <dt class="text-muted">Item Name</dt>
        <dd class='pl-4 fs-4 fw-bold'><?= isset($name) ? $name : '' ?></dd>
        <dt class="text-muted">Equipment/Item Type</dt>
        <dd class='pl-4 fs-4 fw-bold'><?= isset($equipment) ? $equipment: '' ?></dd>
        <dt class="text-muted">Description</dt>
        <dd class='pl-4'>
            <p class=""><small><?= isset($description) ? html_entity_decode($description) : '' ?></small></p>
        </dd>
        <dt class="text-muted">Quantity</dt>
        <dd class='pl-4 fs-4 fw-bold'><?= isset($quantity) ? ($quantity) : 0 ?></dd>
    </dl>
    <div class="col-12 text-right">
        <button class="btn btn-flat btn-sm btn-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>