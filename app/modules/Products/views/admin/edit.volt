<form method="post" class="ui form" action="" enctype="multipart/form-data">

    <!--controls-->
    <div class="ui segment">

        {% set typeBackUrl = ((type is defined) ? '/' ~ type : '') %}
        <a href="{{ url.get() }}products/admin{{ typeBackUrl }}?lang={{ constant('LANG') }}" class="ui button">
            <i class="icon left arrow"></i> {{ helper.at('Back') }}
        </a>

        <div class="ui green submit button">
            <i class="save icon"></i> {{ helper.at('Save') }}
        </div>

        {% if model.getId() %}

            <a href="{{ url.get() }}products/admin/delete/{{ model.getId() }}?lang={{ constant('LANG') }}" class="ui button red">
                <i class="icon trash"></i> {{ helper.at('Delete') }}
            </a>

            {% if model.getId() %}
                <a class="ui blue button" target="_blank"
                   href="{{ helper.langUrl(['for':'product','category':model.getCategorySlug(), 'slug':model.getSlug()]) }}">
                    {{ helper.at('View Online') }}
                </a>
            {% endif %}

        {% endif %}

    </div>
    <!--end controls-->

    <div class="ui segment">
        <div class="ui grid">
            <div class="ten wide column">
                {{ form.renderDecorated('title') }}
                {{ form.renderDecorated('slug') }} 
                {{ form.renderDecorated('price') }}  
                {{ form.renderDecorated('special_offer') }} 
                {{ form.renderDecorated('meta_title') }}
                {{ form.renderDecorated('meta_description') }}
                {{ form.renderDecorated('index_page') }}                  
                {{ form.renderDecorated('category_id') }} 
            </div>            
            <div class="six wide column gallery-half">
                {{ form.renderDecorated('anons') }}                 
            </div>

            <div class="sixteen wide column">    
                <hr>
                <div class="add_fields">
                <h3 class="admin-heading">Допольнительные поля</h3>
                <p><a href="#" class="ui blue button add_input"><i class="add square icon"></i> Добавить</a></p>
                {% for field in fields %}
                <div class="additional">
                    <input type="hidden" name="id_add[]" value="{{field.getId()}}">
                    <div class="half">                                
                        <label for="">Заголовок</label> 
                        <input type="text" name="title_add[]" value="{{field.getTitle()}}" placeholder="Производитель">  
                    </div>
                    <div class="half">                                
                        <label for="">Значение</label> 
                        <input type="text" name="value_add[]" value="{{field.getText()}}" placeholder="Italy">  
                    </div>
                    <div class="half last">
                        <a href="#" class="removeField" id="{{field.getId()}}"><i class="minus square icon"></i></a>
                    </div>                    
                </div>                
                {% endfor %} 
                </div>
                <div class="ui green inverted segment" id="message-del">{{helper.at('Fields deleted')}}</div>
                <div class="ui green inverted segment" id="message-delete">{{helper.at('Photo deleted')}}</div>
                <hr>
                {{ form.renderDecorated('photos') }}                     
                <hr>
                {{ form.renderDecorated('text') }}                             
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
$(function() {   

    var scntDiv = $('.add_fields');
    var i = $('.add_fields .additional').size() + 1;     
    
    $(document).on('click', '.removeInput', function() {
      if( i > 2 ) {
        $(this).parents('.additional').remove();
        i--;
      }
      return false;
    });
    
    $('.add_input').on('click', function(e) {
      e.preventDefault();  
      $('<div class="additional"><input type="hidden" name="id_add[]" value="0"><div class="half"><label>Заголовок</label><input type="text" name="title_add[]" placeholder="Производитель"></div><div class="half"><label>Значение</label><input type="text" name="value_add[]" placeholder="Italy"></div><div class="half last"><a href="#" class="removeInput"><i class="minus square icon"></i></a></div></div>').appendTo(scntDiv);
            i++;
      return false;
    });

    $('.additional').each(function() {
        var delAc = $(this).find('a.removeField');

        delAc.on('click', function(event){
            var container = $(this).parents('.additional');
            var id = $(this).attr('id');
            event.preventDefault(); 
            $.ajax({
                type        : 'DELETE', 
                url         : '/products/admin/removefield/'+id, 
            }).done(function() {  
                container.remove();
                $('#message-del').fadeIn('slow');
            });
        });       
    });

    $('ul.gallery-list > li').each(function() {
        var delAc = $(this).find('a.delete');

        delAc.on('click', function(event){
            var containerLi = $(this).parent();
            var id = $(this).attr('id');
            event.preventDefault(); 
            $.ajax({
                type        : 'DELETE', 
                url         : '/products/admin/removefile/'+id, 
            }).done(function() {  
                containerLi.remove();
                $('#message-delete').fadeIn('slow');                    
            });
        });       
    });
});    
</script>

<script type="text/javascript" src="{{ url.get() }}vendor/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
  tinymce.init({ selector:'#text',
  language: 'ru', 
  height: 500,
  plugins: [
    "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking responsivefilemanager",
    "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
  ],

  toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
  toolbar2: "cut copy paste | bullist numlist | blockquote | link unlink | responsivefilemanager image media | code | forecolor backcolor | table | subscript superscript",

  menubar: false,
  image_advtab: true ,
  external_filemanager_path:"/vendor/responsive_filemanager/filemanager/",
  filemanager_title:"Responsive Filemanager" ,
  external_plugins: { "filemanager" : "/vendor/responsive_filemanager/filemanager/plugin.min.js"},
  toolbar_items_size: 'small'});
</script>