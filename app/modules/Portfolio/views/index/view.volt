{% if portfolioResult %}
  <section class="section banner-inner">
    <article class="container">
      <h1 class="page-title">{{ portfolioResult.getTitle() }}</h1>
    </article>
  </section>

  <section class="section main-content">
    <article class="container">
      {{helper.widget('Breadcrumbs').breadcrumbs('portfolio')}}
      {% if helper.isAdminSession() %}
        <p style="font-weight: bold;font-size:120%;">
          <a class="noajax" href="{{ url.get() }}portfolio/admin/edit/{{ portfolioResult.getId() }}?lang={{ constant('LANG') }}">{{ helper.at('Edit portfolio') }}</a>
        </p>
      {% endif %}  
      {% set image = helper.image([
        'id': portfolioResult.getId(),
        'type': 'portfolio',
        'width': 400,
        'strategy': 'w'
      ]) %}
      <div class="image inner">
        {% if image.isExists() %}
          {{ image.imageHTML() }}
        {% endif %}                   
      </div> 
      <ul class="list-inline">
        {% for photo in portfolioResult.gallery %}
          <li>
            {% set image = helper.image([
              'id': photo.getFileId(),
              'type': 'portfolio_gallery',
              'width': 300,
              'height': 220,
              'strategy': 'a'
            ]) %}
            <a href="/{{photo.getFile()}}" data-fancybox-group="gallery" class="fancybox">{{ image.imageHTML() }}</a>
          </li>
        {% endfor %}
      </ul>
      <div class="full-text">{{ portfolioResult.getText() }}</div>      
    </article>
  </section> 
{% endif %}