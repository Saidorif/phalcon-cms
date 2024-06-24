{% if entries %}  
	{% for item in entries %}     
	  <div class="col-md-12">               
	    <img src="/{{ item.p.foto }}" class="img-circle" width="100" alt="{{item.title}}">  
	    <div class="bg">
	      <h3>{{ item.title }}</h3>
	      <p><strong>{{ item.job }}</strong></p>
	      <p>{{ item.text }}</p>
	    </div>
	  </div>
	{% endfor %} 
{% endif %}