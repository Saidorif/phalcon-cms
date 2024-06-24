<div class="ui segment">
    <a href="{{ url.get() }}partner/admin/add?lang={{ constant('LANG') }}" class="ui blue button"><i
                class="add icon"></i> {{ helper.at('Add New') }}</a>
</div>

<table class="ui table very compact celled selectable">
    <thead>
    <tr>
        <th style="width: 100px"></th>
        <th>{{ helper.at('Company name') }}</th>
        <th style="width: 100px;">{{ helper.at('Image') }}</th>
    </tr>
    </thead>
    <tbody>
    {% for item in entries %}
        {% set link = url.get() ~ 'partner/admin/edit/' ~ item.getId() %}

        <tr>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}" class="mini ui icon button"><i class="icon edit"></i>
                    id = {{ item.getId() }}</a></td>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getTitle() }}</a></td>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}"><img src="/{{item.getFoto()}}" alt="" width="100" height="auto"></a></td>

        </tr>
    {% endfor %}
    </tbody>
</table>
