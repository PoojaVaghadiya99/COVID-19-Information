<?php
try
{
	
    $file=file_get_contents("https://api.covid19api.com/summary");
    $data=json_decode($file,true);
    $length=count($data['Countries']);

    
    if(isset($_GET["check"]))
    {
      $select = $_GET['country'];
    }
}
catch(Exception $e)
{
?>
  <h3>Some Problem During Fetch Data Please Try Again !</h3>
<?php
}

    
  
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>COVID-19 Info</title>

    
    <!-- Bootstrap -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet" />
    
    <style type="text/css">
      *
      {
        font-family: 'Libre Baskerville', serif;
      }
      .counter
      {
        font-weight: bold;
        font-size: 14px;
      }
      p
      {
        font-size:14px;
      }
       @media (max-width: 600px) 
      {
          p { font-size: 12px; }
      }
      @media (max-width: 1000px) 
      {
          p { font-size: 12px; }
      }
      .input-field
      {
        width:50%;
      }
      .chart_wrap 
      {
          position: relative;
          overflow:hidden;
          overflow-x:auto;
          margin:10px;
      }


    </style>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
      jQuery(document).ready(function( $ ) {
          $('.counter').counterUp({
              delay: 10,
              time: 1000
          });
      });
    </script>


  </head>
  <body>

    <!-- Navbar -->

    <section>
      <nav class="navbar navbar-expand-lg bg-info navbar-dark Text-white sticky-top mb-3">
        <a class="navbar-brand" href="#">COVID-19 Info</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
    </section>

    <!-- Global Info -->

    <section>
      <div class="container-fluid">
        <div class="row text-center">
            <div class="col-lg-12 col-md-12 col-12">
                <p><strong>Global</strong></p>
                <hr class="w-50 mx-auto" />
            </div>
        </div>
        <div class="row text-center">
            <div class="col-lg-4 col-md-4 col-4">
                <p>Total Confirmed</p>
                <p class="counter"><?php echo $data['Global']['TotalConfirmed']; ?></p>
                <hr class="w-50 mx-auto" />
            </div>
            <div class="col-lg-4 col-md-4 col-4">
                <p>Total Recovered</p>
                <p class="counter"><?php echo $data['Global']['TotalRecovered']; ?></p>
                <hr class="w-50 mx-auto" />
            </div>
            <div class="col-lg-4 col-md-4 col-4">
                <p>Total Deaths</p>
                <p class="counter"><?php echo $data['Global']['TotalDeaths']; ?></p>
                <hr class="w-50 mx-auto" />
            </div>
         </div>    
      </div>
    </section>

    <!-- Select Country -->

    <section>
      <div class="container">
        <div class="row text-center">
            <div class="col-lg-12 col-md-12 col-12 d-flex justify-content-center">
              <form class="form-inline" action="#" method="get">
                <div class="form-group">
                  <select name="country" width="100%" class="form-control">
                    <option selected="Select">Select</option>
                    <?php
                      for($i=0;$i<$length;$i++)
                      {
                        $c=$data['Countries'][$i]['Country'];
                    ?>
                        <option value="<?php  echo $c; ?>"><?php  echo $c; ?></option>
                    <?php 
                      }
                    ?>
                  </select>
                <button type="submit" name="check" class="btn btn-info mx-5 my-2">Check Details</button>
                </div>
              </form>
            </div>
          </div>
      </div>
    </section>

    <!-- Country Info -->

    <?php

    if(isset($_GET["check"]))
    {

    ?>

    <section>
      <div class="container-fluid">
         <?php
        for($i=0;$i<$length;$i++)
        {
          if($data['Countries'][$i]['Country'] == $select)
          {
        ?>
          <div class="row text-center">
              <div class="col-lg-6 col-md-6 col-6">
                  <p><strong><?php echo $data['Countries'][$i]['Country']; ?></strong></p>
                  <hr class="w-50 mx-auto" />
              </div>
              <div class="col-lg-6 col-md-6 col-6">
                    <p><strong><?php echo $data['Countries'][$i]['Date']; ?></strong></p>
                  <hr class="w-50 mx-auto" />
              </div>
          </div>
          <div class="row text-center">
              <div class="col-lg-4 col-md-4 col-4">
                  <p>Total Confirmed</p>
                  <p class="counter"><?php echo $data['Countries'][$i]['TotalConfirmed']; ?></p>
                  <hr class="w-50 mx-auto" />
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                  <p>Total Recovered</p>
                  <p class="counter"><?php echo $data['Countries'][$i]['TotalRecovered']; ?></p>
                  <hr class="w-50 mx-auto" />
              </div>
              <div class="col-lg-4 col-md-4 col-4">
                  <p>Total Deaths</p>
                  <p class="counter"><?php echo $data['Countries'][$i]['TotalDeaths']; ?></p>
                  <hr class="w-50 mx-auto" />
              </div>
               <div class="col-lg-4 col-md-4 col-4">
                  <p>New Confirmed</p>
                  <p class="counter"><?php echo $data['Countries'][$i]['NewConfirmed']; ?></p>
                  <hr class="w-50 mx-auto" />
              </div>
               <div class="col-lg-4 col-md-4 col-4">
                  <p>New Recovered</p>
                  <p class="counter"><?php echo $data['Countries'][$i]['NewRecovered']; ?></p>
                  <hr class="w-50 mx-auto" />
              </div>
               <div class="col-lg-4 col-md-4 col-4">
                  <p>New Deaths</p>
                  <p class="counter"><?php echo $data['Countries'][$i]['NewDeaths']; ?></p>
                  <hr class="w-50 mx-auto" />
              </div>

          <?php     
              }
           }
           ?>
              
      </div>
      </div>
    </section>

    <?php

    }

    ?>
    <!-- Map -->

    <?php

    if(isset($_GET["check"]))
    {

    if($select != "Select")
    {
    ?>

    <section>
      <div class="container">
        <div class="chart_wrap row text-center">
          <div class="col-lg-12 col-md-12 col-12">
            <div id="barchart_material" style="width: 100%; height: 250px;"></div>
          </div>
        </div>
      </div>
    </section>

    <?php

    }
  }



    ?>

    <div class="mt-5"></div>

    <!-- Footer -->

    <section>
      <div class="container-fluid bg-info Text-white py-5 text-center mt-5">
        <h2>#StayHome</h2>
      </div>
    </section>


    <!-- Bootstrap -->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
  
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
    
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Total Case', 'Total Confirmed', 'Total Recoverd', 'Total Deaths'],
      <?php
      for($i=0;$i<$length;$i++)
      {
        if($data['Countries'][$i]['Country'] == $select)
       {
        echo "['".$data['Countries'][$i]['Country']."',
          ".$data['Countries'][$i]['TotalConfirmed'].",
          ".$data['Countries'][$i]['TotalRecovered'].",
          ".$data['Countries'][$i]['TotalDeaths']."],";
       }
      }
      
      ?>
        ]);

        var options = {
          chart: {
            title: 'COVID-19 <?php echo $select; ?> Case Chart',
            subtitle: '',
          },
          bars: 'horizontal' ,// Required for Material Bar Charts.
      hAxis: {
            format: 'decimal'
          }
        };
    
    

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
   
    </script>

    <!-- Counter Up -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="jquery.counterup.min.js"></script>

    <!-- Bootstrap -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  </body>
</html>