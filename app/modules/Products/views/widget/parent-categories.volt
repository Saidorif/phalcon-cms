{% if categories %}
    <section class="product">
        <div class="container">
            <div class="tabs-wrapper">
                <ul class="nav nav-tabs product-tabs" id="myTab" role="tablist">
                    {% for key,cat in categories %}
                        {% set cat_link = helper.langUrl(['for':'products', 'category':cat.getSlug()]) %}
                        <li class="nav-item shadow" role="presentation">
                            <a class="nav-link {% if key == 0 %}active{% endif %}" id="{{ cat.getSlug() }}-tab" data-toggle="tab" href="#{{ cat.getSlug() }}" role="tab" aria-controls="{{ cat.getSlug() }}" aria-selected="true">{{cat.getTitle()}}</a>
                        </li>
                    {% endfor %}
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                {% for key,cat in categories %}
                <div class="tab-pane fade {% if key == 0 %}show active{% endif %}" id="{{ cat.getSlug() }}" role="tabpanel" aria-labelledby="{{ cat.getSlug() }}-tab">
                    <div class="tab-items-wrapper">
                    {% if cat.getChildren()|length > 0 %}
                    {% for index,item in cat.getChildren() %}
                        <div class="tab-items">
                            <h5 class="title">{{ item.getTitle() }}</h5>
                            {% if item.getChildren()|length > 0 %}
                                <ul class="tab-items-list">
                                {% for index,c in item.getChildren() %}
                                    {% set link = helper.langUrl(['for':'products', 'category':c.getSlug()]) %}
                                    <li><a href="{{link}}">{{ c.getTitle() }}</a></li>
                                {% endfor %}
                                </ul>
                            {% else %}
                                {% if item.products|length > 0 %}
                                {% for product in item.products %}
                                {% set link = helper.langUrl(['for':'product', 'category':item.getSlug(), 'slug':product.getSlug()]) %}
                                <ul class="tab-items-list">
                                    <li><a href="{{link}}">{{ product.getTitle() }}</a></li>
                                </ul>
                                {% endfor %}
                                {% endif %}
                            {% endif %}
                            
                        </div>
                    {% endfor %}
                    {% else %}
                        {% if cat.products|length > 0 %}
                            <div class="tab-items">
                            <h5 class="title">{{ cat.getTitle() }}</h5>
                            <ul class="tab-items-list">
                            {% for product in cat.products %}
                            {% set link = helper.langUrl(['for':'product', 'category':cat.getSlug(), 'slug':product.getSlug()]) %}
                                <li><a href="{{link}}">{{ product.getTitle() }}</a></li>
                            {% endfor %}
                            </ul>
                            </div>
                        {% endif %}
                    {% endif %}
                    </div>
                </div>
                {% endfor %}
            </div>
        </div>
    </section>
{% endif %}