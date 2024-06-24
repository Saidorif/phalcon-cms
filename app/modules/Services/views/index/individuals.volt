<header class="body-bg">
  {{ partial('main/menu') }}
</header>

<section class="tenders">
  <div class="container">
    {{helper.widget('Breadcrumbs').breadcrumbs()}}      
    <div class="row">
      <div class="col-md-8 tender-posts">
        <header class="ov-h mb-1">
          <h1 class="content-title pull-left">{{title}}</h1>
          <a href="#" class="printDemo text-uppercase print-btn pull-right">
            <span class="glyphicon glyphicon-print"></span> {{ helper.translate('print version') }} 
          </a>
        </header>
        <div class="content"> 
          {% if individualsResult %}
            {% for prt in individualsResult %} 
              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne-{{prt.getId()}}" aria-expanded="true" aria-controls="collapseOne">{{prt.getTitle()}}</a>
                    </h4>
                  </div> 
                  <div id="collapseOne-{{prt.getId()}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <div class="main_table-index">
                          <div class="main_table_in-index dark">                  
                            <div class="table-responsive">
                              <div class="media">
                                <div class="media-body">
                                  <h4 class="media-heading">{{prt.getText()}}</h4>
                                </div>
                              </div>
                            </div>   
                          </div>
                        </div>
                      </div>
                    </div>
                </div>        
              </div><!-- panel-group -->
            {% endfor %}  
          {% endif %}  
        </div>
      </div>

      <div class="col-md-4 sidebar">
        <h5 class="sidebar-title text-uppercase m-0"> <span class="glyphicon glyphicon-align-justify"></span> {{ title }}</h5>
        <div class="sidebar-item mb-4">
          <ul class="press-news">
          </ul>
        </div><!-- sidebar-item -->
      </div><!-- / sidebar -->
    </div>
  </div>
</section>