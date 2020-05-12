<div class="container">
    <table class="table table-bordered table-sm">
        <tbody>
            <tr>
                <th>Name</th>
                <td>: {{$factory->name}}</td>
            </tr>
            <tr>
                <th>Code</th>
                <td>: {{$factory->username}}</td>
            </tr>
            <tr>
                <th>Contact</th>
                <td>: {{$factory->factory_information->mobile}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>: {{$factory->email}}</td>
            </tr>
            <tr>
                <th colspan="2" class="text-primary text-center">Address</th>
            </tr>
            <tr>
                <th>Location</th>
                <td>: {{$factory->factory_information->location}}</td>
            </tr>
            <tr>
                <th>Address 1</th>
                <td>: {{$factory->address->address_1}}</td>
            </tr>
            <tr>
                <th>Address 2</th>
                <td>: {{$factory->address->address_2}}</td>
            </tr>
            <tr>
                <th>Pin</th>
                <td>: {{$factory->address->pin}}</td>
            </tr>
        </tbody>
    </table>
</div>
