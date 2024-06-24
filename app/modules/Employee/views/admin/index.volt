<div class="ui segment">
    <a href="{{ url.get() }}employee/admin/add?lang={{ constant('LANG') }}" class="ui blue button"><i
                class="add icon"></i> {{ helper.at('Add New') }}</a>
</div>

<table class="ui table very compact celled selectable">
    <thead>
    <tr>
        <th style="width: 100px"></th>
        <th>{{ helper.at('Full name') }}</th>
        <th style="width: 160px">{{ helper.at('Job') }}</th>
        <th>{{ helper.at('Dop. info') }}</th>
    </tr>
    </thead>
    <tbody>
    {% for item in entries %}
        {% set link = url.get() ~ 'employee/admin/edit/' ~ item.getId() %}
        {% set image = helper.image(['id':item.getId(),'type':'employee','width':50]) %}
        <tr>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}" class="mini ui icon button"><i class="icon edit"></i>
                    id = {{ item.getId() }}</a></td>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getTitle() }}</a></td>
            <td>{{ item.getJob() }}</td>
            <td>{{ item.getText() }}</td>
        </tr>
    {% endfor %}
    </tbody>
</table>
