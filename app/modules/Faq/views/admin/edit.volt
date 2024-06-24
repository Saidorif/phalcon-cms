<form method="post" action="" class="ui form" enctype="multipart/form-data">
    <div class="ui segment">
        <a href="{{ url.get() }}faq/admin/index" class="ui button">
            <i class="icon left arrow"></i> {{ helper.at('Back') }}
        </a>

        <div class="ui green submit button">
            <i class="save icon"></i> {{ helper.at('Save') }}
        </div>

        {% if faq is defined %}
            <a href="{{ url.get() }}faq/admin/delete/{{ faq.getId() }}?lang={{ constant('LANG') }}" class="ui button red">
                <i class="icon trash"></i> {{ helper.at('Delete') }}
            </a>
        {% endif %}
    </div>
    
    <div class="ui segment">
        {{ form.renderDecorated('title') }}   
        {{ form.renderDecorated('text') }}
    </div>
    
</form>

<script>
    $(".ui.form").form({
        fields: {
            title: {
                identifier: 'title',
                rules: [
                    {type: 'empty'}
                ]
            }
        }
    });
</script>