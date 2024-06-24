<form method="post" class="ui form" action="" enctype="multipart/form-data">

    <!--controls-->
    <div class="ui segment">

        {% set typeBackUrl = ((type is defined) ? '/' ~ type : '') %}
        <a href="{{ url.get() }}media/admin{{ typeBackUrl }}?lang={{ constant('LANG') }}" class="ui button">
            <i class="icon left arrow"></i> {{ helper.at('Back') }}
        </a>

        <div class="ui positive submit button">
            <i class="save icon"></i> {{ helper.at('Save') }}
        </div>

        {% if model.getId() %}

            <a href="{{ url.get() }}media/admin/delete/{{ model.getId() }}?lang={{ constant('LANG') }}" class="ui button red">
                <i class="icon trash"></i> {{ helper.at('Delete') }}
            </a>

            {% if model.getId() %}
                {% set url = helper.langUrl(['for':'media', 'slug':model.getSlug()]) %}
                <a class="ui blue button" target="_blank"
                   href="{{url}}">
                    {{ helper.at('View Online') }}
                </a>
            {% endif %}

        {% endif %}

    </div>
    <!--end controls-->

    <div class="ui segment">
        <div class="ui grid">
            <div class="twelve wide column">
                {{ form.renderDecorated('title') }}
                {{ form.renderDecorated('slug') }}
                {{ form.renderDecorated('text') }}
                {{ form.renderDecorated('kod_video') }}
                {{ form.renderDecorated('video') }}
            </div>
            <div class="four wide column">
                {{ form.renderDecorated('category_id') }}
                {{ form.renderDecorated('anons') }}
            </div>
            <div class="sixteen wide column">
                {{ form.renderDecorated('gallery') }}                
            </div>   
            
        </div>

    </div>

</form>

<!--ui semantic-->
<script>
    $( ".ui.form" ).form({
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

<script type="text/javascript">
$(document).ready(function(){
    $('ul.gallery-list > li').each(function() {
        var delAc = $(this).find('a.delete');

        delAc.on('click', function(event){
            var containerLi = $(this).parent();
            var id = $(this).attr('id');
            event.preventDefault();
            $.ajax({
                type        : 'DELETE',
                url         : '/media/admin/removefile/'+id,
            }).done(function() {
                var message = "Photo deleted";
                containerLi.remove();
                $('#message-delete').fadeIn('slow').text(message);
            });
        });
    });
});
</script>
