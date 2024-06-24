<!--controls-->
<div class="ui segment">

    <a href="{{ url.get() }}products/admin?lang={{ constant('LANG') }}" class="ui button">
        <i class="icon left arrow"></i> {{helper.at('Products')}}
    </a>

    <a href="{{ url.get() }}products/category/add" class="ui button blue">
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
    </tr>
    </thead>
    <tbody>
    {% for item in entries %}
        {% set link = url.get() ~ "products/category/edit/" ~ item.getId() %}
        <tr>
            <td>
                <a href="{{ link }}?lang={{ constant('LANG') }}" class="mini ui icon button">
                    <i class="icon edit"></i>
                    id = {{ item.getId() }}
                </a>
            </td>
            <td class="ui bulleted list">
                <a class="item" href="{{ link }}?lang={{ constant('LANG') }}">{{ item.getTitle() }}</a>
                {% if item.children %}
                <div class="item">
                    <a>Подкатегории</a>
                    <div class="list">
                    {% for child in item.getChildren() %}
                    {% set child_link = url.get() ~ "products/category/edit/" ~ child.getId() %}
                    <a href="{{child_link}}?lang={{ constant('LANG') }}" class="item">
                        <i class="icon edit"></i>
                        {{child.getTitle()}}
                    </a>
                    {% if child.children %}
                    <div class="item">
                        <a>Подкатегории</a>
                        <div class="list">
                        {% for ch in child.getChildren() %}
                        {% set ch_link = url.get() ~ "products/category/edit/" ~ ch.getId() %}
                        <a href="{{ch_link}}?lang={{ constant('LANG') }}" class="item">
                            <i class="icon edit"></i>
                            {{ch.getTitle()}}
                        </a>
                            {% if ch.children %}
                            <div class="item">
                                <a>Подкатегории</a>
                                <div class="list">
                                {% for d in ch.getChildren() %}
                                {% set d_link = url.get() ~ "products/category/edit/" ~ d.getId() %}
                                <a href="{{d_link}}?lang={{ constant('LANG') }}" class="item">
                                    <i class="icon edit"></i>
                                    {{d.getTitle()}}
                                </a>
                                {% endfor %}
                                </div>
                            </div>
                            {% endif %}
                        {% endfor %}
                        </div>
                    </div>
                    {% endif %}
                    {% endfor %}
                    </div>
                </div>
                {% endif %}
            </td>

            {% set prod_link = helper.langUrl(['for':'products', 'category': item.getSlug()]) %}
            <td><a href="{{ prod_link }}" target="_blank">{{ prod_link }}</a></td>
        </tr>
    {% endfor %}
    </tbody>
</table>
