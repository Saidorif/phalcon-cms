<div class="ui segment">
    <a href="{{ url.get() }}knowledge/admin/add?lang={{ constant('LANG') }}" class="ui blue button"><i
                class="add icon"></i> {{ helper.at('Add New') }}</a>
</div>
    <div class="ui raised segments">
        {% for item in entries %}
            {% set link = url.get() ~ 'knowledge/admin/edit/' ~ item.getId() %}
        <div class="ui segment clearing">
            <p>
                {{ item.getTitle() }}
                <a href="{{ url.get() }}knowledge/admin/delete/{{ item.getId() }}?lang={{ constant('LANG') }}" class="ui red right floated button"><i class="trash alternate outline icon"></i> Delete</a>
                <a href="{{ link }}?lang={{ constant('LANG') }}" class="ui blue right floated button"><i class="edit icon"></i> Change</a>
            </p>
        </div>
            {% if item.getCats() AND item.getCats()|length > 0 %}
                <div class="ui raised segments">
                        {% for c in  item.getCats() %}
                            {% set h = url.get() ~ 'knowledge/admin/edit/' ~ c.getId() %}
                    <div class="ui segment clearing">
                        <p>
                            {{ c.getTitle() }}
                            <a href="{{ url.get() }}knowledge/admin/delete/{{ c.getId() }}?lang={{ constant('LANG') }}" class="ui red right floated button"><i class="trash alternate outline icon"></i> Delete</a>
                            <a href="{{ h }}?lang={{ constant('LANG') }}" class="ui blue right floated button"><i class="edit icon"></i> Change</a>
                        </p>
                    </div>
                            {% if c.getCats() AND c.getCats()|length > 0 %}
                                <div class="ui raised segments">
                                    {% for ch in  c.getCats() %}
                                        {% set hr = url.get() ~ 'knowledge/admin/edit/' ~ ch.getId() %}
                                        <div class="ui segment clearing">
                                            <p>
                                                {{ ch.getTitle() }}
                                                <a href="{{ url.get() }}knowledge/admin/delete/{{ ch.getId() }}?lang={{ constant('LANG') }}" class="ui red right floated button"><i class="trash alternate outline icon"></i> Delete</a>
                                                <a href="{{ hr }}?lang={{ constant('LANG') }}" class="ui blue right floated button"><i class="edit icon"></i> Change</a>
                                            </p>
                                        </div>
                                        {% if ch.children|length > 0 %}
                                            <div class="ui raised segments">
                                                {% for child in  ch.children %}
                                                    {% set href = url.get() ~ 'knowledge/admin/edit/' ~ child.getId() %}
                                                    <div class="ui segment clearing">
                                                        <p>
                                                            {{ child.getTitle() }}
                                                            <a href="{{ url.get() }}knowledge/admin/delete/{{ child.getId() }}?lang={{ constant('LANG') }}" class="ui red right floated button"><i class="trash alternate outline icon"></i> Delete</a>
                                                            <a href="{{ href }}?lang={{ constant('LANG') }}" class="ui blue right floated button"><i class="edit icon"></i> Change</a>
                                                        </p>
                                                    </div>
                                                {% endfor %}
                                            </div>
                                        {% endif %}
                                    {% endfor %}
                                </div>
                            {% endif %}
                        {% endfor %}
                </div>
            {% endif %}
        {% endfor %}
    </div>
