@component('mail::message')
# 20% discount going on!
# It applies for all products!
 
Click below button for more information

@component('mail::button', ['url' => route('emailoffer'), 'color' => 'success'])
click
@endcomponent
 

 
Thanks,<br>
{{ config('app.name') }}
@endcomponent