<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
/*
#################################################
This is part of the UI framework being developed.
#################################################
*/
//---------


/* body {
  padding: 0;
  margin: 0;
  height: 100%;
  font-family: 'Roboto', sans-serif;
}

.title {
  text-align:center;
  padding: 40px 0;
  font-size: 40px;
  font-weight: 300;
  color: $primary;
}
.total span{
  padding: 5px 41px;
    border: 1px solid black;
    color: black;
}
.wrapper {
  background-color: $gray0;
  width: 100%;
  min-height: 100vh;
  
  .line {
    width: 50%;
    margin: 50px auto 0 auto;
    height: 1px;
    background-color: black;
  }
}

.table {
  width: 100%;
  margin: 0 auto;
  .header{
      font-size: 24px;
    font-weight: 300;
  }
  
  table {
    width: 100%;
    font-size: 16px;
    background-color: white;
    
      
    }
    
  }
    
  th{
    padding: 9px 15px;
    min-width: 80px;
    border: 1px solid black;
  }
  td{
    padding: 12px;
    border: 1px solid black;
    color: black;
  } */

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
      padding: 0 15px 5px;
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
  padding: 5px 41px;
    border: 1px solid black;
    color: black;
    width: 60px;
}
  th, td {
    padding: 9px 15px;
    line-height: 1.462;
  }
}

.table-striped tbody tr:nth-of-type(2n+1) {
  background-color: rgba(238, 238, 247, 0.5);
}

.table-bordered thead {
  th, td {
    border-top-width: 1px;
    padding-top: 7px;
    padding-bottom: 7px;
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
  padding: 9px 15px;
  vertical-align: bottom;
  display: table-cell;
}
th, td {
  border: 1px solid black;
}
td{
  padding: 0.75rem;
    vertical-align: top;
    line-height: 1.462;
}


    </style>

</head>
<body style="position: relative">
    <div class="container">
      <img width="180px" src="{{ public_path('assets/img/brand/polassur.png')}}" alt="">
      <h3 style="text-align: center;font-size: 20px;">RELEVE DES PRIMES NON REGLEES</h3>
      <br><br>
      @foreach ($receipts as $key => $recs)
      
      
      <div class="table">
        <h3 style="font-size: 15px;margin-left: 30px;margin-bottom: 30px;margin-top:30px;">Souscripteur: {{$key}}</h3>
        <table class="table table-invoice border table-bordered text-md-nowrap mb-0" cellspacing="0" cellpadding="0"  style="color: black">
            <thead>
              <tr>
                <tr>
                  <th style="text-align: center;width:100px;" class="wd-15p border-bottom-0">N Quittance</th>
                  <th style="text-align: center;width:100px;" class="wd-15p border-bottom-0">N Police</th>
                  <th style="text-align: center;width:100px;" class="wd-15p border-bottom-0">Categorie/Branche/Risque</th>
                  <th style="text-align: center;width:100px;" class="wd-15p border-bottom-0">Du</th>
                  <th style="text-align: center;width:100px;" class="wd-15p border-bottom-0">Au</th>
                  <th style="text-align: center;width:100px;" class="wd-15p border-bottom-0">Prime Total</th>
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
                  <td style="text-align: right">{{ number_format($receipt->prime_total, 2)}}</td>
                  </tr>
                  @php
                  $total += $receipt->prime_total;
                  @endphp
                @endforeach
            </tbody>
            
          </table>
          <div style="margin-top: 15px;text-align: right;" class="total">
                                        
            <span>total</span>
            <span style="padding-right: 5px">
              <?php echo number_format($total, 2)?>
            </span>
        </div>
        @endforeach
        <div style="margin-top:220px;text-align:right;padding-right:5px;font-size:20px;position: absolute;bottom:0;right:0">
           édité le : {{date('d/m/Y', strtotime( Carbon\Carbon::now()))}}
        </div>
</body>
</html>



