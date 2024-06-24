{% if entries %}
<section class="section main-content">
  <div class="container">
    <h1 class="text-center">{{ title }}</h1>
    {{helper.widget('Breadcrumbs').breadcrumbs()}}
    <div class="row">
      <div class=" col-md-12 tender-posts">
        <div class="content">   

          <div class="docs row">
            {% for item in entries %}
              {% if item.getSources() == 'lexuz' %}
              <div class="col-md-12">
                <div class="documents2 documentation2">
                  <div class="document-img2">
                    <img src="/assets/icons/document-img.png" alt="">
                  </div><!-- /. document-img -->
                  <div class="document-content">
                    <h4><a href="{{ item.getUrl() }}">{{ item.getTitle() }}</a></h4>
                    <a href="{{ item.getUrl() }}" target="_blank" class="document-link">{{ item.getUrl() }}</a>
                    <p>
                      <a href="{{ item.getUrl() }}" target="_blank" class="document-more text-uppercase" target="_blank"><i class="fa fa-window">desktop_windows</i> {{helper.translate('To link')}}</a>
                    </p>
                  </div><!-- /. document-cotent -->
                </div>            
              </div>
              {% endif %}
              {% if item.getSources() == 'file' %}               
                <div class="col-md-6">
                  <div class="documents2 documentation2">
                    <div class="document-img2">
                      {% if item.getFormat()|lowercase == 'docx' %}
                      <img src="/assets/img/docx.png" alt="{{ item.getTitle() }}" class="img-fluid">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'doc' %}
                      <img src="/assets/img/docx.png" alt="{{ item.getTitle() }}" class="img-fluid">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'jpg' %}
                      <img src="/assets/img/jpg.png" alt="{{ item.getTitle() }}" class="img-fluid">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'jpeg' %}
                      <img src="/assets/img/jpg.png" alt="{{ item.getTitle() }}" class="img-fluid">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'pdf' %}
                      <img src="/assets/img/pdf.png" alt="{{ item.getTitle() }}" class="img-fluid">
                      {% endif %}
                    </div><!-- /. document-img -->
                  <div class="document-content2">
                    <h4><a href="{{ item.getUrl() }}{{item.getFile()}}">{{ item.getTitle() }}</a></h4>
                    <p class="down-info"><span class="space">{{ helper.translate('Format') }}: {{ item.getFormat() }}</span> <span>{{ helper.translate('Size') }}: {{ item.getSize() }} КБ</span></p>
                    <p>
                      <a href="{{ item.getUrl() }}{{item.getFile()}}" class="document-more2 text-uppercase" target="_blank"><i class="fab fa-windows"></i> {{helper.translate('Download')}}</a>
                    </p>
                  </div><!-- /. document-cotent -->
                  </div>         
                </div>
              {% endif %}
            {% endfor %}
          </div><!-- /. docs -->

        </div>
      </div>
    </div>
  </div>
</section>
{% endif %}