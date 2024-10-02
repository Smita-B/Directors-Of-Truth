<?php
$conn = mysqli_connect("localhost","root","","POLICE");
if(!$conn)
{
    echo "Problem in database connection..." .mysqli_error();
}
else{
    $sql = "SELECT * FROM fuzzy ";
    $result = mysqli_query($conn,$sql);
    $chart_data = "";
    while($row = mysqli_fetch_array($result))
    {
        $PSNAME[] = $row['PSNAME'];
        $GRAPH[] = $row['danger'];
    }
    /*$sql1 = "SELECT * FROM complaint_status";
    $result1 = mysqli_query($conn,$sql1);
    $chart_data = "";
    while($row = mysqli_fetch_array($result1))
    {
        $CNO[] = $row['COMPLAINT_NO'];
        $STATUS[] = $row['STATUS'];
    }*/

}
session_start();
$pname=$_SESSION['ps'];
$result1=mysqli_query($conn,"select * from fuzzy where PSNAME='$pname'");
while($rows = mysqli_fetch_array($result1))
{
  $police=$rows['danger'];
  $comment=$rows['comment'];
  $ccrime=$rows['ccrime'];
  $creport=$rows['creport'];
  $cmissing=$rows['cmissing'];
  $cpdanger=$rows['cpdanger'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
        <script type="text/javascript" src="d3.js"></script>
          <script nonce="undefined" src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script type="text/javascript" src="gauge.js"></script>
    <style>
    .chart--container {
      width: 100%;
      height: 100%;
      min-height: 470px;
    }

    .zc-ref {
      display: none;
      
    }
    .button {
        background-color: #410613;
        border: none;
        color: white;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 4px 2px;
        cursor: pointer;
      }
      
  </style>
    </head>
    <body bgcolor="#fff5f0">
        <center><div style="width:90%;text-align:center">
        <h1>Danger Prediction </h1> 
        <center><table>
            <tr>
                <th><a class='button' href='front.php'><CENTER>Back To Menu</CENTER></a></th>
                <th><font color="#fff5f0">Tanisha Dey</font></th>
                <th><font color="#fff5f0">Tanisha Dey</font></th>
                <th><font color="#fff5f0">Tanisha Dey</font></th>
                <th><font color="#fff5f0">Tanisha Dey</font></th>
            </tr>
            <tr>           
                <td rowspan="6" colspan="5"><div id="myChart" class="chart--container"></div></td>
                <td rowspan="6" colspan="5"><b><font face="Helvetica"><?php echo "Police station name: </b>".$pname; ?><br><br><b>
                Past Crime Level: </font><?php 
                if($ccrime=="Very Low" || $ccrime=="Low")
                {
                  ?>
                  <font face="Helvetica" color="#42f569">
                  <?php
                  echo $ccrime;
                  
                }
                ?> </font>
                <?php
                if($ccrime=="Medium" )
                {
                  ?>
                  <font face="Helvetica" color="#f5ad42">
                  <?php
                  echo $ccrime;
                  
                }
                ?> </font>
                <?php
                if($ccrime=="Very High" || $ccrime=="High")
                {
                  ?>
                  <font face="Helvetica" color="#e61c0e">
                  <?php
                  echo $ccrime;
                  
                }
                ?> </font>
                <br><br>
                <font face="Helvetica">Reported Crime Level: </font><?php 
                if($creport=="Very Low" || $creport=="Low")
                {
                  ?>
                  <font face="Helvetica" color="#42f569">
                  <?php
                  echo $creport;
                  
                }
                ?> </font>
                <?php
                if($creport=="Medium" )
                {
                  ?>
                  <font face="Helvetica" color="#f5ad42">
                  <?php
                  echo $creport;
                  
                }
                ?> </font>
                <?php
                if($creport=="Very High" || $creport=="High")
                {
                  ?>
                  <font face="Helvetica" color="#e61c0e">
                  <?php
                  echo $creport;
                  
                }
                ?> </font> <br><br>
                <font face="Helvetica">Reported Missing Level: </font><?php 
                if($cmissing=="Very Low" || $cmissing=="Low")
                {
                  ?>
                  <font face="Helvetica" color="#42f569">
                  <?php
                  echo $cmissing;
                  
                }
                ?> </font>
                <?php
                if($cmissing=="Medium" )
                {
                  ?>
                  <font face="Helvetica" color="#f5ad42">
                  <?php
                  echo $cmissing;
                  
                }
                ?> </font>
                <?php
                if($cmissing=="Very High" || $cmissing=="High")
                {
                  ?>
                  <font face="Helvetica" color="#e61c0e">
                  <?php
                  echo $cmissing;
                  
                }
                ?> </font>  <br><br>
                <font face="Helvetica">Perceived Danger Level: </font><?php 
                if($cpdanger=="Very Low" || $cpdanger=="Low")
                {
                  ?>
                  <font face="Helvetica" color="#42f569">
                  <?php
                  echo $cpdanger;
                  
                }
                ?> </font>
                <?php
                if($cpdanger=="Medium" )
                {
                  ?>
                  <font face="Helvetica" color="#f5ad42">
                  <?php
                  echo $cpdanger;
                  
                }
                ?> </font>
                <?php
                if($cpdanger=="Very High" || $cpdanger=="High")
                {
                  ?>
                  <font face="Helvetica" color="#e61c0e">
                  <?php
                  echo $cpdanger;
                  
                }
                ?> </font> <br><br><br></font>
                <font face="Helvetica"><i>Danger level is: </font><?php 
                if($comment=="Very Low" || $comment=="Low")
                {
                  ?>
                  <font face="Helvetica" color="#42f569">
                  <?php
                  echo $comment;
                  
                }
                ?> </font>
                <?php
                if($comment=="Medium" )
                {
                  ?>
                  <font face="Helvetica" color="#f5ad42">
                  <?php
                  echo $comment;
                  
                }
                ?> </font>
                <?php
                if($comment=="Very High" || $comment=="High")
                {
                  ?>
                  <font face="Helvetica" color="#e61c0e">
                  <?php
                  echo $comment;
                  
                }
                ?> </font>
                <b></i>

            </td>
            </tr>            
        </table></center>
        <h1 class="page-header" >Location Security</h1>
            <canvas  id="chartjs_bar"></canvas></div> 
    </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($PSNAME); ?>,
                        datasets: [{
                            backgroundColor: ["#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02",
                            "#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02",
                            "#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02",
                            "#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02",
                            "#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02",
                            "#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02","#4c1a02"
                            ],
                            data:<?php echo json_encode($GRAPH); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',

                        scales : {
                          xAxes : [{
                            barPercentage : 1,
                            maxBarThickness: 1,
                            categoryPercentage : 1,
                                  
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                          }
                          }]
                        }
                    },
 
 
                }
                });
    </script>
