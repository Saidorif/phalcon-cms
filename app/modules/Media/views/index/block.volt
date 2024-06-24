{% if media %}
  {% for prt in media %} 
    {% set image = helper.image([
      'id': prt.getId(),
      'type': 'media',      
      'width': 1000,
      'height': 300,
      'strategy': 'a'
    ],[
    'class': 'card-img-top img-fluid'
    ]) %}
  {% set url = helper.langUrl(['for':'media',  'slug':prt.getSlug()]) %}
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card photoItem">
        <a data-fancybox="gallery" data-caption="" href="{{prt.getAnons()}} ">
          <span class="cover"></span>
          {% if image.isExists() %}
            {{ image.imageHTML() }}
          {% endif %}  
        </a>                
      </div>
    </div>   
  {% endfor %} 
{% endif %}