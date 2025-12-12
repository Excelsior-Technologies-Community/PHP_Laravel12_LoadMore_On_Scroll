# PHP_Laravel12_LoadMore_On_Scroll

This documentation explains how to build a **Load More on Scroll** feature in Laravel 12 using Livewire.  
It follows the same structure as the provided document, with added explanations for better understanding.

---

## Step 1: Install Laravel 12

Run the following command to install a new Laravel 12 project:

```
composer create-project --prefer-dist laravel/laravel blog
```

**Explanation:**  
This command downloads a fresh Laravel application in a folder named **blog**.  
You will work inside this project for the entire setup.

---

## Step 2: Create Dummy Records using Tinker & Factory

Open Tinker:

```
php artisan tinker
```

Generate 100 dummy users:

```
User::factory()->count(100)->create()
```

**Explanation:**  
Livewire Load More requires a list of users.  
Using a factory automatically inserts 100 fake users into the database, so you can test infinite scrolling easily.

---

## Step 3: Install Livewire

Install Livewire into the Laravel project:

```
composer require livewire/livewire
```

**Explanation:**  
Livewire allows building dynamic components without writing JavaScript.  
This package will provide reactive UI updates for the Load More feature.

---

## Step 4: Create Livewire Component

Run:

```
php artisan make:livewire load-more-user
```

This creates two files:

```
app/Http/Livewire/LoadMoreUser.php
resources/views/livewire/load-more-user.blade.php
```

These files will handle backend logic and frontend display.

---

## Update Livewire Component Logic

### File: `app/Http/Livewire/LoadMoreUser.php`

```php
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class LoadMoreUser extends Component
{
    // Number of users to show initially
    public $perPage = 15;

    // Method to increase number of displayed users
    public function loadMore()
    {
        $this->perPage += 5; // Load 5 more users on each call
    }

    // Render the component with user list
    public function render()
    {
        // Latest users with pagination
        $users = User::latest()->paginate($this->perPage);

        // Return view with user data
        return view('livewire.load-more-user', compact('users'));
    }
}
```

**Explanation:**  
- `$perPage` controls how many users appear initially.  
- `loadMore()` increases the user count when scroll reaches bottom.  
- `render()` returns users using pagination with Livewire reactivity.

---

## Step 4 (Frontend): Update Blade Template

### File: `resources/views/livewire/load-more-user.blade.php`

```html
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
                    <td>{{ $user->id }}</td> <!-- User ID -->
                    <td>{{ $user->name }}</td> <!-- User Name -->
                    <td>{{ $user->email }}</td> <!-- User Email -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
```

**Explanation:**  
This table simply displays the paginated user records passed from the component.

---

## Step 5: Create Route

File: `routes/web.php`

```php
Route::get('load-more-user', function () {
    return view('default');
});
```

**Explanation:**  
When visiting `/load-more-user`, Laravel will load the page containing the Livewire component.

---

## Step 6: Create Main View File

### File: `resources/views/default.blade.php`

```html
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 12 Livewire Load More on Scroll</title>

    @livewireStyles  <!-- Livewire CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            Laravel 12 Livewire - Load More on Scroll
        </div>

        <div class="card-body">
            @livewire('load-more-user') <!-- Load the component -->
        </div>
    </div>
</div>

@livewireScripts <!-- Livewire JS -->

<script>
    // Detect when user scrolls to the bottom and load more data
    window.addEventListener('scroll', function() {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            Livewire.dispatch('load-more'); // Call loadMore() in Livewire
        }
    });
</script>

</body>
</html>
```

**Explanation:**  
- Livewire styles & scripts must be included for component functionality.  
- JavaScript detects when the user scrolls to the bottom of the page.  
- When bottom reached → triggers Livewire event → loads more users.

---

## Step 7: Run the Application

Start server:

```
php artisan serve
```

Visit:

```
http://localhost:8000/load-more-user
```

<img width="1550" height="776" alt="image" src="https://github.com/user-attachments/assets/3dad19cd-f29c-4841-bb93-e2dd611b5e24" />