<script>
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
    let chartConfig = {
      type: 'gauge',
      theme: 'classic',
      backgroundColor: '#fff5f0',
      scaleR: {
        values: '0:100:20',
        aperture: 270,
        backgroundColor: '#fff5f0',
        center: {
          backgroundColor: 'black',
          size: '15px',

        },
        guide: {
          alpha: 1,
          backgroundColor: 'black', // Set the interior color of the gauge so that it is solid black, not alternating colors
        },
        item: {
          color: 'black', // Set the color and font of the labels
          offsetR: -55, // Move the labels to the inside
          placement: 'inner',
        },
        lineColor: 'none',
        minorTick: {
          lineColor: 'black',
          placement: 'inner',
          size: '10px',
          visible: true,
        },
        minorTicks: 4,
        ring: {
          type: 'circle',
          rules: [{
              backgroundColor: 'green',
              borderWidth: '0px',
              rule: '%v<30',
            },
            {
              backgroundColor: 'yellow',
              borderWidth: '0px',
              rule: '%v>=30',
            },
            {
              backgroundColor: 'red',
              borderWidth: '0px',
              rule: '%v>=70',
            },
          ],
          size: '8px',
        },
        tick: {
          lineColor: 'black',
          lineWidth: '3px',
          size: '14px',
        },
      },
      labels: [{
        text: '<?php echo $police; ?>%',
        color: 'black bold',
        size: '20px',
        width: '6%',
        x: '47%',
        y: '76%',
      }, ],
      shapes: [{
        type: 'pie', // Add a second ring to the outside
        backgroundColor: 'black limeGreen',
        size: '190px',
        slice: 175,
        x: '50%',
        y: '54.0%',
        zIndex: 0,
      }, ],
      series: [{
        values: [<?php echo $police; ?>],
        backgroundColor: 'blue',
        csize: '10px', // Set the width of the needle
        shadow: false,
        size: '70px', // Set the length of the needle
      }, ],
    };

    zingchart.render({
      id: 'myChart',
      data: chartConfig,
      height: '100%',
      width: '100%',
    });
  </script></center>
</html>
