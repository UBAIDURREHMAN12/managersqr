@component('mail::message')
# Feedback Received

Guest feedback received for Room #{{$order->room_id}}, open dashboard to see the details



Thanks,<br>
{{ config('app.name') }}
@endcomponent
