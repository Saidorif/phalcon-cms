{% if media %}
<div class="video_gelery">
  <div class="video_gelery_in">
    <div class="title">{{helper.translate('Reports from places of events')}}</div>
    <a class="archive" href="#">{{helper.translate('Archive events')}}</a>
    <div class="galery_my">
      <div class="galery_in"> 
        <div class="view-property">
          {% for index, prt in media %}   
          
          {% set url = helper.langUrl(['for':'media', 'category':prt.getCategorySlug(), 'slug':prt.getSlug()]) %}
           
          <div class="views-row views-row-{{index + 1}}" style="background-image:url(/{{prt.getAnons()}});">
            <span class="sold">
              <img src="/assets/img/icons/icon-camera.svg">
            </span>
            <div class="inner_bg">
              <div class="inline">               
                <h5>{{prt.getTitle()}}</h5>
                <a href="{{ url }}" class="readmore">{{helper.translate('Show')}}</a>
              </div>  
            </div>  
          </div> 
          
          {% endfor %}
        </div>
      </div>
    </div>
  </div>
</div>
{% endif %}
<div class="clear_both"></div>