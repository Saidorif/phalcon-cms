<form method="post" class="ui form" action="" enctype="multipart/form-data">

    <!--controls-->
    <div class="ui segment">

        <a href="{{ url.get() }}media/category?lang={{ constant('LANG') }}" class="ui button">
            <i class="icon left arrow"></i> {{helper.at('Back')}}
        </a>

        <div class="ui positive submit button">
            <i class="save icon"></i> {{helper.at('Save')}}
        </div>

        {% if model.getId() %}

            <a href="{{ url.get() }}media/category/delete/{{ model.getId() }}?lang={{ constant('LANG') }}"
               class="ui button red">
                <i class="icon trash"></i> {{helper.at('Delete')}}
            </a>            

        {% endif %}

    </div>
    <!--end controls-->

    <div class="ui segment">
        {{ form.renderDecorated('title') }}        
        {{ form.renderDecorated('sort') }}        
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
            }
        }
    });
</script><!--/end ui semantic-->