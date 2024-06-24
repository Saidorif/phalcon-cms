<header class="body-bg">
  {{ partial('main/menu') }}
</header>
<section class="tenders">
  <div class="container">
    {{helper.widget('Breadcrumbs').breadcrumbs()}}      
    <div class="row">
      <div class="col-md-8 tender-posts">
        <header class="ov-h mb-1">
          <h1 class="content-title pull-left">{{title}}</h1>
          <a href="#" class="printDemo text-uppercase print-btn pull-right">
            <span class="glyphicon glyphicon-print"></span> {{ helper.translate('print version') }} 
          </a>
        </header>
        <div class="content">          
          <div class=""> 
            {% if category %} 
              <ul class="nav nav-tabs" role="tablist">
                {% for cat in category %}
                  <li class="nav-item">
                    <a class="nav-link{% if loop.first %} active{% endif %}" href="#media-{{cat.getId()}}" role="tab" data-toggle="tab" aria-expanded="true">{{cat.getTitle()}}</a>
                  </li>   
                {% endfor %}   
              </ul>
            {% endif %}
            <div class="tab-content">
              <div  id="media-1" class="portfolio-item active tab-pane">
                {% if fotogallery %}
                {% for  prt in fotogallery %}
                  {% set image = helper.image([
                    'id': prt.getId(),
                    'type': 'media',
                    'width': 400,
                    'strategy': 'w'
                  ]) %}
                  {% set url = helper.langUrl(['for':'media',  'slug':prt.getSlug()]) %}

                <div class=" img-p col-md-6">
                  <div class="video-container" style="background-image:url(/{{prt.anons}});">
                    <a href="{{url}}" class="video-link">
                    <span class="fa fa-step-forward"></span>
                    </a>
                  </div>
                </div>
                  {% endfor %}
                {% endif %}
              </div>
              <div  id="media-2" class="portfolio-item  tab-pane">
                {% if videogallery %}
                {% for  prt in videogallery %}
                  {% set image = helper.image([
                    'id': prt.getId(),
                    'type': 'media',
                    'width': 400,
                    'strategy': 'w'
                  ]) %}
                  {% set video_url = helper.langUrl(['for':'media',  'slug':prt.getSlug()]) %}

                <div class="image inner img-p col-md-6">
                  <div class="video-container" style="background-image:url(/{{prt.anons}});">
                    <a data-fancybox data-type="iframe" class="video-link" data-src="/{{prt.video}}" href="/{{prt.video}}">
                   <span class="fa fa-play-circle-o"></span>
                  </a>
                  </div>
                </div>
                  {% endfor %}
                {% endif %}
              </div> 
            </div> <!-- tab-content -->
          </div>        
        </div>
      </div>

      <div class="col-md-4 sidebar">
        <h5 class="sidebar-title text-uppercase m-0"> <span class="glyphicon glyphicon-align-justify"></span> {{ title }}</h5>
        <div class="sidebar-item mb-4">
          <ul class="press-news">
          </ul>
        </div><!-- sidebar-item -->
      </div><!-- / sidebar -->

      <ul class=" pagination">
        {% if paginate.total_pages > 1 %}
          {{ partial('main/pagination', ['paginate':paginate] ) }}
        {% endif %}
      </ul>
    </div>
  </div>
</section>
 