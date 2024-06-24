$(function() {

    var stickyAction = $('.content-admin > .ui.form > .ui.segment').first().addClass('header-actions');
    stickyAction.sticky();

    $('.ui.checkbox').checkbox();

    $('.ui.dropdown').dropdown();

    $('.ui.selection.dropdown').dropdown({
        duration: 10
    });

    $('.ui.menu.init .item').tab();

    $('[data-description]').each(function(index, element){
        var description = $(element).attr('data-description');
        var descriptionElement = $('<div class="description">');
        descriptionElement.html(description);
        $(element).after(descriptionElement);
    });   

    $('input#slug').keyup(function(){
        this.value = this.value.toLowerCase().trim();
        this.value = this.value.replace(/[^\/a-z0-9\s-]/g, ' ');
        this.value = this.value.replace(/[\s-]+/g, '-');
    });

    filer_default_opts = {
      changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-folder"></i></div><div class="jFiler-input-text"><h3>Click on this box</h3> <span style="display:inline-block; margin:8px 0">or</span></div><a class="jFiler-input-choose-btn btn-custom blue-light">Browse Files</a></div></div>',  
      templates: {
        box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
        item: '<li class="jFiler-item" style="width:20%">\
                    <div class="jFiler-item-container">\
                        <div class="jFiler-item-inner">\
                            <div class="jFiler-item-thumb">\
                                <div class="jFiler-item-status"></div>\
                                <div class="jFiler-item-thumb-overlay">\
                                    <div class="jFiler-item-info">\
                                        <div style="display:table-cell;vertical-align: middle;">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
                                            <span class="jFiler-item-others">{{fi-size2}}</span>\
                                        </div>\
                                    </div>\
                                </div>\
                                {{fi-image}}\
                            </div>\
                            <div class="jFiler-item-assets jFiler-row">\
                                <ul class="list-inline pull-left">\
                                    <li>{{fi-progressBar}}</li>\
                                </ul>\
                                <ul class="list-inline pull-right">\
                                    <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                </ul>\
                            </div>\
                        </div>\
                    </div>\
                </li>',
        itemAppend: '<li class="jFiler-item" style="width:49%">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-thumb-overlay">\
                                        <div class="jFiler-item-info">\
                                            <div style="display:table-cell;vertical-align: middle;">\
                                                <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
                                                <span class="jFiler-item-others">{{fi-size2}}</span>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
        progressBar: '<div class="bar"></div>',
        itemAppendToEnd: false,
        removeConfirmation: true,
        _selectors: {
            list: '.jFiler-items-list',
            item: '.jFiler-item',
            progressBar: '.bar',
            remove: '.jFiler-item-trash-action'
        }
      }          
    };    

    $('input.gallery').filer({
        changeInput: filer_default_opts.changeInput,
        showThumbs: true,
        theme: "dragdropbox",
        addMore: true,
        templates: filer_default_opts.templates
    });

});

function selectText(element) {
    var selection = window.getSelection();
    var range = document.createRange();
    range.selectNodeContents(element);
    selection.removeAllRanges();
    selection.addRange(range);
}