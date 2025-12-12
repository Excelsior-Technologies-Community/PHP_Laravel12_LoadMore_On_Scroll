<!DOCTYPE html>
<html>
<head>
    <title>Laravel 12 Livewire Load More on Scroll</title>

    @livewireStyles <!-- Livewire CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            Laravel 12 Livewire - Load More on Scroll
        </div>

        <div class="card-body">
            @livewire('load-more-user') <!-- Load the Livewire component -->
        </div>
    </div>
</div>

@livewireScripts <!-- Livewire JS -->

<script>
    // Detect scroll to bottom of the page
    window.addEventListener('scroll', function() {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            Livewire.dispatch('load-more'); // Call loadMore() method in Livewire
        }
    });
</script>

</body>
</html>
