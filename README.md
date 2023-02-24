<h1>Install guild</h1>
<p>step 1: Create database named: <code>school</code></p>
<p>step 2: run <code>php artisan migrate:fresh</code></p>
<p>step 3: run <code>php artisan db:seed --class=PermissionTableSeeder</code></p>
<p>step 3: run <code>php artisan db:seed --class=CreateAdminUserSeeder</code></p>