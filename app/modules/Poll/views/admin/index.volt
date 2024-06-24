<div class="ui segment">
    <a href="{{ url.get() }}poll/admin/add?lang={{ constant('LANG') }}" class="ui positive button"><i class="add icon"></i> {{ helper.at('Add New') }}</a>
</div>

<table class="ui table very compact celled">
    <thead>
    <tr>
        <th style="width: 100px"></th>
        <th>{{ helper.at('Questions') }}</th>       
    </tr>
    </thead>
    <tbody>
    {% for item in entries %}
        {% set link = url.get() ~ 'poll/admin/edit/' ~ item.getId() %}
        <tr>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}" class="mini ui icon button"><i class="icon edit"></i>
                    id = {{ item.getId() }}</a></td>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getTitle() }}</a></td>
        </tr>
    {% endfor %}
    </tbody>
</table>
