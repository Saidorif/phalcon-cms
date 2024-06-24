<form method="post" action="" class="ui form" enctype="multipart/form-data">
  <div class="ui segment">
    <a href="{{ url.get() }}poll/admin/index" class="ui button">
      <i class="icon left arrow"></i> {{ helper.at('Back') }}
    </a>
    <div class="ui positive submit button">
      <i class="save icon"></i> {{ helper.at('Save') }}
    </div>
    {% if model is defined %}
      <a href="{{ url.get() }}poll/admin/delete/{{ model.getId() }}?lang={{ constant('LANG') }}" class="ui button red">
        <i class="icon trash"></i> {{ helper.at('Delete') }}
      </a>
    {% endif %}
  </div>
  
  <div class="ui segment">
    {{ form.renderDecorated('title') }}
    {{ form.renderDecorated('status') }}
    <div class="sixteen wide column">    
      <hr>
      <div class="add_fields">
        <h3 class="admin-heading">Варианты опроса</h3>
        <p><a href="#" class="ui positive button add_input"><i class="add square icon"></i> Добавить вариант</a></p>
        {% for field in fields %}
        <div class="additional">
          <input type="hidden" name="id_add[]" value="{{field.getId()}}">
          <div class="half">                                
            <label for="">Вариант</label> 
            <input type="text" name="title_add[]" value="{{field.getTitle()}}" placeholder="Вариант" required>
            <input type="hidden" name="value_add[]" value="{{field.getVote()}}">  
          </div>                    
          <div class="half last">
            <a href="#" class="removeField" id="{{field.getId()}}"><i class="minus square icon"></i></a>
          </div>                    
        </div>                
        {% endfor %} 
      </div>
      <div class="ui green inverted segment" id="message-del">{{helper.at('Fields deleted')}}</div>
    </div> 
  </div>
    
</form>

<script>
  $(".ui.form").form({
    fields: {
      title: {
        identifier: 'title',
        rules: [
          {type: 'empty'}
        ]
      }
    }
  });
</script>

<script type="text/javascript">
  $(function() {   
    var scntDiv = $('.add_fields');
    var countAdd = $('.add_fields .additional').size();    
    var i = countAdd + 1; 
    
    if(countAdd == 5){
      $('.add_input').hide();
    }

    $(document).on('click', '.removeInput', function() {
      if( i > 2 ) {
        $(this).parents('.additional').remove();
        var countAdd = $('.add_fields .additional').size();
        if(countAdd < 6){
          $('.add_input').show();
        }
        i--;
      }
       
      return false;
    });    
    $('.add_input').on('click', function(e) {
      e.preventDefault(); 
      $('<div class="additional"><input type="hidden" name="id_add[]" value="0"><div class="half"><label>Вариант</label><input type="text" name="title_add[]" placeholder="Вариант"><input type="hidden" name="value_add[]" value="'+i+'"></div><div class="half last"><a href="#" class="removeInput"><i class="minus square icon"></i></a></div></div>').appendTo(scntDiv);
      var countAdd = $('.add_fields .additional').size();
      if(countAdd == 5){
        $('.add_input').hide();
      }  
      i++;
      return false;
    });
    $('.additional').each(function() {
      var delAc = $(this).find('a.removeField');
      delAc.on('click', function(event){
        var container = $(this).parents('.additional');
        var id = $(this).attr('id');
        event.preventDefault(); 
        $.ajax({
          type : 'DELETE', 
          url : '/poll/admin/removefield/'+id, 
        }).done(function() {  
          container.remove();
          $('#message-del').fadeIn('slow');
        });
      });       
    });    
  });    
</script>