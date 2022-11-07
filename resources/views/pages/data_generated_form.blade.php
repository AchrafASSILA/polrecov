<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');

  body{
    font-family: 'Roboto', sans-serif;
  }
  .table {
  color: $gray-800;

  thead {
    th, td {
      color: #37374e;
      font-weight: 700;
      font-size: 11px;
      letter-spacing: .5px;
      text-transform: uppercase;
      border-bottom-width: 1px;
      border-top-width: 0;
      padding: 0 ;
    }
  }

  tbody tr {
    background-color: $white-5;

    th {
      font-weight: 500;
    }
  }
  .total span:nth-child(1){
    font-weight: bold;
    text-transform: uppercase;
    
  }
  /* .total span:nth-child(1){
    text-emphasis: right;
  } */
  .total span{
    border: 1px solid black;
    color: black;
    width: 60px;
}
  th, td {
    /* line-height: 1.462; */
  }
}

.table-striped tbody tr:nth-of-type(2n+1) {
  background-color: rgba(238, 238, 247, 0.5);
}

.table-bordered thead {
  th, td {
    border-top-width: 1px;
    background-color: $white-5;
  }
}

.table {
  width: 100%;
  margin-bottom: 1rem;
  color: $default-color;
}

thead {
    display: table-header-group;
    vertical-align: middle;
    border-color: inherit;
}
thead {
  display: table-row-group;
}

tr{
  width: 25%;
  display: table-row;
    vertical-align: inherit;
    border-color: inherit;

}
.wd-15p {
    width: 15%;
}
th{
  padding: 5px ;
  vertical-align: bottom;
  display: table-cell;
}
th, td {
  border: 1px solid black;
}
td{
  padding: 5px 2px 5px 5px;
    vertical-align: top;
    line-height: 1.462;
}


    </style>

</head>
<body style="position: relative;font-family: 'Roboto', sans-serif;">
    <div class="container">
      <img width="180px" src="{{ public_path('assets/img/brand/polassur.png')}}" alt="">
      <h3 style="text-align: center;font-size: 15.5px;margin:0">RELEVE DES PRIMES NON REGLEES</h3>
      <br><br>
      @foreach ($receipts as $key => $recs)
      
      
      <div class="table">
        <h3 style="font-size: 12px;margin-left: 30px;margin-bottom: 30px;margin-top:30px;">Souscripteur: {{$key}}</h3>
        <table class="table table-invoice border table-bordered text-md-nowrap mb-0" cellspacing="0" cellpadding="0"  style="color: black">
            <thead>
              <tr>
                <tr>
                  <th style="text-align: center;width:100px;background:#79b7d1" class="wd-15p border-bottom-0">N Quittance</th>
                  <th style="text-align: center;width:100px;background:#79b7d1" class="wd-15p border-bottom-0">N Police</th>
                  <th style="text-align: center;width:100px;background:#79b7d1" class="wd-15p border-bottom-0">Categorie/Branche/Risque</th>
                  <th style="text-align: center;width:100px;background:#79b7d1" class="wd-15p border-bottom-0">Du</th>
                  <th style="text-align: center;width:100px;background:#79b7d1" class="wd-15p border-bottom-0">Au</th>
                  <th style="text-align: center;width:100px;background:#79b7d1" class="wd-15p border-bottom-0">Prime Total</th>
                    </tr>
              </tr>
            </thead>
            <tbody>
              @php
              $total = 0;
          @endphp
          @foreach ($recs as $receipt)
                <tr>
                  <td  style="text-align: center" >{{$receipt->quitance}}</td>
                  <td style="text-align: center">{{$receipt->police}}</td>
                  <td style="text-align: left" >{{$receipt->categorie }}</td>
                  <td style="text-align: center">{{date('d/m/Y', strtotime( $receipt->du))}}</td>
                  <td style="text-align: center" >{{date('d/m/Y', strtotime( $receipt->au))}}</td>
                  <td style="text-align: right">{{ number_format($receipt->prime_total, 2,'.',' ')}}</td>
                  </tr>
                  @php
                  $total += $receipt->prime_total;
                  @endphp
                @endforeach
            </tbody>
            <tfoot >
              <tr>
                <th id="total" style="border: none"></th>
                <th id="total" style="border: none"></th>
                <th id="total" style="border: none"></th>
                <th id="total" style="border: none"></th>
                <th id="total" >Total </th>
                <td style="text-align: right"><?php echo number_format($total, 2 ,'.',' ')?></td>
              </tr>
            </tfoot>
          </table>
        </div>
        @endforeach
        <div style="margin-top:220px;text-align:right;padding-right:5px;font-size:15px;position: absolute;bottom:0;right:0">
           édité le : {{date('d/m/Y', strtotime( Carbon\Carbon::now()))}}
        </div>
</body>
</html>



