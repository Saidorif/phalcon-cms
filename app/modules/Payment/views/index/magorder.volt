{{ partial('main/menu') }}

<header>
  <div class="container">
    <div class="row">
      <div class="col-12">            
        <div class="header" >
          <div class="cover"></div>
          <div class="row">
            <nav class="navbar navbar-expand-lg topNav desktopNav">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavbar" aria-controls="topNavbar" aria-expanded="false">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
              </button>
              <div class="collapse navbar-collapse" id="topNavbar">
                {{ helper.widget('Menu').mainMenu() }}
              </div>
            </nav>
            <div class="col-md-6 col-12">
              <div class="logo">
                <a href="/" title="">
                  <img class="img-fluid" src="/{{ helper.logo() }}" alt="" />
                </a>
              </div>
            </div>                  
            <div class="clearfix"></div>  
          </div>            
        </div><!--/header-->            
      </div>                    
    </div>
  </div>
</header>



<section class="paycom-page">
	<div class="container">
		<div class="main-content">
			{{helper.widget('Breadcrumbs').breadcrumbs()}}
			<div class="invoice-wrap">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2 success-pay">
							<h2 class="text-center mb-30 text-uppercase">{{helper.translate('Get order')}}</h2>
						<div class="row">
							<div class="col-sm-6">
								<h5>{{helper.translate('name')}}</h5>
								<h5>{{ helper.translate('Subtime') }}</h5>
								<h5>{{ helper.translate('Address') }}</h5>
								<h5>{{helper.translate('Phone')}}</h5>
								<h5>{{helper.translate('Summa')}}</h5>
							</div>
							<div class="col-sm-6 simple-text mb-30">
								{% if subscriber %}
									<h5>{{subscriber.fio}}</h5>
									<h5>{{subscriber.subtime}}</h5>
									<h5>{{subscriber.address}}</h5>
									<h5>{{subscriber.phone}}</h5>
									<h5>{{subscriber.summa}}</h5>
								{% endif %}
							</div>
			<form method="POST" action="https://checkout.paycom.uz/" class="m-auto">

			    <!-- Идентификатор WEB Кассы -->
			    <input type="hidden" name="merchant" value="5abf4e5fbbc2e835232fa45d"/>

			    <!-- Сумма платежа в тиинах -->
			    <input type="hidden" name="amount" value="{{invoise.amount}}00"/>

			    <!-- Поля Объекта Account -->
			    <input type="hidden" name="account[order_id]" value="{{invoise.id}}"/>

			    <!-- ==================== НЕ ОБЯЗАТЕЛЬНЫЕ ПОЛЯ ====================== -->
			    <!-- Язык. Доступные значения: ru|uz|en 
			         Другие значения игнорируются
			         Значение по умолчанию ru -->
			    <input type="hidden" name="lang" value="ru"/>

			    <!-- Валюта. Доступные значения: 643|840|860|978
			         Другие значения игнорируются
			         Значение по умолчанию 860
			         Коды валют в ISO формате
			         643 - RUB
			         840 - USD
			         860 - UZS
			         978 - EUR -->
			    <input type="hidden" name="currency" value="860"/>

			    <!-- URL возврата после оплаты или отмены платежа.
			         Если URL возврата не указан, он берется из заголовка запроса Referer.
			         URL возврата может содержать параметры, которые заменяются Paycom при запросе.
			         Доступные параметры для callback:
			         :transaction - id транзакции или "null" если транзакцию не удалось создадь
			         :account.{field} - поля объекта Account
			         Пример: https://your-service.uz/paycom/:transaction -->
			    <input type="hidden" name="callback" value="http://adju.uz/"/>
			    <!-- ================================================================== -->

			    <button type="submit" class="blue payBtn upp">{{helper.translate('Pay')}}</button>
			</form>							
						</div><!-- /. row -->
					</div><!-- /. column -->
				</div><!-- /. row -->
			</div><!-- /. alert-success -->
		</div><!-- /. main-content -->
	</div><!-- /. container -->
</section><!-- /. paycom-page -->

