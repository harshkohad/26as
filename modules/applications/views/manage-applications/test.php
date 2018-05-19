
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0-rc.1/themes/smoothness/jquery-ui.css">-->
<div class="row">
    <label class="control-label" for="usertags" style=" margin-top: 0px;">Dynamic Variables</label>
    <?php
    foreach ($fields as $field) {
        ?>
        <p style="display:inline; font-size: 20px;" draggable="true" class="test"> {<?php echo $field; ?>} </p>              
        <?php
    }
    ?>
</div><br/>
<form>
    <div class="row">
        <div class="col-lg-6">
            <div class="no-label">
                <textarea name="nip_template" rows="17" cols="100"></textarea>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="no-label">
                <input type='submit' value="Submit" class="btn btn-success"/>
            </div>
        </div>
    </div>
</form>

<?php
$this->registerJs("$(function(){  
    document.addEventListener('dragstart', function (event) {
        event.dataTransfer.setData('Text', event.target.innerHTML);
    });
    });");
?>
<style>
    #container p { display: inline }
</style>