<section class="section banner-inner">
    <article class="container">
    	<h1 class="page-title">{{ title }}</h1>
    </article>
</section>

<section class="section main-content">
	<article class="container">
		{{helper.widget('Breadcrumbs').breadcrumbs()}}
  	<div class="full-text">
  		{% for item in entries %}
        {% set image = helper.image(['id':item.getId(),'type':'employee']) %}
        {% if image.isExists() %} <img src="{{ image.originalRelPath() }}"> {% endif %}	       
          {{ item.getTitle() }}	            
          {{ item.getJob() }}
          {{ item.getPhone() }}
          {{ item.getEmail() }}
          {{ item.getText() }}		        
	    {% endfor %}
  	</div>
	</article>
</section>