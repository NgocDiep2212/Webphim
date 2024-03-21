
    function topViewsChart(xValues,yValues) {
      new Chart("myChart", {
        type: "bar",
        data: {
          labels: xValues,
          datasets: [{
            data: yValues,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: "Top Phim được xem nhiều nhất"
          }
        }
      });
    }
  
    function viewsMonthChart(labels_line,yValues_line) {
      
      new Chart("viewsChart", {
        type: "line",
        data: {
          labels: labels_line,
          datasets: [{
            data: yValues_line,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            
          }]
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: "Thống kê lượt xem phim"
          }
        }
      });
    }
  
        
    function viewsMonthSelectChange(thang) {
      $.ajax({
        url: '/admin/get-month-views',
        method: "GET",
        data: { thang: thang },
        success: function(data) {
          if (data) { // Check if data is received successfully
            const monthlyViews = data; // Access the data from the response
  
            const yValues_line = [];
            const labels_line = [];
  
            for (const monthlyView of monthlyViews) {
              yValues_line.push(monthlyView.total_views); // Extract total_views
              labels_line.push(monthlyView.day); // Extract total_views
            }
  
            // Update existing chart or create a new one
            new Chart("viewsChart", {
              type: "line",
              data: {
                labels: labels_line,
                datasets: [{
                  data: yValues_line,
                  borderColor: 'rgb(75, 192, 192)',
                  tension: 0.1,
                  
                }]
              },
              options: {
                legend: { display: false },
                title: {
                  display: true,
                  text: "Thống kê lượt xem phim"
                }
              }
              });
              } else {
                // Handle error cases (e.g., failed AJAX request)
                alert('Error retrieving data!');
              }
        }
      });
    }
  
    function salesMonthChart(labels_line,yValues_line) {
      
      new Chart("salesChart", {
        type: "line",
        data: {
          labels: labels_line,
          datasets: [{
            data: yValues_line,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            
          }]
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: "Thống kê doanh thu bán gói VIP"
          }
        }
      });
    }
  
        
    function salesMonthSelectChange(thang) {
      $.ajax({
        url: '/admin/get-month-sales',
        method: "GET",
        data: { thang: thang },
        success: function(data) {
          if (data) { // Check if data is received successfully
            const monthlySales = data; // Access the data from the response
  
            const yValues_line = [];
            const labels_line = [];
  
            for (const monthlySale of monthlySales) {
              yValues_line.push(monthlySale.total_sales); // Extract total_views
              labels_line.push(monthlySale.day); // Extract total_views
            }
  
            // Update existing chart or create a new one
            new Chart("salesChart", {
              type: "line",
              data: {
                labels: labels_line,
                datasets: [{
                  data: yValues_line,
                  borderColor: 'rgb(75, 192, 192)',
                  tension: 0.1,
                }]
              },
              options: {
                legend: { display: false },
                title: {
                  display: true,
                  text: "Thống kê doanh thu bán gói VIP"
                }
              }
              });
              } else {
                // Handle error cases (e.g., failed AJAX request)
                alert('Error retrieving data!');
              }
        }
      });
    }
