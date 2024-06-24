<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `inventory` where id = '{$_GET['id']}'");
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
    #cimg{
        object-fit:scale-down;
        object-position:center center;
        height:200px;
        width:200px;
    }
</style>
<div class="container-fluid">
    <form action="" id="inventory-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="name" class="control-label">Item Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Enter Item Name" value ="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="equipment_type_id" class="control-label">Equipment/Item Type</label>
            <select name="equipment_type_id" id="equipment_type_id" class="form-control form-control-border select2">
                <option value="" disabled <?= !isset($equipment_type_id) ? "selected" : "" ?>></option>
                <?php 
                $qry = $conn->query("SELECT * FROM `equipment_type_list` where delete_flag = 0 ".(isset($equipment_type_id) ? " or id = '{$equipment_type_id}' " : "")." order by `equipment` asc ");
                while($row = $qry->fetch_assoc()):
                ?>
                    <option <?= $row['delete_flag'] == 1 ? "disabled" : "" ?> <?= isset($equipment_type_id) && $equipment_type_id == $row['id'] ? "selected" : '' ?> value="<?= $row['id'] ?>"><?= $row['equipment'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <textarea rows="3" name="description" id="description" class="form-control form-control-sm rounded-0" placeholder="Write the item's description here." required><?php echo isset($description) ? $description : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="quantity" class="control-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control form-control-border" placeholder="Enter Quantity" value ="<?php echo isset($quantity) ? $quantity : 0 ?>" required>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#uni_modal').on('shown.bs.modal',function(){
            console.log('test')
            $(".select2").select2({
                placeholder:"Please Select Here",
                width:'100%',
                dropdownParent:$('#uni_modal')
            })
        })
        $('#uni_modal #inventory-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_inventory",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload();
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>