<div>
<form action="" method="post" class="ui form" enctype="multipart/form-data">
     <!--tab main-->
    <div class="ui segment">
        {{ form.renderDecorated('site_name') }}
        {{ form.renderDecorated('email') }}
        {{ form.renderDecorated('logo') }}
        {{ form.renderDecorated('favicon') }}
    </div>
    <!--/end tab main-->

    <button type="submit" class="ui button green"><i class="icon save"></i> {{helper.at('Save')}}</button>
</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('input[type="file"]').change(function(event){
  	var fileID = $(this).attr('name');
		var formData = new FormData();
		formData.append(fileID, event.target.files[0]);

		$.ajax({
      type : 'POST',
      url : '/cms/settings/file/'+fileID,
      data : formData,
      processData: false,
      contentType: false,
      success : function(data) {
        location.reload();
      }
		});

  });
});
</script>
