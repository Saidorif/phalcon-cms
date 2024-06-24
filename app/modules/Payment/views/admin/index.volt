<div class="ui segment">
	<!-- <a href="{{ url.get() }}page/admin/add" class="ui button positive">
        <i class="icon plus"></i> {{ helper.at('Add New') }}
    </a> -->

    <table class="ui table very compact celled">
    	<thead>
    		<tr>
    			<th>№</th>
                <th>{{helper.at('Address')}}</th>
                <th>{{helper.at('Sphere')}}</th>
                <th>{{helper.at('FIO')}}</th>
                <th>{{helper.at('Amount')}}</th>
                <th>{{helper.at('Status')}}</th>
    			<th>{{helper.at('Edit')}}</th>
    		</tr>
    	</thead>
    	<tbody>
    	{% if orders %}
    		{% for index, order in orders %}
    		<tr>
    			<td>{{index + 1 }}</td>
                <td>{{order.member.address}}</td>
                <td>{{order.member.sphere}}</td>
                <td>{{order.member.fio}}</td>
    			<td>{{order.amount}}</td>
    			<td>{{order.status}}</td>
                <td><a href="{{url}}/payment/admin/order/{{order.id}}"><i class="ui icon edit"></i></a></td>
    		</tr>
    		{% endfor %}
    	{% endif %}
    	</tbody>
    </table>
</div>