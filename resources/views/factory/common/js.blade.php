<script>
    slabs = {!!\App\Services\CommonService::getTodaysFineLeafPrice()->toJson()!!};
    // slabs = {!!\App\Services\CommonService::getTodaysFineLeafPrice()->toJson()!!};
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
                   +' <td>Final Rate (Rs)</td>'
                  +' <td>'+data.final_rate+'</td>'
                   +' <td>Confirmed Fine Leaf count: </td>'
                   +' <th>'+data.confirmed_fine_leaf_count+'</th>'
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
                   +' <td>Incentive per kg (Rs): </td>'
                   +' <th>'+(data.incentive_per_kg == null ? 0.00 : data.incentive_per_kg)+'</th>'
                   +' <td>Total Incentive</td>'
                   +' <th>'+(data.incentive_total == null ? 0.00 : data.incentive_total)+'</th>'
                   +' <td>Total Amount (Rs): </td>'
                    +'<th>'+(data.total_amount + (data.incentive_total == null ? 0.00 : data.incentive_total))+'</th>'
                   +' <td>Status: </td>'
                   +' <th>'+data.status+'</th>'
               +' </tr>'
               +' <tr>'
                   +' <td>Slip Number: </td>'
                   +' <th>'+(data.slip_number !== null ? data.slip_number : "NA")+'</th>'
                   +' <td>Vehicle In-time</td>'
                   +' <th>'+(data.vehicle_in_time !== null ? data.vehicle_out_time : "NA")+'</th>'
                   +' <td>Vehicle In-time: </td>'
                    +'<th>'+(data.vehicle_out_time !== null ? data.vehicle_out_time : "NA")+'</th>'
                   +' <td> </td>'
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
    addIncentive = function(obj){
        var $this = $(obj);
        var $modal = $("#incentiveModal");
        console.log($this.data())
        $modal.find("form").attr("action", $this.data("url"));
        $modal.find("#net_weight").val($this.data("offer").net_weight);
        $modal.modal();
    }
    incentiveSubmit = function(obj, event){
        event.preventDefault();
        var $this = $(obj);
        var incentive_kg = parseFloat($("#incentive_per_kg").val());
        if( incentive_kg == 0 || isNaN(incentive_kg)){
            toastr["error"]("incentive per kg field is required.");
            return false;
        }
        $("body").css("cursor", "progress");
        var formData = $this.serialize();
        var url = $this.attr("action");
        var xhr = $.post(url, formData);
        $("#incentiveModal").find("button[type='submit']").prop("disabled", true);
        xhr.done(function(resp){
            // resp = JSON.parse(resp);
            toastr["success"](resp.message);
            $("#incentiveModal").modal("hide");
        })
        .fail(function(error){
            // error = JSON.parse(error);
            toastr["error"](JSON.parse(error.responseText).message);
        })
        .always(function(){
            $("body").css("cursor", "default");
            $("#incentiveModal").find("button[type='submit']").prop("disabled", false);
        });
    }
    $(document).ready(function(){
        $(document).ready(function(){
            $("body").addClass("sidebar-collapse");
        })
        $.ajaxSetup({
            headers: {
                'Accept': 'application/json'
            }
        });
        $("#incentive_per_kg").keyup(function(){
            var value = parseFloat($(this).val());
            if(isNaN(value)){
                value = 0.00;
            }
            var net_weight = parseFloat($(this).parents("form").find("#net_weight").val());
            if(isNaN(net_weight)){
                net_weight = 0.00;
            }
            var total = net_weight * value;
            $(this).parents("form").find("#total_incentive").val(total)
        });
        $("#leaf_pc_input").on("input", function(){
            var price = 0.0;
            var value = parseFloat($(this).val());
            if(isNaN(value)){
                value = 0.00;
            }
            $.each(slabs, function(index, obj){
                if(value >= obj.fine_leaf_count_from  && value <= obj.fine_leaf_count_to){
                    price = parseFloat(obj.price);
                    $("#leaf_price_input").val(price);
                    return;
                }
            });
            $("#leaf_price_input").val(price);
        });
    })
</script>
