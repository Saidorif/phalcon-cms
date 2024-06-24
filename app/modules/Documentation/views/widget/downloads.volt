{% if entries %}
<div class="about-text wraps">
    <div class="title">
        <h2>{{helper.translate('Base form templates')}}</h2>
    </div>
    <div class="contents">
        <div class="list">
            <ul class="withArrow ">
            {% for item in entries %}
                <li><span class="fa fa-angle-right"></span><a href="{{ item.getUrl() }}{{item.getFile()}}" target="_blank" download> {{item.getTitle()}}</a></li>
            {% endfor %}
            </ul>
        </div>
    </div>
</div>
{% endif %}