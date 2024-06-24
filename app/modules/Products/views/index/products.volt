<section class="section main-content">
    <article class="container">
        {{helper.widget('Breadcrumbs').breadcrumbs()}}
        <h1 class="page-title">{{ title }}</h1>
        <div class="catalog">
            {% if category %}
                {% for index, cat in category %}
                    {% set cat_link = helper.langUrl(['for':'products', 'category':cat.getSlug()]) %}
                    <div class="cat-items text-center the-products">
                        <div class="the-item">
                            <div class="prod-item">
                                <img src="/{{ cat.getFoto() }}" alt="" class="img-fluid">
                            </div>
                        </div>
                        <h5 class="title"><a href="{{cat_link}}">{{cat.getTitle()}}</a></h5>
                    </div>
                {% endfor %}
            {% endif %}
        </div>
    </article>
</section>