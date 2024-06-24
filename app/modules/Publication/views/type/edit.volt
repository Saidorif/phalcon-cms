<form method="post" class="ui form" action="" enctype="multipart/form-data">

    <!--controls-->
    <div class="ui segment">

        <a href="{{ url.get() }}publication/type?lang={{ constant('LANG') }}" class="ui button">
            <i class="icon left arrow"></i> {{helper.at('Back')}}
        </a>

        <div class="ui green submit button">
            <i class="save icon"></i> {{helper.at('Save')}}
        </div>

        {% if model.getId() %}

            <a href="{{ url.get() }}publication/type/delete/{{ model.getId() }}?lang={{ constant('LANG') }}"
               class="ui button red">
                <i class="icon trash"></i> {{helper.at('Delete')}}
            </a>

            {% if model.getId() %}
                <a class="ui blue button" target="_blank"
                   href="{{ helper.langUrl(['for':'publications','type':model.getSlug()]) }}">
                    See section on site
                </a>
            {% endif %}

        {% endif %}

    </div>
    <!--end controls-->

    <div class="ui segment">
        {{ form.renderDecorated('title') }}
        {{ form.renderDecorated('slug') }}
        {{ form.renderDecorated('limit') }}
        {{ form.renderDecorated('format') }}
        {{ form.renderDecorated('display_date') }}
        {{ form.renderDecorated('meta_title') }}
        {{ form.renderDecorated('meta_description') }}
        {{ form.renderDecorated('index_page') }}
        {{ form.renderDecorated('menu_check') }}
    </div>

</form>

<!--ui semantic-->
<script>
    $('.ui.form').form({
        fields: {
            title: {
                identifier: 'title',
                rules: [
                    {type: 'empty'}
                ]
            },
            slug: {
                identifier: 'slug',
                rules: [
                    {type: 'empty'}
                ]
            }
        }
    });
</script><!--/end ui semantic-->