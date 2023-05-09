$("#select_restaurent").on("change",function(){
    route =  $(this).data("url");
    formData={id:$(this).val()};
    category_id = $("#category_id");
    ajaxCall1(route,formData,category_id)
});


function ajaxCall1(route,formData){
    jQuery.ajax({
        url: route,
        type: "post",
        cache: false,
        data: formData,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //   processData: false,
    //     contentType: false,
        dataType:"JSON",
            beforeSend: function(msg){
            },
        success:function(data) { 
            
            if(data.status==true){
                $("#category_id").html(data.data);
            }
            else{
                $("#category_id").html(data.data);
            }
    
        }
        });
}


//
function   ajaxCall(route,formData){
    jQuery.ajax({
                url: route,
                type: "post",
                cache: false,
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             //   processData: false,
           //     contentType: false,
                dataType:"JSON",
                 beforeSend: function(msg){
                    },
                success:function(data) { 
                //    console.log(data);
             
            if(data.status==true){
                window.location.reload();
                return true;
                
            }
            else{
                return false;
            }
            }
        });
}
var admin_restaurent_graph_route = $("#restaurent_admin_graph_route").val();


admin_graph(admin_restaurent_graph_route,1);
function admin_graph(route,type){
   // console.log(route);

    jQuery.ajax({
        url: route,
        type: "post",
        cache: false,
        data: "",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"JSON",
         beforeSend: function(msg){
            },
        success:function(data) { 
        
            if(data.status==true){
                countArr = [];
                dataArr = [];
                if(type==1)
                {
                    AdminRestaurentGraph = data.data;
                    for(i=0;i<AdminRestaurentGraph.length;i++){
                        countArr.push(AdminRestaurentGraph[i].count);
                        dataArr.push(AdminRestaurentGraph[i].monthname);
                   }
                   restaurent(countArr,dataArr,"lineChart_2");
                   restaurent(countArr,dataArr,"lineChart_3");
                }
            }
    }
});

}
function restaurent(countArr1,dataArr,graph_id){
    
if(jQuery('#'+graph_id).length > 0 ){
        
    const lineChart_2 = document.getElementById(graph_id).getContext('2d');
    //generate gradient
    const lineChart_2gradientStroke = lineChart_2.createLinearGradient(500, 0, 100, 0);
    lineChart_2gradientStroke.addColorStop(0, "rgba(252, 128, 25, 1)");
    lineChart_2gradientStroke.addColorStop(1, "rgba(235, 129, 83, 0.5)");
    lineChart_2.height = 100;
    new Chart(lineChart_2, {
        type: 'line',
        data: {
            defaultFontFamily: 'Poppins',
            labels: dataArr,
            datasets: [
                {
                    label: "Count",
                    data: countArr1,
                    borderColor: lineChart_2gradientStroke,
                    borderWidth: "2",
                    backgroundColor: 'transparent', 
                    pointBackgroundColor: 'rgba(235, 129, 83, 0.5)',
                    tension: 0.5,
                }
            ]
        },
        options: {
            plugins:{
                    legend: false
            },
             
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true, 
                        max: 100, 
                        min: 0, 
                        stepSize: 20, 
                        padding: 10
                    }
                },
                x: { 
                    ticks: {
                        padding: 5
                    }
                }
            }
        }
    });
}

}



