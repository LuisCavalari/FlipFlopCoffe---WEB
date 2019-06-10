<div class="container mt-4">
    <canvas style="height:500px" id="chart" ></canvas>
</div>
<script>
    $(document).ready(() => {
        $.ajax({
            method: "POST",
            url: "home/chart",
            dataType: "json"
        }).done(function(resposta) {
            drawChart(resposta)
        })
    })

    function drawChart(dados) {
        let context = document.getElementById('chart').getContext('2d');
        let chart = new Chart(context, {
            type: 'line',
            data: {
                labels:dados.dias,
                datasets: [{
                        label: 'Vendas no dia',
                        data: dados.valores,
                        backgroundColor: "#3f1281b2",
                        borderColor: "#442268"
                    },
                    
                ]
            },
            options:{
                title:{
                    display:true,
                    text:"Vendas por mes",
                },
                responsive:true,
                maintainAspectRatio:false,
            }
            
            
        });
    }
</script>