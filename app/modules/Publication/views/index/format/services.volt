{% set image = helper.image([
  'id': item.p.getId(),
  'type': 'publication',
  'width': 570,
  'height': 245,
  'strategy': 'a'
]) %}
{% set link = helper.langUrl(['for':'publication', 'type':item.t_slug, 'slug':item.p.getSlug()]) %}
{% if image.isExists() %}{% set imageExists = true %}{% else %}{% set imageExists = false %}{% endif %}
  <div class="col-md-6 wow fadeInLeft">
    <div class="news-post text-md-left">
      {% if imageExists %}
        {{ image.imageHTML() }}
      {% endif %}
      <div class="box-md">
        <div class="box-left">
          {% if item.p.getTypeDisplayDate() %}
            <time class="news-post-meta" datetime="{{ item.p.getDate('d.m.Y') }}">{{ item.p.getDate('d') }}<span>{{ item.p.getDate('m Y') }}</span></time>
          {% endif %}
        </div>
        <div class="box-body inset-1">
          <h6 class="text-bold"><a href="{{ link }}">{{ item.title }}</a></h6>
          <p class="text-regular">{{ helper.announce(item.text, 300) }}</p>
        </div>
      </div>
    </div>
  </div>