<section class="section banner-inner">
    <article class="container">
    	<h1 class="page-title">{{ helper.at('Search') }}</h1>
    </article>
</section>
<section class="section main-content">
    <article class="container">
      <div class="inline-block">		
				{{ helper.widget('Search').search() }}				
				<h2>{{helper.translate('Search results')}}</h2>
				{% if searchResult %}
					<ul class="nav nav-pills nav-tabs search-tabs">
					  <li role="presentation" class="active">
					  	<a href="#pages" data-toggle="tab">{{ helper.translate('Pages') }} <span class="badge">{{resultCount['pageCount']}}</span></a>
					  </li>
					  <li role="presentation">
					  	<a href="#publications" data-toggle="tab">{{ helper.translate('Publications') }} <span class="badge">{{resultCount['publicationCount']}}</span></a>
					  </li>
					  <li role="presentation">
					  	<a href="#products" data-toggle="tab">{{ helper.translate('Products') }} <span class="badge">{{resultCount['productCount']}}</span></a>
					  </li>
					</ul>
					<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="pages">
							<ul class="search-results">
						    {% for item in searchResult['pageRes'] %}
						      {% set url = helper.langUrl(['for':'page', 'slug':item['slug']]) %}
									<li><a href="{{url}}">{{item['title']}}</a><p>{{item['text']}}</p></li>
						    {% endfor %}
					    </ul>
				    </div>
				    <div role="tabpanel" class="tab-pane" id="publications">
				    	<ul class="search-results">
				      	{% for item in searchResult['publRes'] %}
				      		{% set url = helper.langUrl(['for':'publication', 'type':item['type'], 'slug':item['slug']]) %}	      		
									<li><a href="{{url}}">{{item['title']}}</a><div class="date">{{item['date']}}</div><p>{{item['text']}}</p></li>
				        {% endfor %}
				      </ul>		    	
				    </div>
				    <div role="tabpanel" class="tab-pane" id="products">
			        <div class="row">
			    			<ul class="search-results">
			      			{% for item in searchResult['prodRes'] %}
			      				{% set url = helper.langUrl(['for':'product', 'category':item['category'], 'slug':item['slug']]) %}
				      			<li class="col-sm-10 col-md-10 ">
				      				<div class="media">
											  <div class="media-left">
											    <a href="{{url}}">
											      <img class="media-object" src="/{{ item['anons'] }}" alt="{{item['title']}}" width="150">
											    </a>
											  </div>
											  <div class="media-body">
											    <h4 class="media-heading"><a href="{{url}}">{{item['title']}}</a></h4>
											    <p>{{item['text']}}</p>
											  </div>
											</div>				      				
				      			</li>
									{% endfor %}
			        	</ul>  
			       	</div>   	
			    	</div>		  		    
					</div>  		
        {% endif %}     
      </div>
    </article>
</section>