<table width="100%">
@php
$jumlah_baris = 8;
$i = 0;
@endphp
@while ($i < $jumlah_baris)
@php
  $i++;
@endphp
<tr>
<td>
  <center>
      <br />
      {{ $product->name }}
      <br />
      <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->sku, 'C128',2,53,array(1,1,1), true)}}" alt="barcode" />
      
      <br />
      Rp. {{ number_format($product->price,0,',','.') }}
      <br />
  </center>
</td>
<td>&nbsp;</td>
<td>
  <center>
       <br />
       {{ $product->name }}
       <br />
       <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product->sku, 'C128',2,53,array(1,1,1), true)}}" alt="barcode" />
       
        <br />
        Rp. {{ number_format($product->price,0,',','.') }}
        <br />
  </center>
</td>
 </tr>
 @endwhile
  </table>

  
    
