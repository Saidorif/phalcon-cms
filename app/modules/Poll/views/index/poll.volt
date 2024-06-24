<header class="body-bg">
  {{ partial('main/menu') }}
</header>
<section class="breadcrub-wrapper">
  <div class="container">
    {{helper.widget('Breadcrumbs').breadcrumbs()}}
  </div>
</section>
<section class="tenders">
  <div class="container">
    <div class="row">
      <div class="col-md-8 tender-posts">
        <header class="ov-h mb-1">
          <h1 class="content-title pull-left">{{title}}</h1>
          <a href="#" class="printDemo text-uppercase print-btn pull-right">
            <span class="glyphicon glyphicon-print"></span> {{ helper.translate('print version') }} 
          </a>
        </header>
        <div class="content">          
          {% if polls %}
            {% for poll in polls %}

            <div class="new-poll" id="new-poll">
              <div id="poll-content" class="poll-content">
                <form action="/poll/vote" method="post">
                  <input type="hidden" name="poll_id" value="{{poll.getId()}}">  
                  <h3 class="poll-title">{{ poll.getTitle() }}</h3>

                  {% for field in poll.options %}
                    <p>
                      <input type="radio" id="vote_{{field.getId()}}" name="vote" value="{{field.getVote()}}">
                      <label for="vote_{{field.getId()}}">{{field.getTitle()}}</label>
                    </p>                     
                  {% endfor %}
                  <p class="poll-control">
                    <input class="btn btn-prime mr-3" type="submit" value="{{helper.translate('Vote')}}">
                    <a href="{{ helper.currentUrl(constant('LANG')) }}polls" class="btn btn-def">РЕЗУЛЬТАТЫ</a>
                    <span class="pull-right poll-info">
                      <span><i class="glyphicon glyphicon-flag"></i>{{ poll.votes | length }}</span>
                      <span><i class="glyphicon glyphicon-time"></i>{{ poll.getCreatedAt('d.m.Y') }}</span>
                      <!-- <span><i class="glyphicon glyphicon-remove-circle"></i>31.12.2018</span> -->
                    </span>
                  </p>
                </form>
              </div><!-- /. poll-content -->
            </div><!-- /. new-poll -->

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

                      $poll_html = ['<h3 class="poll-title">'+response.title+'</h3>'];
                      response.data.forEach(function(item, index){
                        if(response.total > 0)
                          var vote = Math.round((item.vote / response.total) * 100);
                        if(response.total == 0)
                          var vote = 0;
                        $poll_html.push('<div class="ov-h mb-05 '+classes[index]+'"><span class="pull-left">'+item.title+'</span><span class="pull-right">'+item.vote+' {{helper.translate('Polls')}} ('+ item.vote+'%)</sapn></div><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="'+item.vote+'" aria-valuemin="0" aria-valuemax="100" style="width: '+item.vote+'%;"></div></div>');
                      });        
                      $('#poll-content').html($poll_html);
                      $('#new-poll').addClass('poll-result');
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
        </div>
      </div>

      <div class="col-md-4 sidebar">
        <h5 class="sidebar-title text-uppercase m-0"> <span class="glyphicon glyphicon-align-justify"></span> {{ title }}</h5>
        <div class="sidebar-item mb-4">
          <ul class="press-news">
          </ul>
        </div><!-- sidebar-item -->
      </div><!-- / sidebar -->
    </div>
  </div>
</section>

