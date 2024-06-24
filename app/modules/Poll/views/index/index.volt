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
          <ul class="list-group poll-group">
          {% for item in entries %}
           <li class="list-group-item">
              <p><strong>{{ item.getTitle() }}</strong> {% if item.getStatus() == 0 %} <span class="label label-success">{{ helper.translate('Active') }}</span> {% else %} <span class="label label-danger">{{ helper.translate('Not active') }}</span> {% endif %}</p>
              <p>{{ item.getCreatedAt() }}</p>
              <p>{{ helper.translate('Votes')}}: <strong>{{ item.votes | length }}</strong> | <a role="button" onclick="viewResultPoll({{ item.getId() }})">{{ helper.translate('view result')}}</a></p>
              <div id="poll-content"></div>
            </li>
          {% endfor %}
          </ul>
          <a href="{{ helper.currentUrl(constant('LANG')) }}poll" class="btn btn-prime btn-wh mr-3"> <i class="glyphicon glyphicon-menu-left "></i>НАЗАД К ГОЛОСОВАНИЮ</a>        
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


<script>

function viewResultPoll(id) {  
  $.post("/poll/vote/"+id+"?lang={{constant('LANG')}}", function (response) {
    if (response.success) {
      var classes;
      if(response.data.length == 5)
        classes = ['success','azure','info','warning','danger'];
      else
        classes = ['success','info','warning','danger'];

      $poll_html = [];
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
 
</script>