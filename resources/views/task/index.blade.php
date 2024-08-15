@include('includes.header')
<body>
    <div id="app" class="mt-1">
        <div class="container">
            @include('task.navbar')
            <header class="row mt-3">
                <nav>
                    <h1> TO DO LIST </h1>
                </nav>
            </header>
            <task-manager></task-manager>
            <add-user></add-user>
            <footer class="row mt-2">
                <p>&copy; 2024 To Do List</p>
            </footer>
        </div>
    </div>
</body>
</html>