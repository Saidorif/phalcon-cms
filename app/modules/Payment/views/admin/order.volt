<div class="ui segment">
	<a href="{{url}}/payment/admin" class="ui button">
		<i class="icon left arrow"></i>{{helper.translate('Back')}}
	</a>
</div>
<div class="ui segment">
	<div class="ui relaxed divided list">
		{% if order %}
	  <div class="item">
	    <i class="large github middle aligned icon"></i>
	    <div class="content">
	      <a class="header">{{ helper.translate('Address of company') }}</a>
	      <div class="description">{{order.member.address}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large github middle aligned icon"></i>
	    <div class="content">
	      <a class="header">{{ helper.translate('Sphere') }}</a>
	      <div class="description">{{order.member.sphere}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large github middle aligned icon"></i>
	    <div class="content">
	      <a class="header">{{ helper.translate('Fio') }}</a>
	      <div class="description">{{order.member.fio}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large github middle aligned icon"></i>
	    <div class="content">
	      <a class="header">{{ helper.translate('Status of company') }}</a>
	      <div class="description">{{order.member.company_status}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large github middle aligned icon"></i>
	    <div class="content">
	      <a class="header">{{ helper.translate('Website') }}</a>
	      <div class="description">{{order.member.website}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large github middle aligned icon"></i>
	    <div class="content">
	      <a class="header">{{ helper.translate('Phone') }}</a>
	      <div class="description">{{order.member.phone}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large github middle aligned icon"></i>
	    <div class="content">
	      <a class="header">{{ helper.translate('Email') }}</a>
	      <div class="description">{{order.member.email}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large github middle aligned icon"></i>
	    <div class="content">
	      <a class="header">{{ helper.translate('Count of employee') }}</a>
	      <div class="description">{{order.member.employee_count}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large github middle aligned icon"></i>
	    <div class="content">
	      <a class="header">{{ helper.translate('Category of company') }}</a>
	      <div class="description">{{helper.translate(order.member.category)}}</div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large github middle aligned icon"></i>
	    <div class="content">
	      <a class="header">{{ helper.translate('Thematic areas') }}</a>
	      <div class="description">
					{{helper.translate(order.member.thematic_areas)}}
	      </div>
	    </div>
	  </div>
	  <div class="item">
	    <i class="large github middle aligned icon"></i>
	    <div class="content">
	      <a class="header">{{ helper.translate('How to know') }}</a>
	      <div class="description">
					{{helper.translate(order.member.howtoknow)}}
	      </div>
	    </div>
	  </div>
	  {% endif %}
	</div>
</div>

<div class="ui segment">
	<h3>TRANSACTIONS</h3>
	<table class="ui table very compact celled">
		<thead>
			<tr>
				<th>CREATE TIME</th>
				<th>PERFORM TIME</th>
				<th>PAYMENT CODE</th>
				<th>STATUS</th>
			</tr>
		</thead>
		<tbody>
			{% if order.transactions %}
				{% for trs in order.transactions %}
				<tr>
					<td>{{trs.create_time}}</td>
					<td>{{trs.perform_time}}</td>
					<td>{{trs.payment_code}}</td>
					<td>{{trs.status}}</td>
				</tr>
				{% endfor %}
			{% endif %}
		</tbody>
	</table>
</div>
