# Before using ``php artisan serve`` after first usage

1. Execute ``composer install``
2. Clear cache ``php artisan cache:clear`` and config ``php artisan config:clear``
3. Rename ``.env.example`` to ``.env``, configure db access
4. Generate Laravel API Key with ``php artisan key:generate``

