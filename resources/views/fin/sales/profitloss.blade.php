@inject('fin', 'App\Classes\Fin\FinClass')
@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Profit &amp; Loss</div>
                <div class="card-body">
                
                
                
                
<table border="0" cellspacing="1" cellpadding="2" class="table table-borderless table-responsive" >
  <tbody>
    
    <tr class="table-active">
      <th colspan="3" class="font-weight-bolder">{{ $tahun }}</th>
      @for($i=1; $i<=12; $i++)
      <td class="font-weight-bolder">{{ Carbon\Carbon::createFromFormat('m', $i)->formatLocalized('%b') }}</td>
      @endfor
      <td class="font-weight-bolder"><i>Total YTD</i></td>
      <td class="font-weight-bolder">Growth Rate</td>
      <td class="font-weight-bolder">Projected</td>
    </tr>
    <tr>
      <td colspan="18" class="font-weight-bolder">
      <hr>
      Income
      <hr>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Revenue</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    @foreach($fin_categories_revenues as $fin_categories_revenue)
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>{{ $fin_categories_revenue->name }}</td>
      @php
      		$fin_categories_revenue_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      	@php
        	$fin_categories_revenue_per = $fin::total_per_month($fin_categories_revenue->id,$tahun,$i);
            $fin_categories_revenue_subtotal += $fin_categories_revenue_per;
        @endphp
      	<td style="background-color:#FEFEEF">{{ $fin_categories_revenue_per }}</td>
      @endfor
      <td class="font-weight-bolder"><i>{{ $fin_categories_revenue_subtotal }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    @endforeach
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="16"><hr></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Total Sales</td>
      @php
      	$revenue_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      	@php
      		$revenue_per = $fin::total_per_month_by_type('Revenue',$tahun,$i);
            $revenue_subtotal += $revenue_per;
      	@endphp
      	<td style="background-color:#FEFEEF">{{ $revenue_per }}</td>
      @endfor
      <td class="font-weight-bolder"><i>{{ $revenue_subtotal }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Cost of sales</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    @foreach($fin_categories_cogs as $fin_categories_cog)
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>{{ $fin_categories_cog->name }}</td>
      @php
      		$fin_categories_cog_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      	@php
        	$fin_categories_cog_per = $fin::total_per_month($fin_categories_cog->id,$tahun,$i) * -1;
            $fin_categories_cog_subtotal += $fin_categories_cog_per;
        @endphp
      	<td style="background-color:#FEFEEF">{{ $fin_categories_cog_per }}</td>
      @endfor
      <td class="font-weight-bolder"><i>{{ $fin_categories_cog_subtotal }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    @endforeach
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="16"><hr></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Total cost of sales</td>
      @php
      	$cogs_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      	@php
      		$cogs_per = $fin::total_per_month_by_type('Cost of Goods Sold',$tahun,$i);
            $cogs_subtotal += $cogs_per;
      	@endphp
      	<td style="background-color:#FEFEEF">{{ $cogs_per*-1 }}</td>
      @endfor
      <td class="font-weight-bolder"><i>{{ $cogs_subtotal*-1 }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Gross Margin</td>
      <td>&nbsp;</td>
      @php
      	$gross_margin_total = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      @php
      
      	$revenue_per = $fin::total_per_month_by_type('Revenue',$tahun,$i);
        $cogs_per = $fin::total_per_month_by_type('Cost of Goods Sold',$tahun,$i);
        $gross_margin = $revenue_per + $cogs_per;
        
        $gross_margin_total += $gross_margin;
        
        $gross_margin_print = $gross_margin;
        if($gross_margin<0) $gross_margin_print = '('. $gross_margin*-1 .')';
        
      @endphp
      <td class="font-weight-bolder" style="background-color:#FEFEEF">{{ $gross_margin_print }}</td>
      @endfor
      @php
      	$gross_margin_total_print = $gross_margin_total;
        if($gross_margin_total<0) $gross_margin_total_print = '('. $gross_margin_total*-1 .')';
      @endphp
      <td class="font-weight-bolder"><i>{{ $gross_margin_total_print }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18" class="font-weight-bolder">
      <hr>
      Expenses
      <hr>
      </td>
    </tr>
     @foreach($fin_categories_expenses as $fin_categories_expense)
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>{{ $fin_categories_expense->name }}</td>
      @php
      		$fin_categories_expense_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      	@php
        	$fin_categories_expense_per = $fin::total_per_month($fin_categories_expense->id,$tahun,$i) * -1;
            $fin_categories_expense_subtotal += $fin_categories_expense_per;
        @endphp
      	<td style="background-color:#FEFEEF">{{ $fin_categories_expense_per }}</td>
      @endfor
      <td class="font-weight-bolder"><i>{{ $fin_categories_expense_subtotal }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    @endforeach
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="16"><hr></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Total expenses</td>
      @php
      	$expenses_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      	@php
      		$expenses_per = $fin::total_per_month_by_type('Expenses',$tahun,$i);
            $expenses_subtotal += $expenses_per;
      	@endphp
      	<td class="font-weight-bolder" style="background-color:#FEFEEF">{{ $expenses_per*-1 }}</td>
      @endfor
      <td class="font-weight-bolder"><i>{{ $expenses_subtotal*-1 }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="font-weight-bolder">Total Profit (Loss)</td>
      @php
      	$profit_loss_total = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      @php
      	$revenue_per = $fin::total_per_month_by_type('Revenue',$tahun,$i);
        $cogs_per = $fin::total_per_month_by_type('Cost of Goods Sold',$tahun,$i);
        $gross_margin = $revenue_per + $cogs_per;
      	
        $expenses_per = $fin::total_per_month_by_type('Expenses',$tahun,$i);
        
        $profit_loss = $gross_margin + $expenses_per;
        
        $profit_loss_total += $profit_loss;
        
        $profit_loss_print = $profit_loss;
        if($profit_loss<0) $profit_loss_print = '('. $profit_loss*-1 .')';
      @endphp
      <td class="font-weight-bolder" style="background-color:#FEFEEF">{{ $profit_loss_print }}</td>
      @endfor
      @php
      	$profit_loss_total_print = $profit_loss_total;
        if($profit_loss_total<0) $profit_loss_total_print = '('. $profit_loss_total*-1 .')';
      @endphp
      <td class="font-weight-bolder"><i>{{ $profit_loss_total_print }}</i></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
  </tbody>
</table>



 </div>
            </div>
        </div>
    </div>
@endsection
