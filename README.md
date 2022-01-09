# RESELLIA
CMS toko online menggunakan laravel. Studi kasus buku menyelami framework laravel oleh Rahmat Awaludin 

**How to install**
1. git clone https://github.com/yat98/resellia.git
2. run "composer install"
3. copy .env.example files to .env or run "composer run-script post-root-package-install"
4. run "php artisan key:generate"
5. create database
6. config database in .env files
7. config Raja Ongkir API in .env files
8. config Mail in .env files for forget password feature
9. run "php artisan storage:link"
10. run "php artisan migrate --seed"
11. add "CURLOPT_SSL_VERIFYPEER => 0" in "/vendor/irfa/raja-ongkir/src/Ongkir/Func/Api.php" curl_cost_option method to allow http connection
12. Done