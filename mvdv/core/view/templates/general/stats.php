<?php
echo "<pre>";
var_dump($this->data);
echo "</pre>";
echo __LINE__ . "<br>" . __FILE__ . "<br>";
?>
<!--<form id="jaartalform" action="/Shop/sale/verkopenperjaar" method="POST">
    <label>Vul het jaartal in waarvoor u de verkopen wil zien</label>
    <input id="jaartal" name="jaartal" type="year" value="<?php // echo $this->data->years[0]['YEAR(timecreated)'];   ?>"> 
    <input id="jaartal" name="jaartal" type="text" length="4" value="<?php echo $this->data->jsvars->years[0]; ?>"> 
</form>-->
<svg id="visualisation" width="1200" height="500" style="outline:1px solid red"></svg>

<?php foreach ($this->data->jsvars as $name => $value) { ?>
                var <?php echo $name; ?> = "<?php
    if (is_string($value)) {
        echo $value;
    }
    else{
        echo "{";
        foreach($value as $key =>$value2){
              echo $key .":";
        }
           if (is_string($value2)) {  
          echo '"'.$value2.'"'.",";  
        }else{
            echo "{";
            foreach($value2 as $key2 =>$value3){
                  echo $key2 .":".$value3; 
            }
            echo "}";
        }
        echo "}";
    }
    ?>";
<?php } ?>
<style>
    .graphpath{
        opacity: 0.3;
    }
    .graphpath:hover{
        opacity:1;
    }
    
</style>


























<!--<script>
//verkopenperjaar
    jQuery('#jaartalform').submit(function(e){
    e.preventDefault();
            getVerkopenPerJaar(e.currentTarget)
    })
            function getVerkopenPerJaar(form){
            jQuery.ajax({
            url:form.action,
                    data:{
                    jaartal:jQuery('#jaartal').val()
                    },
                    type:"POST"
            }).done(function(data){
            data = JSON.parse(data);
                    var newDataProfits = [];
                    var newDataSales = [];
                    data.forEach(function(item){
                    var obj = {};
                            obj.profit = item.totaalaankoopprijsintijd;
                            obj.yearmonth = item["MONTH(timecreated)"];
                            newDataProfits.push(obj);
                            var obj2 = {};
                            obj2.profit = item.totaalverkoopprijsintijd;
                            obj2.yearmonth = item["MONTH(timecreated)"];
                            newDataSales.push(obj2);
                    })
                    //Clear chart
                    d3.selectAll("svg .graphpath").remove()
                    //rebuild chart with new data
                    vis.append('svg:path')
                    .attr('d', lineGen(newDataProfits))
                    .attr('stroke', 'green')
                    .attr('stroke-width', 4)
                    .attr('fill', 'none')
                    .attr("class", 'graphpath');
                    vis.append('svg:path')
                    .attr('d', lineGen(newDataSales))
                    .attr('stroke', 'blue')
                    .attr('stroke-width', 2)
                    .attr("class", 'graphpath')
                    .attr('fill', 'none');
            })
            }
</script>
<script>
    //reference tutorial 
    //http://code.tutsplus.com/tutorials/building-a-multi-line-chart-using-d3js--cms-22935
    //data for the chart
    //Sample data
    var dataProfits = [
<?php foreach ($this->data->totalenpermaand as $totaalpermaand) { ?>
        {
        "profit":"<?php echo $totaalpermaand["totaalverkoopprijsintijd"]; ?>",
                "yearmonth":"<?php echo $totaalpermaand["MONTH(timecreated)"]; ?>"
        },
<?php } ?>
    ]
            var dataSales = [
<?php foreach ($this->data->totalenpermaand as $totaalpermaand) { ?>
                {
                "profit":"<?php echo $totaalpermaand["totaalaankoopprijsintijd"]; ?>",
                        "yearmonth":"<?php echo $totaalpermaand["MONTH(timecreated)"]; ?>"
                },
<?php } ?>
            ]

            //general setup for the chart
            var vis = d3.select("#visualisation"),
            WIDTH = 1200,
            HEIGHT = 500,
            MARGINS = {
            top: 20,
                    right: 20,
                    bottom: 20,
                    left: 70
            }
    ,
            //range and domain of chart x axis
            xScale = d3.scale.linear().range([MARGINS.left, WIDTH - MARGINS.right]).domain(["1", "12"])
            //range and domain of chart y axis
            var highestSaleAmount =<?php echo $this->data->highestSaleAmount["MAX(somverkoopprijsintijd)"] ?>;
            yScale = d3.scale.linear().range([HEIGHT - MARGINS.top, MARGINS.bottom]).domain([0, highestSaleAmount + 100 ]),
            //build the axis
            xAxis = d3.svg.axis()
            .scale(xScale),
            yAxis = d3.svg.axis()
            .orient("left")//so it is on left side
            .scale(yScale);
            //append and position x axis to chart
            vis.append("svg:g")
            .attr("transform", "translate(0," + (HEIGHT - MARGINS.bottom) + ")")//position

            .call(xAxis); //append x axis data
