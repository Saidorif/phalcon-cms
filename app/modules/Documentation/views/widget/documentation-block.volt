{% if entries %}
<!-- start documents -->
<div class="documents">
    <h2 class="basic-title">
        <img src="/assets/img/document.png" alt="">{{helper.translate('Documents')}}
    </h2>
    <div class="documents-block">
        {% for item in entries %}
        <div class="item">
            <a href="{{ item.p.getUrl() }}{{item.p.getFile()}}" target="_blank" download class="title">
                <span>{{ item.p.getFormat()|uppercase }}</span>
            </a>
            <p>{{item.p.getTitle()}}</p>
        </div>
        {% endfor %}
    </div>
</div>
<!-- end documents -->
{% endif %}