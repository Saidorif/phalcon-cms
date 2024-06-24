{% if products %}
<div class="equipment_section_details">
    <h2>{{helper.translate('Equipment')}}</h2>
    <div class="descriptions">
       {% for item in products %}
       {% set link = helper.langUrl(['for':'product', 'category':item.getCategorySlug(), 'slug':item.getSlug()]) %}
        <a href="{{link}}">{{ item.getTitle() }}</a>
        {% endfor %}
        <a href="{{helper.currentUrl(constant('LANG'))}}">{{helper.translate('All catalog')}}</a>
    </div>
</div>
{% endif %}