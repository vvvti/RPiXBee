<?php
$myfile = fopen("/var/www/html/data", "r") or die("Unable to open file!");
while(!$data = fread($myfile,10))
{
	sleep(1000);
}
$Temp = substr($data,0,4);
$Hudi = substr($data,5,4);
fclose($myfile);
?>

<head>
    <script src="RGraph.common.core.js"></script>
    <script src="RGraph.common.dynamic.js"></script>
    <script src="RGraph.meter.js"></script>
<style>
* {
  box-sizing: border-box;
}

.box {
  float: left;
  width: 50%;
  margin: 20px;
  width: 450px; 
  height: 450px;
  background-color: white;
  border-radius: 250px;
  text-align: center;
  font-family: Arial;
  box-shadow: 0px 0px 25px gray;
  border: 10   px solid #ddd;
}
.box b{
  font-size: 20pt;
}
</style>

</head>
<body>
       
    <div class="box" >
        <canvas id="temperatura" width="450" height="350">[No canvas support]</canvas>
        <b>Temperatura <?php echo $Temp ?> (°C)</b>
    </div>

    <div class="box" >
        <canvas id="wilgotnosc" width="450" height="350">[No canvas support]</canvas>
        <b>Wilgotność <?php echo $Hudi ?> (%)</b>
    </div>

    <script>
                    meter = new RGraph.Meter({
                        id: 'temperatura',
                        min: 0,
                        max: 50,
                        value: 0,
                        options: {
                            border: false,
                            tickmarksSmallCount: 0,
                            tickmarksLargeCount: 0,
                            anglesStart: RGraph.HALFPI + (RGraph.HALFPI / 1.5),
                            anglesEnd: RGraph.TWOPI + RGraph.HALFPI - (RGraph.HALFPI / 1.5),
                            segmentsRadiusStart: 140,
                            textSize: 16,
                            colorsRanges: [
                                [0,25,'Gradient(#0c0:#cfc:#0c0)'],
                                [25,35,'Gradient(yellow:#ffc:yellow)'],
                                [35,50,'Gradient(red:#fcc:red)'],
                                
                            ],
                            needleRadius: 110,
                            marginBottom: 135
                        }
                    });

                    meter2 = new RGraph.Meter({
                        id: 'wilgotnosc',
                        min: 0,
                        max: 90,
                        value: 0,
                        options: {
                            border: false,
                            tickmarksSmallCount: 0,
                            tickmarksLargeCount: 0,
                            anglesStart: RGraph.HALFPI + (RGraph.HALFPI / 1.5),
                            anglesEnd: RGraph.TWOPI + RGraph.HALFPI - (RGraph.HALFPI / 1.5),
                            segmentsRadiusStart: 140,
                            textSize: 16,
                            colorsRanges: [
                                [0,90,'Gradient(blue:#cfc:blue)'],
                                
                            ],
                            needleRadius: 110,
                            marginBottom: 135
                        }
                    });

                    meter.value =<?php echo $Temp ?>;
                    meter.draw();

                    meter2.value =<?php echo $Hudi ?>;
                    meter2.draw();

                    //setTimeout(function(){location.reload()}, 2000);
                    
   
    </script>

</body>