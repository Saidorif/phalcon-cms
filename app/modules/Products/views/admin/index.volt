<!--controls-->
<div class="ui segment">

    <a href="{{ url.get() }}products/admin/add" class="ui button blue">
        <i class="icon plus"></i> {{ helper.at('Add New') }}
    </a>

    <a href="{{ url.get() }}products/category" class="ui button">
        <i class="icon list"></i> {{ helper.at('Category') }}
    </a>

</div>
<!--/end controls-->

<div class="ui tabular menu" style="overflow-x: scroll;overflow-y: hidden;">
    <a href="{{ url.get() }}products/admin?lang={{ constant('LANG') }}"
       class="item{% if not category_id %} active{% endif %}">{{ helper.at('All') }}</a>
    {% for category_el in categories %}
        <a href="{{ url(['for':'products_admin','category':category_el.getSlug()]) }}?lang={{ constant('LANG') }}"
           class="item{% if category_el.getId() == category_id %} active{% endif %}">
            {{ category_el.getTitle() }}
        </a>
    {% endfor %}
</div>

{% if paginate.total_items > 0 %}

    <table class="ui table very compact celled selectable">
        <thead>
        <tr>
            <th style="width: 100px"></th>
            <th>{{ helper.at('Title') }}</th>
            <th style="width: 50px;">{{ helper.at('Image') }}</th>
            <th>{{ helper.at('Category') }}</th>
            <th>{{ helper.at('Url') }}</th>
        </tr>
        </thead>
        <tbody>
        {% for item in paginate.items %}
            {% set link = url.get() ~ "products/admin/edit/" ~ item.getId() %}
            {% set image = helper.image(['id':item.getId(),'type':'products','width':50]) %}
            <tr>
                <td><a href="{{ link }}?lang={{ constant('LANG') }}" class="mini ui icon button"><i
                                class="icon edit"></i> id = {{ item.getId() }}</a></td>
                <td><a href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getTitle() }}</a></td>
                <td><a href="{{ link }}?lang={{ constant('LANG') }}">{% if image.isExists() %}{{ image.imageHTML() }}{% endif %}</a></td>
                <td>{{ item.getCategoryTitle() }}</td>
                {% set url = helper.langUrl(['for':'product', 'category':item.getCategorySlug(), 'slug':item.getSlug()]) %}
                <td><a href="{{ url }}" target="_blank">{{ url }}</a></td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% else %}
    <p>{{ helper.at('Entries not found') }}</p>
{% endif %}

{% if paginate.total_pages > 1 %}
    <div class="pagination">
        {{ partial('admin/pagination', ['paginate':paginate] ) }}
    </div>
{% endif %}
