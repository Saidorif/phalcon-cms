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
          {% if category %}    
            <ul class="list-inline"></ul>
              {% for cat in category %}          
                <li><a href="#">{{cat.getId()}} {{cat.getTitle()}}</a></li>
              {% endfor %}
            </ul>
          {% endif %}

          {% if portfolio %}
            {% for prt in portfolio %}  
              {{prt.getAnons()}}
              {% set image = helper.image([
                'id': prt.getId(),
                'type': 'portfolio',
                'width': 400,
                'strategy': 'w'
              ]) %}
            {% set url = helper.langUrl(['for':'portfolio',  'slug':prt.getSlug()]) %}
              <div class="image inner">
                {% if image.isExists() %}
                  {{ image.imageHTML() }}
                {% endif %}                   
              </div> 
              <a href="#">{{prt.getCategoryId()}} {{prt.getTitle()}}</a>
              {% for gal in prt.gallery %}
                <p> {{gal.getFile()}}</p>   
              {% endfor %}    
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



