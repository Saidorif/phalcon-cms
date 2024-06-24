<header class="body-bg">
  {{ partial('main/menu') }}
</header>

<section class="tenders">
  <div class="container">
    {{helper.widget('Breadcrumbs').breadcrumbs()}}      
    <div class="row">
      <div class="col-md-12 tender-posts">
        <header class="ov-h mb-1">
          <h1 class="content-title pull-left">{{title}}</h1>
          <a href="#" class="printDemo text-uppercase print-btn pull-right">
            <span class="glyphicon glyphicon-print"></span> {{ helper.translate('print version') }} 
          </a>
        </header>
        <div class="content">          
          {% if mediaResult %}            
            {% set image = helper.image([
              'id': mediaResult.getId(),
              'type': 'media',
              'width': 400,
              'strategy': 'w'
            ]) %}
            <ul class="list-inline views-foto">
              {% for photo in mediaResult.gallery %}
                <li class='col-md-3 mb-1'>
                  {% set image = helper.image([
                    'id': photo.getFileId(),
                    'type': 'media_gallery',
                    'width': 300,
                    'height': 230,
                    'strategy': 'a'
                  ]) %}
                  <a href="/{{photo.getFile()}}" data-fancybox="gallery"  class="single_image">{{ image.imageHTML() }}</a>
                </li>
              {% endfor %}
            </ul>   
          {% endif %}   
        </div>
      </div>
    </div>
  </div>
</section>