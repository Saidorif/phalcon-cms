<div id="feedback-content">
  <form action="/webform/feedback" method="post" enctype="multipart/form-data">    
    <div class="col-md-6">
      <div class="form-group">
        <label class="form-label">{{ helper.translate('name') }}  *</label>
        {{ form.renderDecorated('name') }}
      </div>
      <div class="form-group">
        <label class="form-label">Email *</label>
        {{ form.renderDecorated('email') }}
      </div>
      <div class="form-group">
        <label class="form-label">{{ helper.translate('Phone') }}  *</label>  
        {{ form.renderDecorated('phone') }}
      </div> 
      <div class="form-group">
        <label class="form-label">{{ helper.translate('Attach file') }}  *</label>  
        {{ form.renderDecorated('files') }}
        <div class="description">.jpg, .jpeg, .png, .bmp, .pdf</div>
      </div> 
    </div>
    <div class="col-md-6">  
      <div class="form-group">
        <label class="form-label">{{ helper.translate('company') }} *</label>
        {{ form.renderDecorated('company') }}
      </div>
      <div class="form-group">
        <label class="form-label">{{ helper.translate('massage') }} *</label>
        {{ form.renderDecorated('message') }}
      </div>
    </div>  
    <div class="btn-group send">
      <button class="btn" type="submit">{{ helper.translate('Send') }}</button>
    </div>
  </form>
  <div class="ajax-loader"></div>
</div>



<script>
  $(document).ready(function() {
    var formContent = $('#feedback-content'); 
    var formID = formContent.find('form');  

    $('input#files').change(function(){    
      var fileValidate = $(this).val(); 
      var extension = fileValidate.replace(/^.*\./, '');
      var fileExtension = ['jpeg', 'jpg', 'png', 'pdf', 'bmp'];
      if ($.inArray(extension.toLowerCase(), fileExtension) == -1) {
        $(this).parent().parent().removeClass('has-success');
        $(this).parent().parent().addClass('has-warning');
        $(this).val('');
      }
      else {
        $(this).parent().parent().removeClass('has-warning');
        $(this).parent().parent().addClass('has-success');
      }
    })   

    formID.submit(function() {
      $('.ajax-loader').show();
      $(this).ajaxSubmit({     
        success: function() { 
          formContent.fadeOut('slow', function(){
            $('.ajax-loader').hide();  
            var message = "{{helper.translate('Email has been send')}}";  
            formContent.fadeIn('slow').html('<div class="alert alert-success">'+message+'</div>');
          }); 
        }
      }); 
      return false; 
    });    
    
  });

  var verifyCallback = function(response) {
    if(response)
      $('.btn-group.send .btn').attr('disabled', false);
  };
    
  var onloadCallback = function() {        
    grecaptcha.render('reCaptcha', {
      'sitekey' : '6Lfy1BcUAAAAAEwZQ3aRwljSvfSaw7sZAT25zAo9',
      'callback' : verifyCallback,
      'theme' : 'light'
    });
  };
</script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
  async defer>
</script>