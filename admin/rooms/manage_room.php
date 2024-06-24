<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `room_list` where id = '{$_GET['id']}'");
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
    <form action="" id="room-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="name" class="control-label">Room Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Enter Room Name" value ="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="room_type_id" class="control-label">Room Type</label>
            <select name="room_type_id" id="room_type_id" class="form-control form-control-border select2">
                <option value="" disabled <?= !isset($room_type_id) ? "selected" : "" ?>></option>
                <?php 
                $qry = $conn->query("SELECT * FROM `room_type_list` where delete_flag = 0 ".(isset($room_type_id) ? " or id = '{$room_type_id}' " : "")." order by `room` asc ");
                while($row = $qry->fetch_assoc()):
                ?>
                    <option <?= $row['delete_flag'] == 1 ? "disabled" : "" ?> <?= isset($room_type_id) && $room_type_id == $row['id'] ? "selected" : '' ?> value="<?= $row['id'] ?>"><?= $row['room'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <textarea rows="3" name="description" id="description" class="form-control form-control-sm rounded-0" placeholder="Write the room type's description here." required><?php echo isset($description) ? $description : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="capacity" class="control-label">Capacity</label>
            <input type="number" name="capacity" id="capacity" class="form-control form-control-border" placeholder="Enter Capacity" value ="<?php echo isset($capacity) ? $capacity : 0 ?>" required>
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
        $('#uni_modal #room-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_room",
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