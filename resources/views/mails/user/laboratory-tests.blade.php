@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => "/"])
    KompleteCare
@endcomponent
@endslot
<div style="text-align: center;"> <h2>Laboratory Tests</h2></div>
Hi {{ $user->name }}, Kindly find the laboratory tests you are required to undergo below.

@component('mail::table')
@foreach($laboratoryTestGroups as $laboratoryTestGroup)
<h4>{{ $laboratoryTestGroup->name }}</h4>
<ul>
@foreach($laboratoryTestGroup->laboratoryTest as $laboratoryTest)
<li> {{ $laboratoryTest['name'] }} </li>
@endforeach
</ul>
@endforeach
@endcomponent
Regards,<br>
KompleteCare.

@slot('footer')
 @component('mail::footer')
     © {{ date('Y')}} Anifowose Tobi.
 @endcomponent
    @endslot
@endcomponent


