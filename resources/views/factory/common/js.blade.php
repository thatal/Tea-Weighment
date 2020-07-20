<script>
    showDetails = function(obj){
        var data = $(obj).data('offer');
        console.log(data);
        var table_html = '<h3>Confirmation Code: <strong>'+(data.confirmation_code ?? "N/A")+'</strong></h3>'
        +'<table class="table table-bordered table-responsive-xl">'
            +'<tbody>'
                +'<tr>'
                    +'<td>Factory: </td>'
                    +'<th>'+(data.factory !== null ? data.factory.name : "NA")+'</th>'
                    +'<td>Supplier: </td>'
                   +' <th>'+data.vendor.name+'</th>'
                    +'<td>Confirmation Code: </td>'
                    +'<th colspan="3">'+(data.confirmation_code ?? "N/A")+'</th>'
                +'</tr>'
                +'<tr>'
                    +'<td>Offer Quantity(KG): </td>'
                   +' <th>'+data.leaf_quantity.toFixed(2)+'</th>'
                   +' <td>Offer Price (Rs): </td>'
                   +' <th>'+data.offer_price+'</th>'
                   +' <td>Expected Fine Leaf count: </td>'
                   +' <th>'+data.expected_fine_leaf_count+'</th>'
                    +'<td>Expected Moisture: </td>'
                    +'<th>'+data.expected_moisture+'</th>'
               +' </tr>'
                +'<tr>'
                    +'<td>Vehicle : </td>'
                    +'<th>'+(data.vehicle_number !== null ? data.vehicle_number+' ('+data.vehicle.name+')' : "N/A")+'</th>'
                    +'<td>Confirmed Price (Rs): </td>'
                   +' <th>'+data.confirmed_price+'</th>'
                   +' <td>Confirmed Fine Leaf count: </td>'
                   +' <th>'+data.confirmed_fine_leaf_count+'</th>'
                   +' <td></td>'
                  +'  <td></td>'
                +'</tr>'
               +' <tr>'
                   +' <td>Gross Weight (KG): </td>'
                   +' <th>'+data.first_weight+'</th>'
                   +' <td>Deduction (KG): </td>'
                   +' <th>'+data.deduction+'</th>'
                    +'<td>Tare (KG): </td>'
                   +' <th>'+data.second_weight+'</th>'
                   +' <td>Net Weight (KG): </td>'
                   +' <th>'+data.net_weight+'</th>'
               +' </tr>'
               +' <tr>'
                   +' <td>Total Amount (Rs): </td>'
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
    showAcceptModal = function(obj){
        console.log(obj);
    }
    counterOffer = function(obj){
        var data = $(obj).data();
        console.log(data);
        var $modal = $("#vendorOfferCounter");
        $modal.find("form").prop({
            "action": data.url
        });
        $modal.find("#offer_price").val(data.offer.offer_price);
        $modal.find("#counter_price").val(data.offer.offer_price);
        $modal.modal();
    }
    addLeafCountPc = function(obj){
        var $this = $(obj);
        console.log($this.data())

        var url = $this.data("url");
        var $modal = $("#vendorAddPrice");

        $modal.find("form").prop({
            "action" : url
        });

        $modal.modal();
    }
</script>
