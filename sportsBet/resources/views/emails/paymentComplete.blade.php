Dear {{ $buyer_name }},<br><br>

Your payment to {{ config('app.name') }} has been made successfuly.<br>
Order: {{ $order_id }}<br>
Card holder: {{ $card_holder }}<br>
Card number: {{ $card_number }}<br>
Total charged: {{ $currency }} {{ $item_price}}<br>
Plan: {{ $item_name }}<br><br>

Thanks for your continued support,<br>
{{ config('app.name') }}

