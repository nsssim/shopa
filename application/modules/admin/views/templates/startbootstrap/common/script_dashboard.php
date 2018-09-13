   	<?php
	// load the url helper for base_url 
	$this->load->helper('url');
	$template_path= base_url()."assets/templates/adminlte/";
	 ?> 
	 
   <!-- jQuery 2.1.4 -->
    <script src='<?php echo($template_path."plugins/jQuery/jQuery-2.1.4.min.js")?>'></script>
    
    <!-- Bootstrap 3.3.2 JS -->
    <script src='<?php echo($template_path."bootstrap/js/bootstrap.min.js")?>' type="text/javascript"></script>
   
    <!-- FastClick -->
    <script src='<?php echo($template_path."plugins/fastclick/fastclick.min.js")?>'></script>
    
    <!-- AdminLTE App -->
    <script src='<?php echo($template_path."dist/js/app.min.js")?>' type="text/javascript"></script>
    
    <!-- Sparkline -->
    <script src='<?php echo($template_path."plugins/sparkline/jquery.sparkline.min.js")?>' type="text/javascript"></script>
    
    <!-- jvectormap -->
    <script src='<?php echo($template_path."plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")?>' type="text/javascript"></script>
    <script src='<?php echo($template_path."plugins/jvectormap/jquery-jvectormap-world-mill-en.js")?>' type="text/javascript"></script>
    
    <!-- SlimScroll 1.3.0 -->
    <script src='<?php echo($template_path."plugins/slimScroll/jquery.slimscroll.min.js")?>' type="text/javascript"></script>
    
    <!-- ChartJS 2.2.1 -->
    <!--<script src='<?php echo($template_path."plugins/chartjs/Chart.min.js")?>' type="text/javascript"></script>-->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js' type="text/javascript"></script>


    <!-- AdminLTE for demo purposes -->
    <script src='<?php echo($template_path."dist/js/demo.js")?>' type="text/javascript"></script>
    
    <script>
    	var ctx = document.getElementById("myChart");
    	var ctx2 = document.getElementById("myChart2");
    	
    	///// 1st chart
		var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: ["JAN", "FEB", "MARS", "APRIL", "MAY", "JUNE"],
		        datasets: [{
		            label: '# of Orders',
		            data: [5, 19, 13, 10, 15, 25],
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255,99,132,1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:false
		                }
		            }]
		        }
		    }
		});
	// 2nd chart 
	var data = {
    labels: ["Jean", "Glasses", "shoes", "clothes", "jewelery", "accessories", "hats","socks"],
    datasets: [
        {
            label: "Men",
            backgroundColor: "rgba(179,181,198,0.2)",
            borderColor: "rgba(179,181,198,1)",
            pointBackgroundColor: "rgba(179,181,198,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(179,181,198,1)",
            data: [65, 59, 90, 75, 56, 55, 40,50]
        },
        {
            label: "Women",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            pointBackgroundColor: "rgba(255,99,132,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(255,99,132,1)",
            data: [28, 48, 40, 95, 96, 27, 100,60]
        },
        {
            label: "Kids",
            backgroundColor: "rgba(214, 235, 250, 0.2)",
            borderColor: "rgba(214, 235, 250, 1)",
            pointBackgroundColor: "rgba(214, 235, 250,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(214, 235, 250,1)",
            data: [50, 30, 60, 33, 80, 40, 60,100]
        }
    ]
	};
	
	var myRadarChart = new Chart(ctx2, {
    type: 'radar',
    data: data,
    options: {
            scale: {
                reverse: false,
                ticks: {
                    beginAtZero: true
                	}
            	}
            }
	});
	
	
////
		
		
		
    </script>
    
  </body>
</html>