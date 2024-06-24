<section class="sms-page bg-white mt-5">
	<article class="container">
		<ol vocab="http://schema.org/" typeof="BreadcrumbList" class="breadcrumb">
		    <li property="itemListElement" typeof="ListItem">
		    	<a href="/" property="item" typeof="WebPage">
		    		<span property="name">{{helper.translate('Home')}}</span>
		    	</a>
		        <meta property="position" content="1">
		    </li>
		    <li property="itemListElement" typeof="ListItem">
		    	<a href="{{helper.currentUrl(constant('LANG'))}}knowledges" property="item" typeof="WebPage">
		    		<span property="name">{{helper.translate('Knowledge')}}</span>
		    	</a>
		        <meta property="position" content="2">
		    </li>
		    <li property="itemListElement" typeof="ListItem">
		    	<a href="{{helper.currentUrl(constant('LANG'))}}knowledges/{{ entries.parent.getSlug() }}" property="item" typeof="WebPage">
			    	<span property="name">{{ entries.parent.getTitle() }}</span>
			    </a>
		        <meta property="position" content="3">
		    </li>
		    <li property="itemListElement" typeof="ListItem" class="active"><span property="name">{{ entries.getTitle() }} </span>
		        <meta property="position" content="4">
		    </li>
		</ol>
  	<div class="full-text knowledge-text">
  		<div class="row">
  			<div class="col-sm-4">
  				{% if parents %}
  				<ul class="list-group">
  					{% for child in parents %}
  					{% set anchor = helper.langUrl(['for':'parents', 'slug':child.getSlug()]) %}
  					<li class="list-group-item">
  						<a href="#" class="lgil dropd parent-title" data-select=".child_{{child.getId()}}">
  							{{child.getTitle()}} 
  							<span class="mybadge">{{child.getCats()|length}}</span>
  						</a>
						{% if child.getCats() AND child.getCats()|length > 0 %}
						<ul class="list-disc child_{{child.getId()}} {% if entries.parent.getSlug() != child.getSlug() %} hidden {% endif %}">
						{% for ch in child.getCats() %}
						{% set href = helper.langUrl(['for':'kview', 'parent':child.getSlug(), 'slug':ch.getSlug()]) %}
							<li><a href="{{href}}" class="lgil child-title">{{ ch.getTitle() }}</a></li>
						{% endfor %}
						</ul>
						{% endif %}
  					</li>
  					{% endfor %}
  				</ul>
  				{% endif %}
  			</div>
  			<div class="col-sm-8">
		  		{% if entries %}
		          	<h1>{{ entries.getTitle() }}</h1>
						{% if entries.getCats() AND entries.getCats()|length > 0 %}
					<ul class="list-group p-1">
						{% for item in entries.getCats() %}
						{% set link = helper.langUrl(['for':'kshow', 'parent':entries.parent.getSlug(), 'slug':entries.getSlug(), 'link':item.getSlug()]) %}
						<li class="list-inline">
							<a href="{{ link }}"> - {{ item.getTitle() }}</a>
						</li>
						{% endfor %}
					</ul>
					{% endif %}
			    {% endif %}
			    <div class="k-text">{{entries.getText()}}</div>
  			</div>
  		</div>
  	</div>
	</article>
</section>

<script>
$(document).ready(function(){
	$('.dropd').on('click',function(e){
		e.preventDefault();
		let ul_list = $($(this).attr('data-select'));
		ul_list.toggleClass('hidden');
	});
});
</script>