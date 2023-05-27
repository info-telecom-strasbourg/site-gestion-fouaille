@if ($errors->any())
    <div class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-body">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        var toast = document.querySelector('.toast');
        var toastInstance = new bootstrap.Toast(toast);
        toastInstance.show();
    </script>

@endif
