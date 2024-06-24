<form action="" method="post" class="ui form segment">

    {{ form.renderDecorated('head') }}
    {{ form.renderDecorated('body') }}

    <button type="submit" class="ui button green"><i class="icon save"></i> {{helper.at('Save')}}</button>
</form>
