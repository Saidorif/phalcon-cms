<section class="section banner-inner">
  <article class="container">
    <h1 class="page-title">{{ title }}</h1>
  </article>
</section>

<section class="section main-content">
  <article class="container">
    {{helper.widget('Breadcrumbs').breadcrumbs()}}
    <div class="publications {{ format }}">            
      {% if paginate.total_items > 0 %}
        {% for index, item in paginate.items %}
          {{ helper.modulePartial('index/format/' ~ format, ['item':item]) }}
        {% endfor %}
      {% else %}
        <p>{{ helper.translate('Entries not found') }}</p>
      {% endif %}
    </div>

    {% if paginate.total_pages > 1 %}
      <div class="pagination">
        {{ partial('main/pagination', ['paginate':paginate] ) }}
      </div>
    {% endif %}
  </article>
</section>        