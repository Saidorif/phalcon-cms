<section class="section banner-inner">
  <article class="container">
		<h1 class="page-title">{{ title }}</h1>
  </article>
</section>

<section class="section main-content">
	<article class="container">
		{{helper.widget('Breadcrumbs').breadcrumbs()}}
    	<div class="full-text">
    		{{ text }}
    	</div>
	</article>
</section>