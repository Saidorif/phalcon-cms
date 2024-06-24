{% if the_item %}
<section class="sms-page bg-white mt-5">
    <article class="container">
        <ol vocab="http://schema.org/" typeof="BreadcrumbList" class="breadcrumb">
            <li property="itemListElement" typeof="ListItem">
                <a href="/" property="item" typeof="WebPage">
                    <span property="name">{{helper.translate('Home')}}</span>
                </a>
                <meta property="position" content="1">
            </li>
            <li property="itemListElement" typeof="ListItem">
                <a href="{{helper.currentUrl(constant('LANG'))}}knowledges" property="item" typeof="WebPage">
                    <span property="name">{{helper.translate('Knowledge')}}</span>
                </a>
                <meta property="position" content="2">
            </li>
            <li property="itemListElement" typeof="ListItem">
                <a href="{{helper.currentUrl(constant('LANG'))}}knowledges/{{ entries.parent.getSlug() }}" property="item" typeof="WebPage">
                    <span property="name">{{ entries.parent.getTitle() }}</span>
                </a>
                <meta property="position" content="3">
            </li>
            <li property="itemListElement" typeof="ListItem">
                <a href="{{helper.currentUrl(constant('LANG'))}}knowledges/{{ entries.parent.getSlug() }}/{{ the_item.parent.getSlug() }}" property="item" typeof="WebPage">
                    <span property="name">{{ the_item.parent.getTitle() }}</span>
                </a>
                <meta property="position" content="4">
            </li>
            <li property="itemListElement" typeof="ListItem" class="active"><span property="name">{{ the_item.getTitle() }} </span>
                <meta property="position" content="5">
            </li>
        </ol>
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
                        <ul class="list-disc child_{{child.getId()}} {% if entries.parent.getSlug() != child.getSlug() %} hidden {% endif %}">
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
                    <h1>{{ the_item.getTitle() }}</h1>
                    <div class="k-text">{{the_item.getText()}}</div>
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
{% endif %}