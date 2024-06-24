{% if entries %}
<section class="tenders">
  <div class="container">
    <div class="row">
      <div class=" col-md-12 tender-posts">
        <div class="content">   

          <ul class="docs row">
            {% for item in entries %}
              {% if item.getSources() == 'lexuz' %}
              <li class="col-md-12">
                <div class="documents documentation">
                  <div class="document-img">
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
              </li>
              {% endif %}
              {% if item.getSources() == 'file' %}               
                <li class="col-md-6">
                  <div class="documents documentation">
                    <div class="document-img">
                      {% if item.getFormat()|lowercase == 'docx' %}
                      <img src="/assets/images/docx.png" alt="{{ item.getTitle() }}" class="img-responsive">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'doc' %}
                      <img src="/assets/images/docx.png" alt="{{ item.getTitle() }}" class="img-responsive">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'jpg' %}
                      <img src="/assets/images/jpg.png" alt="{{ item.getTitle() }}" class="img-responsive">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'jpeg' %}
                      <img src="/assets/images/jpg.png" alt="{{ item.getTitle() }}" class="img-responsive">
                      {% endif %}
                      {% if item.getFormat()|lowercase == 'pdf' %}
                      <img src="/assets/images/pdf.png" alt="{{ item.getTitle() }}" class="img-responsive">
                      {% endif %}
                    </div><!-- /. document-img -->
                  <div class="document-content">
                    <h4><a href="{{ item.getUrl() }}{{item.getFile()}}">{{ item.getTitle() }}</a></h4>
                    <p class="down-info"><span class="space">{{ helper.translate('Format') }}: {{ item.getFormat() }}</span> <span>{{ helper.translate('Size') }}: {{ item.getSize() }} КБ</span></p>
                    <p>
                      <a href="{{ item.getUrl() }}{{item.getFile()}}" class="document-more text-uppercase" target="_blank"><i class="fa fa-windows"></i> {{helper.translate('Download')}}</a>
                    </p>
                  </div><!-- /. document-cotent -->
                  </div>            
                </li>
              {% endif %}
            {% endfor %}
          </ul><!-- /. docs -->

        </div>
      </div>
    </div>
  </div>
</section>
{% endif %}