<section class="section banner-inner">
  <article class="container">
  	<h1 class="page-title">{{ title }}</h1>
  </article>
</section>

<section class="section main-content">
  <article class="container">
    {{helper.widget('Breadcrumbs').breadcrumbs()}}
    <div class="full-text">
      {{ flash.output() }}
      {{ text }}
      <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d8474.703167362979!2d69.2441176678578!3d41.32495847935069!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1471853593788" width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="border:0" allowfullscreen></iframe>
      </div>
      {{ helper.widget('Webform').feedback() }}
    </div>
  </article>
</section>