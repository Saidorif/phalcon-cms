<section class="section main-content">
    <article class="container">
        {{helper.widget('Breadcrumbs').breadcrumbs()}}
        <h1 class="page-title">{{ title }}</h1>
        <div class="catalog">
            {% if categories|length > 0 %}
                <ul class="ss-cat">
                {% for cat in categories %}
                    {% set href = helper.langUrl(['for':'products', 'category':cat.getSlug()]) %}
                    <li class="ss-cat-item">
                        <a href="{{href}}" class="ss-cat-link">{{ cat.getTitle() }}</a>
                    </li>
                {% endfor %}
                </ul>
            {% endif %}
            {% if paginate.total_items > 0 %}
                {% for index, item in paginate.items %}
                    {% set link = helper.langUrl(['for':'product', 'category':item.t_slug, 'slug':item.p.getSlug()]) %}
                    <div class="cat-items text-center the-products">
                        <div class="the-item">
                            <div class="prod-item">
                                <img src="/{{ item.p.getAnons() }}" alt="{{ item.p.getTitle()|escape_attr }}" class="img-fluid">
                            </div>
                        </div>
                        <h5 class="title"><a href="{{link}}">{{ item.p.getTitle() }}</a></h5>
                        <h5 class="title"><span>{{ item.p.getPrice() }} UZS</span></h5>
                    </div>
                {% endfor %}
            {% endif %}
        </div>
        {% if paginate.total_pages > 1 %}
            <div class="pagination">
                {{ partial('main/pagination', ['paginate':paginate] ) }}
            </div>
        {% endif %}

        </div>
    </article>
</section>
