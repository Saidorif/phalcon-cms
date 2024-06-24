{% set url = helper.langUrl(['for':'search', 'slug':'search']) %}
<form action="{{url}}" method="GET" class="search-form">

	<div class="input-group">
      <input type="text" class="form-control" name="search" placeholder="{{helper.at('Search')}} ..." value="{{searchQuery}}">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
      </span>
    </div>
</form>