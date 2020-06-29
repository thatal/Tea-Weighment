<script>
    showDetails = function(obj){
        var data = $(obj).data('offer');
        console.log(data);
        var table_html = '<h3>Confirmation Code: <strong>'+(data.confirmation_code ?? "N/A")+'</strong></h3>'
        +'<table class="table table-bordered table-responsive-xl">'
            +'<tbody>'
                +'<tr>'
                    +'<td>Factory: </td>'
                    +'<th>'+data.factory.name+'</th>'
                    +'<td>Vendor: </td>'
                   +' <th>'+data.vendor.name+'</th>'
                    +'<td>Confirmation Code: </td>'
                    +'<th colspan="3">'+(data.confirmation_code ?? "N/A")+'</th>'
                +'</tr>'
                +'<tr>'
                    +'<td>Leaf Quantity: </td>'
                   +' <th>'+data.leaf_quantity.toFixed(2)+'</th>'
                   +' <td>Offer Price: </td>'
                   +' <th>'+data.offer_price+'</th>'
                   +' <td>Expected Fine Leaf count: </td>'
                   +' <th>'+data.expected_fine_leaf_count+'</th>'
                    +'<td>Expected Moisture: </td>'
                    +'<th>'+data.expected_moisture+'</th>'
               +' </tr>'
                +'<tr>'
                    +'<td>Vehicle : </td>'
                    +'<th>'+(data.vehicle_number !== null ? data.vehicle_number+' ('+data.vehicle.name+')' : "N/A")+'</th>'
                    +'<td>Confirmed Price: </td>'
                   +' <th>'+data.confirmed_price+'</th>'
                   +' <td>Confirmed Fine Leaf count: </td>'
                   +' <th>'+data.confirmed_fine_leaf_count+'</th>'
                   +' <td></td>'
                  +'  <td></td>'
                +'</tr>'
               +' <tr>'
                   +' <td>Gross Weight: </td>'
                   +' <th>'+data.first_weight+'</th>'
                   +' <td>Deduction: </td>'
                   +' <th>'+data.deduction+'</th>'
                    +'<td>Tare: </td>'
                   +' <th>'+data.tare+'</th>'
                   +' <td>Net Weight: </td>'
                   +' <th>'+data.net_weight+'</th>'
               +' </tr>'
               +' <tr>'
                   +' <td>Total Amount: </td>'
                    +'<th>'+data.total_amount+'</th>'
                   +' <td>Status: </td>'
                   +' <th>'+data.status+'</th>'
                   +' <td></td>'
                   +' <th></th>'
                   +' <td></td>'
                   +' <th></th>'
               +' </tr>'
            +'</tbody>'
       +' </table>';
        var $modal = $("#vendorOffer");
        $modal.find(".table-responsive").html(table_html);
        $modal.modal();
    }
</script>