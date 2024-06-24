<!--controls-->
<div class="ui segment">

    <a href="{{ url.get() }}portfolio/admin/add" class="ui button blue">
        <i class="icon plus"></i> {{ helper.at('Add New') }}
    </a>

    <a href="{{ url.get() }}portfolio/category" class="ui button">
        <i class="icon list"></i> {{ helper.at('Portfolio categories') }}
    </a>

</div>
<!--/end controls-->

<div class="ui tabular menu">
    <a href="{{ url.get() }}portfolio/admin?lang={{ constant('LANG') }}"
       class="item{% if not category_id %} active{% endif %}">{{ helper.at('All') }}</a>
</div>

{% if portfolio %}

    <table class="ui table very compact celled selectable">
        <thead>
        <tr>
            <th style="width: 100px"></th>
            <th>{{ helper.at('Title') }}</th>
            <th style="width: 50px;">{{ helper.at('Image') }}</th>
            <th>{{ helper.at('Portfolio categories') }}</th>
            <th>{{ helper.at('Url') }}</th>
        </tr>
        </thead>
        <tbody>
        {% for item in portfolio %}
            {% set link = url.get() ~ "portfolio/admin/edit/" ~ item.getId() %}
            {% set image = helper.image(['id':item.getId(),'type':'portfolio','width':50]) %}
            <tr>
                <td><a href="{{ link }}?lang={{ constant('LANG') }}" class="mini ui icon button"><i
                                class="icon edit"></i> id = {{ item.getId() }}</a></td>
                <td><a href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getTitle() }}</a></td>
                <td><a href="{{ link }}?lang={{ constant('LANG') }}">{% if image.isExists() %}{{ image.imageHTML() }}{% endif %}</a></td>
                <td>{{ item.getTypeTitle() }}</td>
                {% set url = helper.langUrl(['for':'portfolio', 'slug':item.getSlug()]) %}
                <td><a href="{{url}}" target="_blank">{{url}}</a></td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% else %}
    <p>{{ helper.at('Entries not found') }}</p>
{% endif %}
