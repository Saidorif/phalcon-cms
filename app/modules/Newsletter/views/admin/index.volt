<div class="ui tabular menu init">
  <a class="item active" data-tab="news-list">
      {{helper.at('Newsletter list')}}
  </a>
  <a class="item" data-tab="subscribe">
      {{helper.at('Subscribed')}}
  </a>  
  <a class="item" data-tab="settings">
      {{helper.at('Settings')}}
  </a>
</div>

<div class="ui segment tab active" data-tab="news-list">
  <h2>{{ helper.at('Choose from the list for sending newsletter') }}</h2>
  <form method="post" action="/newsletter/news?lang={{constant('LANG')}}" class="ui form">
    <table class="ui table very compact celled">
      <thead>
      <tr>
        <th width="30"></th>        
        <th>{{ helper.at('Title') }}</th>        
        <th>{{ helper.at('Type of Publication') }}</th>        
        <th>{{ helper.at('Publication Date') }}</th>        
        <th>{{ helper.at('Status') }}</th>      
      </tr>
      </thead>
      {% if publications.total_items > 0 %}
        <tbody>
        {% for index, news in publications.items %}
          {% set url = helper.langUrl(['for':'publication', 'type':news['type_slug'], 'slug':news['url']]) %}
          <tr>
            <td>               
              {% if news['status'] == 'sent' %}
                <div class="ui checkbox nl">
                  <input type="checkbox" tabindex="{{index}}" disabled="disabled" class="hidden">
                  <label></label>
                </div>
              {% elseif news['status'] == 'not-sent' %} 
                <div class="ui checkbox nl">
                  <input type="checkbox" name="news_id[]" tabindex="{{index}}" value="{{ news['id'] }}" class="hidden">
                  <label></label>
                </div>
                <input type="hidden" name="news_title[]" value="{{ news['title'] }}" disabled="disabled">
                <input type="hidden" name="news_date[]" value="{{ news['date'] }}" disabled="disabled">
                <input type="hidden" name="news_url[]" value="{{ url }}" disabled="disabled">
              {% endif %}          
            </td>
            <td><a href="{{ url }}" target="_blank">{{ news['title'] }}</a></td>
            <td>{{ news['type_title'] }}</td>
            <td>{{ news['date'] }}</td>
            <td>{% if news['status'] == 'sent' %}<span class="ui green label">{{ helper.at('Sent') }}</span> {% elseif news['status'] == 'not-sent' %}<span class="ui red label">{{ helper.at('Not sent') }}</span>{% endif %}</td>
          </tr>
        {% endfor %}
        </tbody>
      {% endif %}
    </table>
    {% if publications.total_pages > 1 %}
      <div class="pagination">
        {{ partial('admin/pagination', ['paginate':publications] ) }}
      </div>
    {% endif %}
    <div class="actions">
      <button class="ui button submit positive" type="submit">{{ helper.at('Save') }}</button>
    </div>
  </form>  
</div> 

<div class="ui tab" data-tab="subscribe">
  <div class="ui segment">
    <a href="javascript:void(0);" class="add ui button positive">
      <i class="icon plus"></i> {{ helper.at('Subscribe') }}
    </a>
  </div>
  <table class="ui table very compact celled">
    <thead>
    <tr>
      <th>{{ helper.at('Email') }}</th>        
      <th>{{ helper.at('Phone') }}</th>        
      <th width="150"></th>        
    </tr>
    </thead>
    <tbody>
    {% for item in entries %}
      <tr>
        <td>{{ item.getEmail() }}</td>
        <td><a href="javascript:void(0);" onclick="deleteItem({{ item.getId() }}, this)" class="ui button mini red">{{ helper.at('Delete') }}</a></td>
      </tr>
    {% endfor %}
    </tbody>
  </table>
</div>  

<div class="ui segment tab" data-tab="settings">
  <h2>{{ helper.at('Settings newsletter') }}</h2>
  <form method="post" action="/newsletter/settings/{{ settings.getId() }}" class="ui form">
    <div class="grouped fields">
      <label for="fruit">{{ helper.at('Category newsletter') }}:</label>    
      {% for index, item in categories %}
        {% if item.getSlug() != 'services' %}    
        <div class="field">
          <div class="ui radio checkbox">
            <input type="radio" name="category" tabindex="{{index}}" {% if settings.getCategory() == item.getId() %}checked{% endif %} value="{{ item.getId() }}" class="hidden">
            <label>{{ item.getTitle() }}</label>
          </div>
        </div> 
        {% endif %}   
      {% endfor %}
    </div>  
    <div class="field">
      <label for="from_name">{{ helper.at('Theme newsletter sender') }} *</label>
      <input type="text" id="from_name" name="from_name" value="{{ settings.getFromName() }}" required>
    </div> 
    <div class="field">
      <label for="email">{{ helper.at('Email address sender') }} *</label>
      <input type="email" id="email" name="email" value="{{ settings.getEmail() }}" required>
    </div>
    <div class="actions">
      <button class="ui button submit positive" type="submit">{{ helper.at('Save') }}</button>
    </div>
  </form>  
</div>   

<div class="ui modal tiny menu-create">
  <i class="close icon"></i>
  <div class="header">
    {{ helper.at('Subscribe') }}
  </div>
  <div class="content ui form">
    <div class="ui segment">
      <div class="field email">
        <label for="email">{{ helper.at('Email') }} *</label>
        <input type="email" id="email" name="email" required>
      </div>                       
    </div>
  </div>
  <div class="actions">
    <div class="ui button red cancel">{{ helper.at('Cancel') }}</div>
    <div class="ui button green approve">{{ helper.at('Add') }}</div>
  </div>
</div>

<script type="text/javascript">

  $(".ui.checkbox.nl input:checkbox").on("change", function () {
    $(this).parents('td').find('input[type=hidden]').prop("disabled", !$(this).prop("checked"));
  });

  function deleteItem(id, node) {
    if (confirm("{{ helper.at('Do you really want delete this email?') }}")) {
      $.post('/newsletter/admin/delete', {id:id}, function (response) {
        if (response.success) {
          var parent = node.parentNode.parentNode;
          if (parent)
            parent.parentNode.removeChild(parent);            
        }
      });
    }
  }

  $('.add').click(function (e) {
    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }
    $('.ui.tiny.modal.menu-create').modal({ 
        onApprove : function() {
          var email = $('.content.ui.form').find('#email').val();          
          if(!email) {
            $('.content.ui.form').find('.field.email').addClass('error');
            return false;
          } 
          if (validateEmail(email)) {  
            $.post("/newsletter/admin/add", {email:email}, function (response) {
              if (response.success == true) { 
                var newItem = $('<tr><td>'+response.email+'</td><td><a href="javascript:void(0);" onclick="deleteItem('+response.id+', this)" class="ui button mini red">{{ helper.at('Delete') }}</a></td></tr>');
                $('table.table tbody').append(newItem);
              }
              if (response.error) {
                var errorText = response.error;
                if(response.error == 'Email is already exists')
                  errorText = "{{ helper.at('Email is already exists') }}";
                noty({layout: 'center', type: 'error', text: errorText, timeout: 2000});
              }
            }, 'json');
          } else {
            $('.content.ui.form').find('.field.email').addClass('error');
            return false;
          }           
        }
    }).modal('show');
  });
</script> 