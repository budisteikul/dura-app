Hi {{$rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','firstName')->first()->answer}},
Thank you for your booking with VERTIKAL TRIP

CUSTOMER INFO
Name : {{$rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','firstName')->first()->answer}} {{$rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','lastName')->first()->answer}}
Phone : {{$rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','phoneNumber')->first()->answer}}
Email : {{$rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','email')->first()->answer}}

TRAVEL DOCUMENTS
Receipt
Invoice-{{ $rev_shoppingcarts->confirmationCode }} [https://www.vertikaltrip.com/booking/invoice/{{ $rev_shoppingcarts->id }}]

Ticket
@foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
Ticket-{{ $shoppingcart_products->productConfirmationCode }} [https://www.vertikaltrip.com/booking/ticket/{{$shoppingcart_products->id}}]
@endforeach

VERTIKAL TRIP
Jl. Abiyoso VII No.190 Bantul ID
Whatsapp : +6285743112112
Email : guide@vertikaltrip.com