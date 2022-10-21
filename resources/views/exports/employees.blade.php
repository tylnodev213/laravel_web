<h2>List Employees</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Team</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->avatar }}</td>
            <td>{{ $employee->teamName }}</td>
            <td>{{ $employee->fullName }}</td>
            <td>{{ $employee->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
