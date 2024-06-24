{% if entries %}
<div class="tab-pane fade" id="pills-normativ" role="tabpanel" aria-labelledby="pills-normativ-tab">
    <div class="serviceDoc_block">
    {% for item in entries %}
        <div class="serviceDoc_item">
            <img src="/assets/img/icons/doc.png" width="38" alt="">
            <span>{{item.p.getTitle()}} | {{ item.p.getFormat()|uppercase }}</span>
        </div>
    {% endfor %}
    </div>
</div>
{% endif %}