//append yaxis
            vis.append("svg:g").attr("transform", "translate(" + (MARGINS.left) + ",0)").call(yAxis);
//plottin data on chart
            var lineGen = d3.svg.line()
            .x(function (d) {
            return xScale(d.yearmonth);
            })
            .y(function (d) {
            return yScale(d.profit);
            })
            .interpolate("basis");
            vis.append('svg:path')
            .attr('d', lineGen(dataProfits))
            .attr('stroke', 'green')
            .attr('stroke-width', 4)
            .attr('fill', 'none')
            .attr("class", 'graphpath');
            vis.append('svg:path')
            .attr('d', lineGen(dataSales))
            .attr('stroke', 'blue')
            .attr('stroke-width', 4)
            .attr("class", 'graphpath')
            .attr('fill', 'none');</script>
<svg id="chart"></svg>
<div>
    Totaal aankoopprijs: € <?php echo $this->data->totalen['totaalaankoopprijsintijd']; ?>

</div>
<div>
    Totaal verkoopprijs: € <?php echo $this->data->totalen['totaalverkoopprijsintijd']; ?>

</div>

<?php
$datastringtotaalaankoopprijs = '';
$datastringtotaalverkoopprijs = '';
foreach ($this->data->totalenpermaand as $totaalpermaand) {
    $datastringtotaalaankoopprijs.= $totaalpermaand['totaalaankoopprijsintijd'] . ",";
    $datastringtotaalverkoopprijs.= $totaalpermaand['totaalverkoopprijsintijd'] . ",";
}
$datastringtotaalaankoopprijs = rtrim($datastringtotaalaankoopprijs, ",");
$datastringtotaalverkoopprijs = rtrim($datastringtotaalverkoopprijs, ",");
?>
<script>



//  var data= [
//        <?php foreach ($this->data->totalenpermaand as $totaalpermaand) { ?>
                //            
                        //        {date:'<?php echo $totaalpermaand['YEAR(timecreated)'] . "-" . $totaalpermaand['MONTH(timecreated)'] ?>',amount:<?php echo $totaalpermaand['totaalverkoopprijsintijd'] ?>},
                                //       <?php } ?>
//    ]
//var width = 420,
//    barHeight = 20;
//
//var x = d3.scale.linear()
//    .domain([0, d3.max(data.amount)])
//    .range([0, d3.max(data.date)]);
//
//var chart = d3.select("#chart")
//    .attr("width", width)
//    .attr("height", barHeight * data.length);

//var bar = chart.selectAll("g")
//    .data(data)
//  .enter().append("g")
//    .attr("transform", function(d, i) { return "translate(0," + i * barHeight + ")"; });
//
//bar.append("rect")
//    .attr("width", x)
//    .attr("height", barHeight - 1);
//
//bar.append("text")
//    .attr("x", function(d) { return x(d) - 3; })
//    .attr("y", barHeight / 2)
//    .attr("dy", ".35em")
//    .text(function(d) { return d; });
//    

                                    function type(d) {
                                    d.value = + d.value; // coerce to number
                                            return d;
                                    }
//    
//    
//    var chartcontainer= d3.select('#chart').style('fill','red')
//    
//    var y= d3.scale.linear().domain([0,10000]).range([1,12])
//    var numbers=[ <?php echo $datastringtotaalaankoopprijs; ?>];
//    var data= [
//        <?php foreach ($this->data->totalenpermaand as $totaalpermaand) { ?>
                                //            
                                //        {date:'<?php echo $totaalpermaand['YEAR(timecreated)'] . "-" . $totaalpermaand['MONTH(timecreated)'] ?>',amount:"1000"},
                                //       <?php } ?>
//    ]
//    d3.min(numbers);
//    var chart = c3.generate({
//        bindto: '#chart',
//        data: {
//            columns: [['aankoopprijs', <?php echo $datastringtotaalaankoopprijs; ?>],
//                ['verkoopprijs',<?php echo $datastringtotaalverkoopprijs; ?>]]
//            , type: "area-step"
//        },
//        axis: {
//            x: {
//                label: 'Month'
//            },
//            y: {
//                label: 'Amount(€)'
//            }
//        }
//    });
//</script>-->