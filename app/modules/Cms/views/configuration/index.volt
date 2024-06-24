<form action="" method="post" class="ui form">

    <!--tabs-->
    <div class="ui tabular menu init">
        <a class="item active" data-tab="main">
            {{helper.at('Main')}}
        </a>
    </div>
    <!--/end tabs-->

    <!--tab main-->
    <div class="ui segment tab active" data-tab="main">
        {{ form.renderAll() }}
    </div>
    <!--/end tab main-->

    <input type="hidden" name="form" value="1">
    <button type="submit" class="ui button green"><i class="icon save"></i> {{helper.at('Save')}}</button>
</form>
