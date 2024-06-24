<!--controls-->
<div class="ui segment">

    <a href="{{ url.get() }}media/admin?lang={{ constant('LANG') }}" class="ui button">
        <i class="icon left arrow"></i> {{helper.at('Manage Media')}}
    </a>

    <a href="{{ url.get() }}media/category/add" class="ui button positive">
        <i class="icon plus"></i> {{helper.at('Add New')}}
    </a>

</div>
<!--/end controls-->

<table class="ui table very compact celled">
    <thead>
    <tr>
        <th style="width: 100px"></th>
        <th>{{helper.at('Title')}}</th>        
        <th>{{helper.at('Sort')}}</th>        
    </tr>
    </thead>
    <tbody>
    {% for item in entries %}
        {% set link = url.get() ~ "media/category/edit/" ~ item.getId() %}
        <tr>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}" class="mini ui icon button"><i class="icon edit"></i>
                    id = {{ item.getId() }}</a></td>
            <td><a href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getTitle() }}</a></td>            
            <td>{{ item.getSort() }}</td>            
        </tr>
    {% endfor %}
    </tbody>
</table>
