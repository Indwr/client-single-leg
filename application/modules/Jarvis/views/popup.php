<?php include_once'header.php'; ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">Popup Image</h1>
          </div>
          <div class="col-sm-4">
            
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
              <li class="breadcrumb-item">Popup</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <?php echo form_open_multipart('Jarvis/Management/popup_upload',array('id' => 'walletForm'));?>
              
            <h3 class="text-danger"><?php echo $this->session->flashdata('error'); ?></h3>
            <div class="form-group">
                <label>Caption</label>
                <input type="text" class="form-control" name="caption" value="<?php echo set_value('caption');?>" id="user_id" placeholder="Caption"/>
                <span class="text-danger"><?php echo form_error('caption')?></span>
                <span id="errorMessage"></span>
            </div>
            <div class="form-group">
                <label>Type</label>
                <select class="form-control" name="type" id="selectType"/>
                    <option value="image">IMAGE</option>
                    <option value="txt">TEXT</option>
                </select>
            </div>
            <div class="form-group" id="imageField">
                <label>Media</label>
                <?php echo form_input(array('class' => 'form-control', 'type' => 'file', 'name' => 'media'));?>
                <span class="text-danger"><?php echo form_error('media')?></span>
            </div>
            <div class="form-group" id="videoField" style="display:none;">
                <label>TEXT</label>
                <?php echo form_textarea(array('class' => 'form-control', 'type' => 'text', 'name' => 'media'));?>
                <span class="text-danger"><?php echo form_error('media')?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Send</button>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once'footer.php'; ?>
<script>
  $(document).on('change','#selectType',function(){
        $('#imageField').toggle();
        $('#videoField').toggle();
  })

  $(document).on('click','.popsettings',function(){
  var status = $(this).data('status');
  var user_id = $(this).data('user_id');
  var url = "<?php echo base_url('Jarvis/Management/popupStatus/');?>";
  $.get(url,function(res){
    alert(res.message)
    if(res.success == 1)
      location.reload()
  },'json')
})
</script>

