{% if entries %}
  <div class="faq-panel">
    <div class="panel-group theme-accordion" id="accordion">
      {% for index, item in entries %}  
        <div class="panel">
          <div class="panel-heading {% if index == 0 %}active-panel{% endif %}">
            <h6 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{index}}">{{ item.title }}</a>
            </h6>
          </div>
          <div id="collapse{{index}}" class="panel-collapse collapse {% if index == 0 %}in{% endif %}">
            <div class="panel-body">
              <p>{{ item.text }}</p>
            </div>
          </div>
        </div> <!-- /panel 1 -->
      {% endfor %}
    </div> <!-- end #accordion -->
  </div> 
{% endif %}
