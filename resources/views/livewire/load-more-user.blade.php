<div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td> <!-- Show user ID -->
                    <td>{{ $user->name }}</td> <!-- Show user name -->
                    <td>{{ $user->email }}</td> <!-- Show user email -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
