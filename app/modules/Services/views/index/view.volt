<header class="body-bg">
  {{ partial('main/menu') }}
</header>

<section class="tenders">
  <div class="container">
    {{helper.widget('Breadcrumbs').breadcrumbs('portfolio')}}      
    <div class="row">
      <div class="col-md-8 tender-posts">
        <header class="ov-h mb-1">
          <h1 class="content-title pull-left">{{title}}</h1>
          <a href="#" class="printDemo text-uppercase print-btn pull-right">
            <span class="glyphicon glyphicon-print"></span> {{ helper.translate('print version') }} 
          </a>
        </header>
        <div class="content">
          {% if portfolioResult %}

            {% for partner in portfolioResult %}
              {% if partner.getAnons() %}
              <div class="media">
                <div class="media-left">
                  <img class="media-object" width="150" height="auto" src="/{{ partner.getAnons() }}">
                </div>
                <div class="media-body">
                  <h4 class="media-heading">{{ partner.getTitle() }}</h4>
                  {{ partner.getText() }}
                </div>
              </div>
              {% else %}
                  {{ partner.getText() }}
              {% endif %}
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
