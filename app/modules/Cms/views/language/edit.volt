<form method="post" class="ui form" action="" enctype="multipart/form-data">

    <!--controls-->
    <div class="ui segment">

        <a href="{{ url.get() }}cms/language" class="ui button">
            <i class="icon left arrow"></i> {{helper.at('Back')}}
        </a>

        <div class="ui green submit button">
            <i class="save icon"></i> {{helper.at('Save')}}
        </div>

        {% if model.getId() %}

            <a href="{{ url.get() }}cms/language/delete/{{ model.getId() }}" class="ui button red">
                <i class="icon trash"></i> {{helper.at('Delete')}}
            </a>

        {% endif %}

    </div>
    <!--end controls-->

    <div class="ui segment">
        {{ form.renderDecorated('iso') }}
        {{ form.renderDecorated('locale') }}
        {{ form.renderDecorated('name') }}
        {{ form.renderDecorated('short_name') }}
        {{ form.renderDecorated('url') }}
        {% if model.getId() %}
            {{ form.renderDecorated('sortorder') }}
            {{ form.renderDecorated('primary') }}
        {% endif %}
    </div>

</form>

<!--ui semantic-->
<script>
    $('.ui.form').form({
        fields: {
            iso: {
                identifier: 'iso',
                rules: [
                    {type: 'empty'}
                ]
            },
            locale: {
                identifier: 'locale',
                rules: [
                    {type: 'empty'}
                ]
            },
            name: {
                identifier: 'name',
                rules: [
                    {type: 'empty'}
                ]
            },
            short_name: {
                identifier: 'short_name',
                rules: [
                    {type: 'empty'}
                ]
            },
            url: {
                identifier: 'url',
                rules: [
                    {type: 'empty'}
                ]
            }
        }
    });
</script><!--/end ui semantic-->