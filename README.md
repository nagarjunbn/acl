# Simple roles-permission management for laravel

## Laravel version supported
version >= 5.5 

## Steps for installation
1. Install plugin via command 
```
composer require nagarjunbn/acl
```
2.  Register the service provider in ```app.php```
```
Nagarjun\ACL\ACLServiceProvider::class
```
3. Migrate the new tables
4. Update your Users table and add ```'role_id'``` column 
5. Add the below code to your User.php model file
```
public function Role() {
    return $this->belongsTo('\Nagarjun\ACL\Models\Role', 'role_id', 'id');
}
``` 
6. Make sure your application environment is local i.e., ```APP_ENV=local``` . The ACL urls are enabled if the application is not in **production** mode to avoid misuse of the plugin . 
7. Access the plugin via URL and set permissions
```
http://domain/acl/dashboard
```
8. Use the middleware ```'acl'``` in your routes,controllers to prevent the access .

## Screenshot
![alt text](https://raw.githubusercontent.com/nagarjunbn/acl/screenshot/img1.png)

## License
The composer plugin is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT)