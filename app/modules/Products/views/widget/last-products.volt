{% if products %} 
  <div class="col-md-12">
    {% for item in products %}
      <style>
      .news-post img {max-width:100%; height:auto; }
      </style>
      <div class="col-sm-3">
        <img src="/{{item.photos[0].getFile()}}" class="img-reponsive">
        {% set image = helper.image([
          'id': item.getId(),
          'type': 'products',
          'width': 350,
          'height': 200,
          'strategy': 'a'
        ]) %}
        {% set link = helper.langUrl(['for':'product', 'category':item.getCategorySlug(), 'slug':item.getSlug()]) %}
        {% if image.isExists() %}{% set imageExists = true %}{% else %}{% set imageExists = false %}{% endif %}
        <div class="news-post text-center">
          {% if imageExists %}
            {{ image.imageHTML() }}
          {% endif %}
          <h4 class="text-uppercase"><a href="{{ link }}">{{ item.getTitle() }}</a></h4>
          <p class="text-danger"><span class="btn btn-danger">{{ item.getPrice() }} UZS</span></p>
        </div>                        
      </div>
    {% endfor %}
  </div>
{% endif %}