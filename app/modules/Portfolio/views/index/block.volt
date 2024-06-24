{% if category %}    
  <ul class="list-inline"></ul>
    {% for cat in category %}          
      <li><a href="#">{{cat.getId()}} {{cat.getTitle()}}</a></li>
    {% endfor %}
  </ul>
{% endif %}

{% if portfolio %}
  <h2>{{helper.at('Portfolio')}}</h2>
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