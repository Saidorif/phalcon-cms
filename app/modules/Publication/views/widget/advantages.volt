{% if entries %}
<div class="advantages--theme5" id="_lp_block_10242641" data-block-layout="21841">
    <div class="advantages-wrapper">
        <div class="advantages-inner container">
            <div class="block-title">При заказе Вы получите:</div>
            <div class="blocks">
            {% for index, item in entries %}
            {% set url = helper.langUrl([
            'for':'publication',
            'type':item.t_slug,
            'slug':item.p.getSlug()
            ]) %}
                <div class="advantage clear-self">
                    <div class="pic">
						<i class="fa {{item.p.getIcons()}} fa-3x"></i>
					</div>
                    <div class="text">
                        <div class="title"> {{ item.title }}</div>
                        <div class="body">{{ helper.announce(item.text, 300) }}</div>
                    </div>
                </div>
            {% endfor %}
            </div>
        </div>
    </div>
</div>
{% endif %}