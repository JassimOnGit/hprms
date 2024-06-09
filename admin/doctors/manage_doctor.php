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
    #cimg{
        object-fit:scale-down;
        object-position:center center;
        height:200px;
        width:200px;
    }
</style>
<div class="container-fluid">
    <form action="" id="doctor-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="fullname" class="control-label">Fullname</label>
            <input type="text" name="fullname" id="fullname" class="form-control form-control-border" placeholder="Enter Fullname" value ="<?php echo isset($fullname) ? $fullname : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="specialization" class="control-label">Specialization</label>
            <textarea rows="3" name="specialization" id="specialization" class="form-control form-control-sm rounded-0" placeholder="Write the doctor's specialization here." required><?php echo isset($specialization) ? $specialization : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input type="email" name="email" id="email" class="form-control form-control-border" placeholder="Enter Email" value ="<?php echo isset($email) ? $email : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Contact #</label>
            <input type="text" name="contact" id="contact" class="form-control form-control-border" placeholder="Enter Contact #" value ="<?php echo isset($contact) ? $contact : '' ?>" required>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#uni_modal #doctor-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_doctor",
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