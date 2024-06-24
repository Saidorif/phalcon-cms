{%- macro leaf_item(leaf, url) %}

  {% if leaf.getStatus() == 1 %}
    {% set status = 0 %}
    {% set statusText = helper.at('Disable') %}
  {% else %}
    {% set status = 1 %}
    {% set statusText = helper.at('Activeted') %}
  {% endif %}

    <li id="category_{{ leaf.getId() }}">
      <div class="item {% if leaf.getStatus() == 1 %}active{% else %}off{% endif %}">
        <span class="title">{{ leaf.getTitle() }}</span>
        <span class="info">({{ leaf.getSlug() }})</span>
        <div class="ui buttons right floated mini">
          <a href="javascript:void(0);" onclick="statusCategory({{ leaf.getId() }},{{status}})" class="ui button green">{{statusText}}</a>
          <a href="{{ url }}menu/admin/edit/{{ leaf.getId() }}?lang={{ constant('LANG') }}" class="ui button mini violet">{{ helper.at('Edit') }}</a>
          <a href="javascript:void(0);" onclick="deleteCategory({{ leaf.getId() }}, this)" class="ui button mini red">{{ helper.at('Delete') }}</a>
        </div>
      </div>
      {% if leaf.hasChildren() %}
        <ol>
          {% for child in leaf.children() %}
            {{ leaf_item(child, url) }}
          {% endfor %}
        </ol>
      {% endif %}
    </li>
{%- endmacro %}

<div class="ui blue segment">
    {{ helper.at('You can drag and drop tree elements to change order and relations') }}
</div>

<div class="ui segment">

  {% for root, root_title in roots %}
    <h3>{{ root_title }}</h3>

    <ol class="sortable" id="root_{{ root }}">
      {% set menu = menu_helper.menuUpperLeafs(root) %}
      {% for leaf in menu %}
        {{ leaf_item(leaf, url.get()) }}
      {% endfor %}
    </ol>
    <a class="save ui button green" id="save-root-{{ root }}" data-root="{{ root }}">
        <i class="save icon"></i> {{ helper.at('Save') }}
    </a>
    <a href="javascript:void(0);" data-root="{{ root }}" class="add ui button blue">
        <i class="icon plus"></i> {{ helper.at('Add') }}
    </a>
  {% endfor %}
</div>

<div class="ui modal tiny menu-create">
  <i class="close icon"></i>
  <div class="header">
    {{ helper.at('Create menu') }}
  </div>
  <div class="content ui form">
    <div class="ui segment">
      <div class="field title">
          <label for="title">{{ helper.at('Title') }} *</label>
          <input type="text" id="title" name="title" required="1">
      </div>
      <div class="field slug">
          <label for="slug">{{ helper.at('Url') }} *</label>
          <input type="text" id="slug" name="slug" required="1">
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui button red cancel">{{ helper.at('Cancel') }}</div>
    <div class="ui button green approve">{{ helper.at('Add') }}</div>
  </div>
</div>

<link rel="stylesheet" href="{{ url.path() }}vendor/jquery-ui-1.11.4/jquery-ui.min.css">
<script src="{{ url.path() }}vendor/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script src="{{ url.path() }}vendor/js/jquery.mjs.nestedSortable.js"></script>
<script type="text/javascript">
  function initNestedSortable() {
    $('.sortable').nestedSortable({
      handle: 'div',
      items: 'li',
      maxLevels: 4,
      toleranceElement: '> div',
    });
  }

  function deleteCategory(category_id, node) {
    if (confirm("{{ helper.at('Do you really want delete this menu?') }}")) {
      $.post('/menu/admin/delete', {category_id: category_id}, function (response) {
        if (response.success) {
          var parent = node.parentNode.parentNode;
          if (parent) {
            parent.parentNode.removeChild(parent);
            initNestedSortable();
            $("#save-root-" + response.root).click();
          }
        }
      });
    }
  }

  function statusCategory(category_id, status) {
    $.post("/menu/admin/status/"+category_id+"?lang={{constant('LANG')}}", {status:status}, function (response) {
      if (response.success) {
        if(status == 1)
          $('ol.sortable#root_' + response.root).find('li#category_'+category_id+' > .item').removeClass('off').addClass('active').find('a.button.green').text("{{helper.at('Disable')}}").attr('onclick', 'statusCategory(' + category_id + ', 0)');
        if(status == 0)
          $('ol.sortable#root_' + response.root).find('li#category_'+category_id+' > .item').removeClass('active').addClass('off').find('a.button.green').text("{{helper.at('Activeted')}}").attr('onclick', 'statusCategory(' + category_id + ', 1)');
        $("#save-root-" + response.root).click();
      }
    });
  }

  initNestedSortable();

  $('.save').click(function (e) {
    var root = $(this).data('root');
    data = $('ol.sortable#root_' + root).nestedSortable('toArray', {startDepthCount: 0});
    if (data) {
      $.post("/menu/admin/saveMenu", {root: root, data: data}, function (response) {
        if (response.success == true) {
          initNestedSortable();
          noty({layout: 'center', type: 'success', text: "{{ helper.at('Menu has been success saved') }}", timeout: 2000});
        }
      }, 'json');
    }
  });

  $('.add').click(function (e) {
    $('.content.ui.form').find('#title').val('');
    $('.content.ui.form').find('#slug').val('');
    var root = $(this).data('root');
    $('.ui.tiny.modal.menu-create').modal({
        onApprove : function() {
          var title = $('.content.ui.form').find('#title').val();
          var slug = $('.content.ui.form').find('#slug').val();
          if(!title) {
            $('.content.ui.form').find('.field.title').addClass('error');
            return false;
          }
          if(!slug) {
            $('.content.ui.form').find('.field.slug').addClass('error');
            return false;
          }
          if(title && slug){
            $.post("/menu/admin/add", {root:root, title:title, slug:slug}, function (response) {
              if (response.success == true) {
                var LANG = "{{ constant('LANG') }}";
                var newItemLi = $("<li>").attr('id', 'category_' + response.id);
                var newItemDiv = $("<div>").addClass('active item');

                var title = $("<span>").addClass('title').html(response.title);
                var info = $("<span>").addClass('info').html('(' + response.slug + ')');
                var buttons = $('<div class="ui buttons right floated mini ui-sortable-handle"><a href="javascript:void(0);" onclick="statusCategory('+response.id+',0)" class="ui button green">{{helper.at('Disable')}}</a><a href="/menu/admin/edit/'+response.id+'?lang='+LANG+'" class="ui button mini violet">{{ helper.at('Edit') }}</a><a href="javascript:void(0);" onclick="deleteCategory('+response.id+', this)" class="ui button mini red">{{ helper.at('Delete') }}</a>');

                newItemDiv.append(title).append(info).append(buttons);

                newItemLi.append(newItemDiv);

                var list = $('ol.sortable#root_' + root);
                list.append(newItemLi);

                initNestedSortable();
                $("#save-root-" + root).click();
              }
              if (response.error) {
                noty({layout: 'center', type: 'error', text: response.error, timeout: 2000});
              }
            }, 'json');
          }
        }
    }).modal('show');
  });
</script>
