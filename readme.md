<p>To use the project on your machine.</p>

<p>1 => Clone the design on your machine.</p>
        <b>git@github.com:matheusestevao/musiclibrary.git</b>
        
<p>2 => Install the dependencies of the same.</p>
        <code>composer install</code>
<p>3 => While the dependencies are installed, I created a MySQL database.</p>

<p>4 => After creating the database and the dependencies are installed, clone the .env.exemple file, removing .exemple, and configuring it with the database that you just created.</p>
        <code>php artisan migrate</code>
        AND
        <code>php db:seed</code>
<p>5 => After configuring the .env file, run the command to create the tables and some already defined records.</p>


<p>6 => Admin User: admin@admin.com / Password: 123456.</p>
<p>7 => User User: user@user.com / 654321.</p>
