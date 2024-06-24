<!--controls-->
<div class="ui segment">

    <a href="{{ url.get() }}publication/admin?lang={{ constant('LANG') }}" class="ui button">
        <i class="icon left arrow"></i> {{helper.at('Manage Publications')}}
    </a>

    <a href="{{ url.get() }}publication/type/add" class="ui button blue">
        <i class="icon plus"></i> {{helper.at('Add New')}}
    </a>

</div>
<!--/end controls-->

<table class="ui table very compact celled selectable">
    <thead>
    <tr>
        <th style="width: 100px"></th>
        <th>{{helper.at('Title')}}</th>
        <th>URL</th>
        <th>{{helper.at('Display Layout')}}</th>
        <th>{{helper.at('Thumbnail Inside')}}</th>
    </tr>
    </thead>
    <tbody>
    {% for item in entries %}
        {% set link = url.get() ~ "publication/type/edit/" ~ item.getId() %}
        <tr>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}" class="mini ui icon button"><i class="icon edit"></i>
                    id = {{ item.getId() }}</a></td>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getTitle() }}</a></td>

            {% set pub_link = helper.langUrl(['for':'publications', 'type': item.getSlug()]) %}
            <td><a href="{{ pub_link }}" target="_blank">{{ pub_link }}</a></td>
            <td>{{ item.getFormatTitle() }}</td>
            <td>{% if item.getDisplayDate() %}<i class="icon checkmark green"></i>{% endif %}</td>
        </tr>
    {% endfor %}
    </tbody>
</table>
