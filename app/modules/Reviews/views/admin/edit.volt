<form method="post" action="" class="ui form" enctype="multipart/form-data">
    <div class="ui segment">
        <a href="{{ url.get() }}reviews/admin/index" class="ui button">
            <i class="icon left arrow"></i> {{ helper.at('Back') }}
        </a>

        <div class="ui green submit button">
            <i class="save icon"></i> {{ helper.at('Save') }}
        </div>

        {% if reviews is defined %}
            <a href="{{ url.get() }}reviews/admin/delete/{{ reviews.getId() }}?lang={{ constant('LANG') }}" class="ui button red">
                <i class="icon trash"></i> {{ helper.at('Delete') }}
            </a>
        {% endif %}
    </div>
    
    <div class="ui segment">
        {{ form.renderDecorated('title') }}   
        {{ form.renderDecorated('job') }}
        {{ form.renderDecorated('text') }}
        {{ form.renderDecorated('foto') }}
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