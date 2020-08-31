<style type="text/css">
 @page { margin: 0px; }
</style>
@php
$jumlah_baris = 6;
$i = 0;
@endphp
@while ($i < $jumlah_baris)
@php
  $i++;
@endphp


  <center style="margin-top:15px;">
      <div>
      {{ $product->name }}
      </div>
      <div>
      <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->sku, 'C128',2,53,array(1,1,1), true)}}" alt="barcode" />
      </div>
      <div>
      Rp. {{ number_format($product->price,0,',','.') }}
     </div>
  </center>
 @endwhile


  
    
