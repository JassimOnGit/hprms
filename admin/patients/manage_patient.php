<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `patient_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }

        $details = $conn->query("SELECT * FROM `patient_details` where patient_id = '{$id}' ");
        while($row = $details->fetch_assoc()){
            ${$row['meta_field']} = $row['meta_value'];
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
    <form action="" id="patient-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="firstname" class="control-label">First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control form-control-border" placeholder="First Name" value ="<?php echo isset($firstname) ? $firstname : '' ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="middlename" class="control-label">Middle Name <em>(optional)</em></label>
                <input type="text" name="middlename" id="middlename" class="form-control form-control-border" placeholder="Middle Name (optional)" value ="<?php echo isset($middlename) ? $middlename : '' ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="lastname" class="control-label">Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control form-control-border" placeholder="Last Name" value ="<?php echo isset($lastname) ? $lastname : '' ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="suffix" class="control-label">Suffix <em>(If Any)</em></label>
                <input type="text" name="suffix" id="suffix" class="form-control form-control-border" placeholder="Sr/Jr" value ="<?php echo isset($middlename) ? $middlename : '' ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="gender" class="control-label">Gender</label>
                <select name="gender" id="gender" class="form-control form-control-border" reqiured>
                    <option <?= isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option <?= isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="dob" class="control-label">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control form-control-border" placeholder="Contact #" value ="<?php echo isset($dob) ? date("Y-m-d",strtotime($dob)) : '' ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="email" class="control-label">Email</label>
                <input type="text" name="email" id="email" class="form-control form-control-border" placeholder="Email" value ="<?php echo isset($email) ? $email : '' ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="contact" class="control-label">Contact #</label>
                <input type="text" name="contact" id="contact" class="form-control form-control-border" placeholder="Contact #" value ="<?php echo isset($contact) ? $contact : '' ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="address" class="control-label">Address</label>
                <textarea rows="3" name="address" id="address" class="form-control form-control-sm rounded-0" placeholder="Block 6, Lot 23, Here Subd., There City, 2306" required><?php echo isset($address) ? $address : '' ?></textarea>
            </div>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#uni_modal #patient-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_patient",
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
                        location.href='./?page=patients/view_patient&id='+resp.pid;
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