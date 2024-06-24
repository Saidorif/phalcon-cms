{% if entries %}
  
  {% for item in entries %}
		<div class="item">
			<img src="{{ item.getFoto() }}" alt="{{item.getTitle()}}">
		</div>
  {% endfor %}   
 
{% endif %}
