  <div class="modal fade podpiska" id="newsletter-content" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="/newsletter/subscribe" method="post">        
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">{{helper.translate('Subscribe')}}</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="email">{{helper.translate('Email')}}</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="{{ helper.translate('Your email') }}" required>
              </div>
              <div class="form-group">
                <label for="agree">
                  <input type="checkbox" name="agree" id="agree" value="I agree"/>
                  {{ helper.translate('I agree with the conditions') }}
                </label>
              </div>
          </div><!-- /. modal body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{helper.translate('Close')}}</button>
            <button type="submit" disabled="disabled" class="btn btn-primary">{{helper.translate('Subscribe')}}</button>
          </div>
          <div class="status-text"></div>
        </form><!-- /. form -->
      </div>
    </div>
  </div>


<script>
$(document).ready(function() {
  var formContent = $('#newsletter-content'); 
  var formID = formContent.find('form');    
  function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
  formID.submit(function() {
    var email = formContent.find('input#email').val();
    if (validateEmail(email)) {
      $(this).ajaxSubmit({     
        success: function(response) {           
          if(response.success) {
            formContent.fadeOut('slow', function(){
              var message = "{{helper.translate('successfully subscribed')}}";  
              formContent.fadeIn('slow').html('<div class="alert alert-success"><strong>'+response.email+'</strong> '+message+'</div>');
            }); 
          } 
          if (response.error) {
            var errorText = response.error;
            if(response.error == 'Email is already exists')
              errorText = "{{ helper.translate('Email is already exists') }}";
            $('.status-text').text(errorText);            
          } 
        }
      });      
    } else  
      $('.status-text').text("{{ helper.translate('Email is not correct') }}");
     
    return false;
  });    
  
});

$('#agree').change(function() {
    if(this.checked) {
      $('#newsletter-content button.btn').removeAttr('disabled');  
    }
    else {
      $('#newsletter-content button.btn').attr('disabled', 'disabled');
    }        
});
</script>