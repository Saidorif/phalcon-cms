{% if polls %}
{% for poll in polls %}  
  <div id="poll-content">
    <form action="/poll/vote" method="post">
      <input type="hidden" name="poll_id" value="{{poll.getId()}}">  
      <h3>{{ poll.getTitle() }}</h3>

      {% for field in poll.options %}         
        <div class="radio">
          <input type="radio" name="vote" id="vote_{{field.getId()}}" value="{{field.getVote()}}">
          <label for="vote_{{field.getId()}}">{{field.getTitle()}}</label>
        </div>                     
      {% endfor %}
      <div class="form-actions">
        <input class="btn btn-primary" type="submit" value="{{helper.translate('Vote')}}">
      </div>
    </form>
  </div>

  <script>
  $(document).ready(function() {

    var pollLang = "poll_{{constant('LANG')}}";
    var pollId = "{{poll.getId()}}";

    function resultPoll(id){
      $.post("/poll/vote/"+id+"?lang={{constant('LANG')}}", function (response) {
        if (response.success) {
          var classes;
          if(response.data.length == 5)
            classes = ['success','azure','info','warning','danger'];
          else
            classes = ['success','info','warning','danger'];

          $poll_html = ['<h2>'+response.title+'</h2>'];
          response.data.forEach(function(item, index){
            if(response.total > 0)
              var vote = Math.round((item.vote / response.total) * 100);
            if(response.total == 0)
              var vote = 0;
            $poll_html.push('<div class="bar-main-container '+classes[index]+'"><div class="wrap"><h4>'+item.title+'</h4><div class="bar-container"><div class="bar" style="width:'+vote+'%"></div></div><div class="bar-percentage">'+item.vote+' ('+vote+'%)</div></div></div>');
          });        
          $('#poll-content').html($poll_html);
        }
      });
    }
    if($.cookie(pollLang) === pollId){
      resultPoll(pollId);
    }

    var formContent = $('#poll-content'); 
    var formID = formContent.find('form'); 

    formID.submit(function() {
      $.cookie(pollLang, pollId, { expires: 365, path: '/'});
      $('.ajax-loader').show();
      $(this).ajaxSubmit({     
        success: function(res) { 
          resultPoll(res.id);  
        }
      }); 
      return false; 
    });    
    
  });
  </script>  
{% endfor %}
{% endif %}
