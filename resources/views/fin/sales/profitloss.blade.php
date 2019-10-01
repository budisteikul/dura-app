@inject('fin', 'App\Classes\Fin\FinClass')
@extends('layouts.app')
@section('content')
<table border="0" cellspacing="1" cellpadding="2" class="table table-borderless table-responsive" >
  <tbody>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
    <tr class="table-active">
      <th colspan="3">{{ $tahun }}</th>
      @for($i=1; $i<=12; $i++)
      <td>{{ Carbon\Carbon::createFromFormat('m', $i)->formatLocalized('%b') }}</td>
      @endfor
      <td>Total YTD</td>
      <td>Growth Rate</td>
      <td>Projected</td>
    </tr>
    <tr>
      <td colspan="18">
      <hr>
      Income
      <hr>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Revenue</td>
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
      	<td>{{ $fin_categories_revenue_per }}</td>
      @endfor
      <td>{{ $fin_categories_revenue_subtotal }}</td>
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
      <td>Total Sales</td>
      @php
      	$revenue_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      	@php
      		$revenue_per = $fin::total_per_month_by_type('Revenue',$tahun,$i);
            $revenue_subtotal += $revenue_per;
      	@endphp
      	<td>{{ $revenue_per }}</td>
      @endfor
      <td>{{ $revenue_subtotal }}</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Cost of sales</td>
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
      	<td>{{ $fin_categories_cog_per }}</td>
      @endfor
      <td>{{ $fin_categories_cog_subtotal }}</td>
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
      <td>Total cost of sales</td>
      @php
      	$cogs_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      	@php
      		$cogs_per = $fin::total_per_month_by_type('Cost of Goods Sold',$tahun,$i);
            $cogs_subtotal += $cogs_per;
      	@endphp
      	<td>{{ $cogs_per*-1 }}</td>
      @endfor
      <td>{{ $cogs_subtotal*-1 }}</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Gross Margin</td>
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
      <td>{{ $gross_margin_print }}</td>
      @endfor
      @php
      	$gross_margin_total_print = $gross_margin_total;
        if($gross_margin_total<0) $gross_margin_total_print = '('. $gross_margin_total*-1 .')';
      @endphp
      <td>{{ $gross_margin_total_print }}</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">
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
      	<td>{{ $fin_categories_expense_per }}</td>
      @endfor
      <td>{{ $fin_categories_expense_subtotal }}</td>
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
      <td>Total expenses</td>
      @php
      	$expenses_subtotal = 0;
      @endphp
      @for($i=1; $i<=12; $i++)
      	@php
      		$expenses_per = $fin::total_per_month_by_type('Expenses',$tahun,$i);
            $expenses_subtotal += $expenses_per;
      	@endphp
      	<td>{{ $expenses_per*-1 }}</td>
      @endfor
      <td>{{ $expenses_subtotal*-1 }}</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Total Profit (Loss)</td>
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
      <td>{{ $profit_loss_print }}</td>
      @endfor
      @php
      	$profit_loss_total_print = $profit_loss_total;
        if($profit_loss_total<0) $profit_loss_total_print = '('. $profit_loss_total*-1 .')';
      @endphp
      <td>{{ $profit_loss_total_print }}</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="18">&nbsp;</td>
    </tr>
  </tbody>
</table>
@endsection
