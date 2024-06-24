<section class="sms-page bg-white mt-5">
    <article class="container">
        {{helper.widget('Breadcrumbs').breadcrumbs()}}
        <div class="full-text knowledge-text">
            <div class="row">
                <div class="col-sm-4">
                    {% if parents %}
                        <ul class="list-group">
                            {% for child in parents %}
                                {% set anchor = helper.langUrl(['for':'parents', 'slug':child.getSlug()]) %}
                                <li class="list-group-item">
                                    <a href="#" class="lgil dropd parent-title" data-select=".child_{{child.getId()}}">
                                        {{child.getTitle()}}
                                        <span class="mybadge">{{child.getCats()|length}}</span>
                                    </a>
                                    {% if child.getCats() AND child.getCats()|length > 0 %}
                                        <ul class="list-disc child_{{child.getId()}} {% if entries.getSlug() != child.getSlug() %} hidden {% endif %}">
                                            {% for ch in child.getCats() %}
                                                {% set href = helper.langUrl(['for':'kview', 'parent':child.getSlug(), 'slug':ch.getSlug()]) %}
                                                <li><a href="{{href}}" class="lgil child-title">{{ ch.getTitle() }}</a></li>
                                            {% endfor %}
                                        </ul>
                                    {% endif %}
                                </li>
                            {% endfor %}
                        </ul>
                    {% endif %}
                </div>
                <div class="col-sm-8">
                    {% if entries %}
                        <h1>{{ entries.getTitle() }}</h1>
                        <ul class="list-group p-1">
                            {% if entries.getCats() %}
                            {% for item in entries.getCats() %}
                                {% set link = helper.langUrl(['for':'kview', 'parent':entries.getSlug(), 'slug':item.getSlug()]) %}
                                <li class="list-inline">
                                    {% if item.getCats() AND item.getCats()|length > 0 %}
                                        <a href="#" class="dropd" data-select=".child_{{item.getId()}}"> - {{ item.getTitle() }}</a>
                                        <ul class="list-group p-1 child_{{item.getId()}} hidden">
                                            {% for ch in item.getCats() %}
                                                {% set hr = helper.langUrl(['for':'kview', 'parent':item.getSlug(), 'slug':ch.getSlug()]) %}
                                                <li class="list-inline">
                                                    <a href="{{ hr }}"> - {{ ch.getTitle() }}</a>
                                                </li>
                                            {% endfor %}
                                        </ul>
                                    {% else %}
                                        <a href="{{link}}"> - {{ item.getTitle() }}</a>
                                    {% endif %}
                                </li>
                            {% endfor %}
                            {% endif %}
                        </ul>
                    {% endif %}
                </div>
            </div>
        </div>
    </article>
</section>

<script>
    $(document).ready(function(){
        $('.dropd').on('click',function(e){
            e.preventDefault();
            let ul_list = $($(this).attr('data-select'));
            ul_list.toggleClass('hidden');
        });
    });
</script>