<section class="section banner-inner">
  <article class="container">
    <h1 class="page-title">{{ publicationResult.title }}</h1>
  </article>
</section>

<section class="section main-content">
  <article class="container">
    {{ helper.widget('Breadcrumbs').breadcrumbs('publications', 'type') }}
    {% if helper.isAdminSession() %}
      <p style="font-weight: bold;font-size:120%;">
        <a class="noajax" href="{{ url.get() }}publication/admin/edit/{{ publicationResult.p.getId() }}?lang={{ constant('LANG') }}">{{ helper.at('Edit publication') }}</a>
      </p>
    {% endif %}    
    {% if publicationResult.p.preview_inner %}
      {% set image = helper.image([
      'id': publicationResult.p.getId(),
      'type': 'publication',
      'width': 800,
      'strategy': 'w'
      ]) %}
      <div class="image inner">
        {{ image.imageHTML() }}
      </div>
    {% endif %}
      {% if publicationResult.p.getTypeDisplayDate() %}
      <div class="date">{{ publicationResult.p.getDate('d.m.Y') }}</div>
    {% endif %}
    <div class="full-text">
        {{ publicationResult.text }}
    </div>
    <a href="{{ helper.langUrl(['for':'publications','type':publicationResult.t_slug]) }}" class="back">&larr; {{ helper.translate('Back to publications list') }}</a>
  </article>
</section> 