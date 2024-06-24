<section class="sms-page bg-white mt-5">
	<article class="container">
		{{helper.widget('Breadcrumbs').breadcrumbs()}}
  	<div class="full-text knowledge-text">
  		<div class="row">
	  		{% for item in entries %}
			{% set link = helper.langUrl(['for':'parents', 'slug':item.getSlug()]) %}
	  		<div class="col-sm-4">
	  			<div class="thumbnail p-3 shadow knows">
	  				<img src="/{{item.getImage()}}" alt="{{ item.getTitle() }}">
		          	<a href="{{ link }}" class="k-list"><h3>{{ item.getTitle() }}</h3> </a>
	  			</div>
	  		</div>
		    {% endfor %}
  		</div>
  	</div>
	</article>
</section>