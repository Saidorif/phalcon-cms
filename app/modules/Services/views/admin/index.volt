<!--controls-->
<div class="ui segment">

    <a href="{{ url.get() }}services/admin/add" class="ui button positive">
        <i class="icon plus"></i> {{ helper.at('Add New') }}
    </a>

    <a href="{{ url.get() }}services/category" class="ui button">
        <i class="icon list"></i> {{ helper.at('Services categories') }}
    </a>

</div>
<!--/end controls-->

<div class="ui tabular menu">
    <a href="{{ url.get() }}services/admin?lang={{ constant('LANG') }}"
       class="item{% if not category_id %} active{% endif %}">{{ helper.at('All') }}</a>
</div>

{% if services %}

    <table class="ui table very compact celled">
        <thead>
        <tr>
            <th style="width: 100px"></th>
            <th>{{ helper.at('Title') }}</th>
            <th>{{ helper.at('Category') }}</th>
            
        </tr>
        </thead>
        <tbody>
        {% for item in services %}
            {% set link = url.get() ~ "services/admin/edit/" ~ item.getId() %}
            <tr>
                <td><a href="{{ link }}?lang={{ constant('LANG') }}" class="mini ui icon button"><i
                                class="icon edit"></i> id = {{ item.getId() }}</a></td>
                <td><a href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getTitle() }}</a></td>
                <td>{{ item.getTypeTitle() }}</td>                
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% else %}
    <p>{{ helper.at('Entries not found') }}</p>
{% endif %}

