<section class="">
    {{helper.widget('Breadcrumbs').breadcrumbs()}}
    <div class="container">
        <div class="main-content">
            <h2 class="page-title">{{productsResult.title}}</h2>
            <div class="p-3" style="overflow:hidden;">
                {% if productsResult.p.getAnons() %}
                    <div class="product-image">
                        <div class="card">
                            <img src="/{{productsResult.p.getAnons()}}" alt="{{productsResult.title}}" class="img-fluid" />
                        </div>
                    </div>
                {% endif %}
                <h4 class="text-brand">{{helper.translate('Price')}}: {{helper.formatNumber(productsResult.p.getPrice())}} {{helper.translate('UZS')}}</h4>
                {{productsResult.text}}
            </div>
        </div>
    </div>
</section>