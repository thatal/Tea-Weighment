<table class="table table-bordered table-head-fixed text-nowrap">
    <thead>
        <tr>
            <th>Date</th>
            <th>Confirmation Code</th>
            <th>Vehicle No.</th>
            <th>Gross</th>
            <th>Tare</th>
            <th>Ded.</th>
            <th>Net(Kg.)</th>
            <th>F.Leaf(%)</th>
            <th>Rate</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($summary_reports["records"]))
            @forelse($summary_reports["records"] as $key => $summary)
                <tr>
                    <th colspan="10">
                        {{$summary["vendor"]["name"] ?? "N/A"}}
                    </th>
                </tr>
                @foreach ($summary["data"] as $row)
                    <tr>
                        <td>{{$row->date}}</td>
                        <td>{{$row->confirmation_code}}</td>
                        <td>{{$row->vehicle_number}}</td>
                        <td class="text-right">{{$row->gross}}</td>
                        <td class="text-right">{{$row->tare}}</td>
                        <td class="text-right">{{$row->deduction}}</td>
                        <td class="text-right">{{$row->sum_weight}}</td>
                        <td class="text-right">{{$row->fine_leaf}}</td>
                        <td class="text-right">{{$row->rate}}</td>
                        <td class="text-right">{{$row->amount}}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="3">Sub Total</th>
                    <td class="text-right">{{$summary["sub_total_gross"]}}</td>
                    <td class="text-right">{{$summary["sub_total_tare"]}}</td>
                    <td class="text-right">{{$summary["sub_total_deduction"]}}</td>
                    <td class="text-right">{{$summary["sub_total_net_weight"]}}</td>
                    <td class="text-right">{{$summary["sub_total_fine_leaf"]}}</td>
                    <td class="text-right">{{$summary["sub_total_rate"]}}</td>
                    <td class="text-right">{{$summary["sub_total_amount"]}}</td>
                </tr>
            @empty
            <tr>
                <td class="text-danger text-center" colspan="7">No records found.</td>
            </tr>
            @endforelse
        <tr>
            <th colspan="3">Grand Total</th>
            <td class="text-right">{{$summary_reports["grand_total_gross"]}}</td>
            <td class="text-right">{{$summary_reports["grand_total_tare"]}}</td>
            <td class="text-right">{{$summary_reports["grand_total_deduction"]}}</td>
            <td class="text-right">{{$summary_reports["grand_total_net_weight"]}}</td>
            <td class="text-right">{{$summary_reports["grand_total_fine_leaf"]}}</td>
            <td class="text-right">{{$summary_reports["grand_total_rate"]}}</td>
            <td class="text-right">{{$summary_reports["grand_total_amount"]}}</td>
        </tr>
        @else
            <tr>
                <td class="text-danger text-center" colspan="10">No records found for summary.</td>
            </tr>
        @endif
    </tbody>
</table>
