# simple roles-permission management for laravel   
1a. Install plugin via command 
```
composer require nagarjunbn/acl
```
1b. Register the service provider in ```app.php```
```Nagarjun\ACL\ACLServiceProvider::class```
2. Migrate the new tables
3. Update your Users table and add ```'role_id'``` column 
4. Add the below code to your User.php model file
```
public function Role() {
    return $this->belongsTo('\Nagarjun\ACL\Models\Role', 'role_id', 'id');
}
``` 
5. Make sure your application environment is local i.e., ```APP_ENV=local``` . The ACL urls are blocked if the application is not in local mode to avoid misuse of the plugin . 
6. Access the plugin via URL and set permissions
```
http://domain/acl/dashboard
```
7. Use the middleware ```'acl'``` in your routes,controllers to prevent the access .
