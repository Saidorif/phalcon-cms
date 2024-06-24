<!--controls-->
<div class="ui segment">

    <a href="{{ url.get() }}portfolio/admin?lang={{ constant('LANG') }}" class="ui button">
        <i class="icon left arrow"></i> {{helper.at('Manage Portfolio')}}
    </a>

    <a href="{{ url.get() }}portfolio/category/add" class="ui button blue">
        <i class="icon plus"></i> {{helper.at('Add New')}}
    </a>

</div>
<!--/end controls-->

<table class="ui table very compact celled selectable">
    <thead>
    <tr>
        <th style="width: 100px"></th>
        <th>{{helper.at('Title')}}</th>
        <th>{{helper.at('Sort')}}</th>
    </tr>
    </thead>
    <tbody>
    {% for item in entries %}
        {% set link = url.get() ~ "portfolio/category/edit/" ~ item.getId() %}
        <tr>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}" class="mini ui icon button"><i class="icon edit"></i>
                    id = {{ item.getId() }}</a></td>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getTitle() }}</a></td>
            <td>{{ item.getSort() }}</td>
        </tr>
    {% endfor %}
    </tbody>
</table>
