<div class="container">
    <table class="table table-bordered table-sm">
        <tbody>
            <tr>
                <th>Name</th>
                <td>: {{$headquarter->name}}</td>
            </tr>
            <tr>
                <th>Code</th>
                <td>: {{$headquarter->username}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>: {{$headquarter->email}}</td>
            </tr>
            <tr>
                <th colspan="2" class="text-primary text-center">Address</th>
            </tr>
            <tr>
                <th>Address 1</th>
                <th>: {{$headquarter->address->address_1}}</th>
            </tr>
            <tr>
                <th>Address 2</th>
                <th>: {{$headquarter->address->address_2}}</th>
            </tr>
            <tr>
                <th>Pin</th>
                <th>: {{$headquarter->address->pin}}</th>
            </tr>
        </tbody>
    </table>
</div>
